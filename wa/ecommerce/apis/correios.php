<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
error_reporting(0);
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
$SEDEXerro = null;
$PACerro = null;	
$origin = $_GET['origem'];
$destino = $_GET['destino'];
$PACvalor = 0;
$PACtempo = 0;
$SEDEXvalor = 0;
$SEDEXtempo = 0;
$curl = curl_init();
foreach($_SESSION["car"] as $id => $qtd ){
	$produto = DBRead('ecommerce', '*', "WHERE id = $qtd[0]")[0];
	$peso = $produto['peso'];
	$comprimento= $produto['comprimento'];
	$diametro = 0;
	$altura = $produto['altura'];
	$largura = $produto['largura'];
	$SEDEXcod = "04014";
	$PACcod = "04510";

	curl_setopt_array($curl, array(
	CURLOPT_URL => 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?sCepOrigem='.$origin.'&sCepDestino='.$destino.'&nVlPeso='.$peso.'&nVlComprimento='.$comprimento.'&nVlAltura='.$altura.'&nVlLargura='.$largura.'&nCdServico='.$PACcod.'&nVlDiametro='.$diametro.'&StrRetorno=XML',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'GET',
	));

	$pac = curl_exec($curl);

	$pac =  simplexml_load_string($pac);
	foreach($pac -> cServico as $row) {	
		$valor = number_format(floatval($row -> Valor), 2, '.', ',')*$qtd[1];	  
		$PACvalor += $valor;
		$PACtempo = $row -> PrazoEntrega;
		if(!empty($row -> MsgErro)){
			$PACerro = $row -> MsgErro;
		}
	}
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?sCepOrigem='.$origin.'&sCepDestino='.$destino.'&nVlPeso='.$peso.'&nVlComprimento='.$comprimento.'&nVlAltura='.$altura.'&nVlLargura='.$largura.'&nCdServico='.$SEDEXcod.'&nVlDiametro='.$diametro.'&StrRetorno=XML',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$sedex = curl_exec($curl);

	$sedex =  simplexml_load_string($sedex);
	foreach($sedex -> cServico as $row) {		
		$valor =  number_format(floatval($row -> Valor), 2, '.', ',')*$qtd[1];	  
		$SEDEXvalor += $valor;
		$SEDEXtempo = $row -> PrazoEntrega;
		if(!empty($row -> MsgErro)){
			$SEDEXerro = $row -> MsgErro;
		}
	}
}
	curl_close($curl);
	if(empty($PACerro)){
	echo "<label for='normal' style='cursor:pointer; margin-left:10px;'><input type='radio' name='frete' id='normal'  required style='cursor:pointer' value='".number_format($PACvalor, 2, ',', '.')."'  onchange='Cfrete(".$PACvalor.")' > <b>Normal</b><br> Valor do frete: R$ ".number_format($PACvalor, 2, ',', '.')." / Prazo de entrega: ".$PACtempo." dias.</label> <br>";
	}else {
		echo $PACerro."<br>";
	}
	if(empty($SEDEXerro)){
		echo "<label for='expresso' style='cursor:pointer; margin-left:10px;'><input type='radio' name='frete' id='expresso'required style='cursor:pointer' value='".number_format($SEDEXvalor, 2, ',', '.')."' onchange='Cfrete1(".$SEDEXvalor.")'> <b>Expresso</b><br> Valor do frete: R$ ".number_format($SEDEXvalor, 2, ',', '.')." / Prazo de entrega: ".$SEDEXtempo." dias.</label>";
	}else{
		echo $SEDEXerro;
	}