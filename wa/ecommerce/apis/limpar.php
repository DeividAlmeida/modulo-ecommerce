<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
require_once('../../../database/upload.class.php');

$token = md5(session_id());
if(isset($_GET['token']) && $_GET['token'] === $token) {
    if(isset($_SESSION['E-Wacontrol'])){
        $id = $_SESSION['E-Wacontrol'][0];
    }else 
        if(isset($_COOKIE['E-Wacontroltoken'])){
            $id =  $_COOKIE['E-Wacontrolid'];
   }else{
       $id = 0;
   }
$one = 1;
$delete = DBRead('ecommerce_vendas','*',"WHERE id_cliente = '{$id}' AND view NOT LIKE '%{$one}%'");
foreach($delete as $key => $value){
    $query = DBUpdate('ecommerce_vendas',['view'=> $value['view'].$one]," id_cliente = '{$id}' ");
}

    if($query != 0){
        echo 1;
        }else{
        echo "Erro no Banco de Dados";
    }
}