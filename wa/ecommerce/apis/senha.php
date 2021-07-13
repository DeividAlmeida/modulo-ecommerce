<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
session_start();
$token = md5(session_id());
if(isset($_GET['token']) && $_GET['token'] === $token) {
    if(isset($_SESSION['E-Wacontrol'])){
       $id = $_SESSION['E-Wacontrol'][0];
        $senha = $_SESSION['E-Wacontrol'][1];
    }
    else if(isset($_COOKIE['E-Wacontroltoken'])){
        $id =  $_COOKIE['E-Wacontrolid'];
        $senha =  $_COOKIE['E-Wacontroltoken'];
    }
    $valida = DBRead('ecommerce_usuario','*' ,"WHERE id = '{$id}'")[0];
    
    if(!isset($_POST['senha_atual']) || md5($_POST['senha_atual']) != $valida['senha'] ){ echo 'Senha atual inválida'; exit;}
    
    
    if(is_array($valida)){
        $novasenha = md5(post('nova_senha'));
        $query = DBUpdate('ecommerce_usuario',['senha'=> $novasenha]," id = '{$id}'");
        if ($query != 0) {
            if(isset($_SESSION['E-Wacontrol'])){
                $_SESSION['E-Wacontrol'] = [$id, $novasenha];
                echo 1;
            }
            else if(isset($_COOKIE['E-Wacontroltoken'])){
                setcookie('E-Wacontrolid', $id, time() + (86400 * 30), "/");
                setcookie('E-Wacontroltoken', $novasenha, time() + (86400 * 30), "/");
                echo 1;
            }else{ echo "Erro interno";}
        } else {
            echo "Erro no Banco de Dados";
        }
    }
}