<?php
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
$query = DBRead('ecommerce_config','*');
$config = [];
  foreach ($query as $key => $row) {
    $config[$row['id']] = $row['valor'];
  }
require_once("PagSeguroLibrary/PagSeguroLibrary.php");


$resources = array_combine(array_keys($_POST['produto']), array_map(function ($qtd, $produto, $un_valor, $produto_pg) {
    return compact('qtd', 'produto', 'un_valor', 'produto_pg');
},$_POST['qtd'], $_POST['produto'], $_POST['un_valor'], $_POST['produto_pg']));
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
      'tipo_pagamento'=>post('payment_method')
    );
    $query = DBCreate('ecommerce_vendas', $data, true);
    $read = DBRead('ecommerce_vendas','*',"WHERE id = '{$query}'");
    
    
    $paymentRequest = new PagSeguroPaymentRequest(); 
    
    foreach($read as $r){
        $pdt = json_decode($r['produto'], true);
        foreach($pdt as $fds){
            
            $a = $fds['produto_pg'];
            $b = $fds['qtd'];
            $c = $fds['un_valor'];
            $paymentRequest->addItem($query, $a, $b, $c);
        }
    }

    if(post('tipo_entrega') == "Retirada na Loja"){}else{ $paymentRequest->addItem('0001', 'frete',  1, post('vl_frete')); }
    
    $paymentRequest->setCurrency("BRL"); 
    
    

    // Referenciando a transação do PagSeguro em seu sistema  
    $paymentRequest->setReference($query);  
    
    // URL para onde o comprador será redirecionado (GET) após o fluxo de pagamento $config['email_usuario'] 
    $paymentRequest->setRedirectUrl('https://www.teacherfelipe.com.br');
    
    // URL para onde serão enviadas notificações (POST) indicando alterações no status da transação  
    $paymentRequest->addParameter('notificationURL', 'https://www.teacherfelipe.com.br'); 
    
    /*$paymentRequest->addPaymentMethodConfig('CREDIT_CARD', 0.00, 'DISCOUNT_PERCENT');  
    $paymentRequest->addPaymentMethodConfig('EFT', 0.00, 'DISCOUNT_PERCENT');  
    $paymentRequest->addPaymentMethodConfig('BOLETO', 0.00, 'DISCOUNT_PERCENT');  
    $paymentRequest->addPaymentMethodConfig('DEPOSIT', 0.00, 'DISCOUNT_PERCENT');  
    $paymentRequest->addPaymentMethodConfig('BALANCE', 0.00, 'DISCOUNT_PERCENT');*/  
    
    try {  

        $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
        $checkoutUrl = $paymentRequest->register($credentials); 
        
        
        } catch (PagSeguroServiceException $e) {  
            die($e->getMessage());  
        }  


     if ($query != 0) {
    Redireciona($checkoutUrl);
  } else {
    Redireciona(var_dump($_POST));
  }
  exit;
}
   

 