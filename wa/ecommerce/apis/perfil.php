<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
require_once('../../../database/upload.class.php');
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
    /*if($_FILES['imagem']['name'] == null){
           $keep = DBRead('ead_usuario','*' ,"WHERE id = '{$id}'")[0];
           $path = $keep['imagem'];
        }else{
        $upload_folder = '../../../wa/ead/uploads/';
        $handle = new Upload($_FILES['imagem']);
        $handle->file_new_name_body = md5(uniqid(rand(), true));
        $handle->Process($upload_folder);
        $path = $handle->file_dst_name;
    }*/
    foreach($_POST as $chave => $vazio){
        $erro ="campo ".$chave." está vazio";
        if(empty($vazio)){
            $empty = 1; echo $erro; exit;
        }else{
            $data[$chave] = $vazio;
        }
    }
    $query = DBUpdate('ecommerce_usuario',$data," id = '{$id}'");
    
        if ($query != 0) {
            echo 1;
        } else {
            echo "Erro no Banco de Dados";
        }
    
}