<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
require_once('../../../database/upload.class.php');
$id = base64_decode($_GET['id']);
$email = $_GET['email'];
$query = DBUpdate('ecommerce_usuario',['email'=> $email]," id = '{$id}'");

if($query != 0){
    echo 1;
    }else{
    echo "Erro no Banco de Dados";
}