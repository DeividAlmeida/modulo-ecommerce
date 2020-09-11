<?php
require_once('functions.php');


if(isset($_GET['UpdateQtd'])){
	$id = get('UpdateQtd');
	$qtd = get('qtd');
	$vlf = get('vlf');
	$pdt = get('pdt');
  CarrinhoUpdate($id, $qtd, $vlf, $pdt);
  exit();
}

if(isset($_GET['AddItem'])){
  $id = get('AddItem');
  $qtd = get('qtd');
  $vlf = get('vlf');
  $att = get('att');
  CarrinhoAddQtd($id, $qtd, $vlf, $att);
  exit();
}

if(isset($_GET['RemItem'])){
  $id = get('RemItem');
  CarrinhoRemItem($id, 1);
  exit();
}

if(isset($_GET['Saldo'])){
  $id = get('Saldo');
  $query   = DBRead('ecommerce','*',"WHERE id = '{$id}'");
  $dados   = $query[0];
  echo $dados['estoque'];
  exit();
}

