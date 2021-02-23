<?php 
if(isset($_GET['statusfretegratis'])){
    $status =$_GET['statusfretegratis'];
    if($status == "true"){
      $callback = "checked";
    }else{ $callback = ""; }
    $query  = DBUpdate('ecommerce_plugins', array('status' => $callback), "nome = 'fretegratis'");
  }

if(isset($_GET['fretegratis'])){
    $query  = DBUpdate('ecommerce_fretegratis', 
        array(
            'descricao'=> $_POST['descricao'],
            'valor'=> $_POST['valor']   
        ), "id = '1'");
}