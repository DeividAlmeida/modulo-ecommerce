<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
$manter = $_POST['manter'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);
$valida = DBRead('ecommerce_usuario','*',"WHERE email = '{$email}' AND  senha = '{$senha}' ", "LIMIT 1")[0];
if(empty($valida)){
   echo 'E-mail ou senha inválido!';
}else{
    session_start();
    $id = $valida['id'];
    if($manter == 'false'){
        $_SESSION['Wacontrol'] = [$id, $senha];
    }else{
        setcookie('Wacontrolid', $id, time() + (86400 * 30), "/");
        setcookie('Wacontroltoken', $senha, time() + (86400 * 30), "/"); 
    }
        echo 1;
}

