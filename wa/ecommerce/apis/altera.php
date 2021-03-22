<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
require_once('../../../database/upload.class.php');
$id = base64_decode($_POST['Z']);
$senha = md5($_POST['senha']);
$query = DBUpdate('ecommerce_usuario',['senha'=> $senha]," id = '{$id}'");

if($query != 0){
    echo 1;
    }else{
    echo "Erro no Banco de Dados";
}