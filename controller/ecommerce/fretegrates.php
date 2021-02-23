<?php 
if(isset($_GET['statusfretegrates'])){
    $status =$_GET['statusfretegrates'];
    if($status == "true"){
      $callback = "checked";
    }else{ $callback = ""; }
    $query  = DBUpdate('ecommerce_plugins', array('status' => $callback), "nome = 'fretegrates'");
  }

if(isset($_GET['fretegrates'])){
    $query  = DBUpdate('ecommerce_fretegrates', 
        array(
            'descricao'=> $_POST['descricao'],
            'valor'=> $_POST['valor']   
        ), "id = '1'");
}