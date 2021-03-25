<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
$manter = file_get_contents('php://input');
$email = $_SERVER['PHP_AUTH_USER'];
$senha = md5($_SERVER['PHP_AUTH_PW']);
$valida = DBRead('ecommerce_usuario','*',"WHERE email = '{$email}' AND  senha = '{$senha}' ", "LIMIT 1")[0];
if(empty($valida)){
    header('HTTP/1.0 401 Unauthorized');
    echo 'E-mail ou senha inválido!';
}else{
    session_start();
    $id = $valida['id'];
    if($manter == 'false'){
        $_SESSION['E-Wacontrol'] = [$id, $senha];
    }else{
        setcookie('E-Wacontrolid', $id, time() + (86400 * 30), "/");
        setcookie('E-Wacontroltoken', $senha, time() + (86400 * 30), "/"); 
    }
        echo 1;
}
