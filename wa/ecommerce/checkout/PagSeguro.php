<?php
require_once("PagSeguroLibrary/PagSeguroLibrary.php");
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
    
    

    if(post('tipo_entrega') == "Retirada na Loja" || post('tipo_entrega') == "Frete Grátis" ){}else{ 
        $paymentRequest->addItem('0001', 'frete',  1, post('vl_frete')); }
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
        
   

 