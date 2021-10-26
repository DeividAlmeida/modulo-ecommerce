<?php 
if(!isset($_SESSION)){ 
    session_start(); 
}
error_reporting(0);
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
$query2 = DBRead('ecommerce_config','*');
$config = [];
$map =[];
foreach ($query2 as $key => $row) {
	$config[$row['id']] = $row['valor'];
}
if(!file_exists('../../../estoque.php')){
	foreach($_SESSION["car"] as $a => $b ){
		$db = DBRead('ecommerce', '*', "WHERE id = $b[0]")[0]; 
		$c = $db['estoque'] - $b[1];
	
		if($db['diminuir_est'] == "sim"){
	
			$data5 = array(
			'estoque' => $c,
			);	
			DBUpdate('ecommerce', $data5, "id = $b[0]");  
		}
	}
}
$resources = array_combine(array_keys($_POST['produto']), array_map(function ($qtd, $produto, $un_valor, $produto_pg, $id_pdt) {
	return compact('qtd', 'produto', 'un_valor', 'produto_pg', 'id_pdt' );
},$_POST['qtd'], $_POST['produto'], $_POST['un_valor'], $_POST['produto_pg'], $_POST['id_pdt']));
$_POST['venda'] = json_encode($resources, JSON_FORCE_OBJECT);

if (isset($_POST)) {    
    $nome = post('billing_first_name')." ".post('billing_last_name');
    $data = array(
		'nome'      => $nome,
		'tipo_pessoa' => post('billing_persontype'),
		'id_pessoa' => post('id_pessoa'),
		'cep' => post('billing_postcode'),
		'bairro' => post('billing_neighborhood'),
		'rua' => post('billing_address_1'),
		'numero' => post('billing_number'),
		'complemento' => post('billing_address_2'),
		'cidade' => post('billing_city'),
		'estado' => post('billing_state'),
		'telefone' => post('billing_phone'),
		'email' => post('billing_email'),
		'nota' => post('order_comments'),
		'tipo_entrega' => post('tipo_entrega'),
		'valor' => post('valor'),
		'produto' => $_POST['venda'],
		'tipo_pagamento'=>post('payment_method'),
		'id_cliente' => post('id_cliente'),
		'vl_frete' => post('vl_frete')
    );

    $query = DBCreate('ecommerce_vendas', $data, true);
    
    $read = DBRead('ecommerce_vendas','*',"WHERE id = '{$query}'");
    require_once('../../../controller/ecommerce/email_vendedor.php');
    
    if( post('payment_method') == "Dep贸sito"){
		require_once('../../../controller/ecommerce/email_cliente_retirada.php');
	}else{
    	require_once('../../../controller/ecommerce/email_cliente.php');
    }
    if($_POST['criar'] == 'sim'){
		$enderecos = [[
			'estado'=>post('billing_state'),
			'cidade'=>post('billing_city'),
			'rua'=>post('billing_address_1'),
			'bairro'=>post('billing_neighborhood'),
			'numero'=>post('billing_number'),
			'cep'=>post('billing_postcode'),
			'padrao'=>true
		]];
        $enderecos = json_encode($enderecos);
        $senha =  str_replace(" ","",$nome.rand(1,100));
        $user = DBCreate('ecommerce_usuario', [
            'nome'      => post('billing_first_name'),
            'sobrenome'      => post('billing_last_name'),
            'email' => post('billing_email'),
            'senha' => md5($senha),
            'telefone' => post('billing_phone'),
            'pessoa' => post('billing_persontype'),
            'id_pessoa' => post('id_pessoa'),
            'endereco'=> $enderecos
            ], true);
            require_once('../../../controller/ecommerce/email_cliente_novo.php');
            DBUpdate('ecommerce_vendas',['id_cliente'=> $user]," id = '{$query}'");
    }
	if(file_exists('../../../estoque.php')){
		foreach($_SESSION["car"] as $a => $b ){
			$db = DBRead('ecommerce_estoque', '*', "WHERE id = $b[3]")[0]; 
			$c = $db['estoque'] - $b[1];
			$produto = DBRead('ecommerce', '*', "WHERE id = $b[0]")[0]; 
			if($produto['diminuir_est'] == "sim"){
				$data5 = array(
				'estoque' => $c,
				);	
				DBUpdate('ecommerce_estoque', $data5, "id = $b[3]"); 
				
				if(is_array(DBRead('ecommerce_mercadolivre','*'))){
			        $MLtoken = DBRead('ecommerce_mercadolivre', '*')[0];
                    $curl = curl_init();
                   if(empty($db['id_va'])){
                       $tkml = $produto['id_ml'];
                       $body = '{
                        "available_quantity": '.$db['estoque'].'
                    }';
                   }else{
                       $tkml = $db['id_ml'];
                        $group =  DBRead('ecommerce_estoque', '*', "WHERE id_ml = '{$db['id_ml']}' ");
                        if(!empty($group)){
                            foreach($group as $chave => $cod){
                                $inside .= '{
                                    "id": '.$cod['id_va'].',
                                    "available_quantity": '.$cod['estoque'].'
                	            },';
                            }
                        }
                         $body = '{
                            "variations":  [
                            '.$inside.'
                            ]
                        }'; 
                    }
                   
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.mercadolibre.com/items/'.$tkml,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'PUT',
                      CURLOPT_POSTFIELDS =>$body,
                      CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                               'Authorization: Bearer '.$MLtoken['token'],
                      ),
                    ));
                    $response = curl_exec($curl);
                    
                    curl_close($curl);
				  
				  
				  
				    
				}
				if($c<=$db['min']){
					if($db['nome'] == null){
						$nome = $produto['nome'];
					}else{
						$nome = $db['nome'];
					}
					require('../../../controller/ecommerce/email_alerta.php');
				}
				$map[$b[3]] = $b[1];
			}
		}
		DBUpdate('ecommerce_vendas',['estorno'=> json_encode($map)]," id = '{$query}'");
	}
	$route = post('composer');
	if (!isset($_GET['transparente'])) {		
		require($route);
	}
}