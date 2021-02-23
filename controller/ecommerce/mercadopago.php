<?php 
if(isset($_GET['statusmercadopago'])){
    $status =$_GET['statusmercadopago'];
    if($status == "true"){
      $callback = "checked";
    }else{ $callback = ""; }
    $query  = DBUpdate('ecommerce_plugins', array('status' => $callback), "nome = 'mercadopago'");
  }

  if(isset($_GET['mercadopago'])){
  $query  = DBUpdate('ecommerce_mercadopago', array('token' => $_GET['token']), "id = '1'");
}