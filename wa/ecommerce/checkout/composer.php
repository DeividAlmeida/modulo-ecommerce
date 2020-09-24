<?php 
session_start();
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
$query2 = DBRead('ecommerce_config','*');
$config = [];
  foreach ($query2 as $key => $row) {
    $config[$row['id']] = $row['valor'];
  }

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
      'vl_frete' => post('vl_frete')
    );
    $query = DBCreate('ecommerce_vendas', $data, true);
    $read = DBRead('ecommerce_vendas','*',"WHERE id = '{$query}'");
    require_once('../../../controller/ecommerce/email_vendedor.php');
    
    if( post('payment_method') == "Depósito"){require_once('../../../controller/ecommerce/email_cliente_retirada.php');}else{
    require_once('../../../controller/ecommerce/email_cliente.php');
    }
       
$route = post('composer');
require($route);
}