<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
require_once('../../../database/upload.class.php');
$senha = md5($_POST['senha']);
session_start();
$token = md5(session_id());
if(isset($_GET['token']) && $_GET['token'] === $token) {
    if(isset($_SESSION['Wacontrol'])){
        $id = $_SESSION['Wacontrol'][0];
        $senha = $_SESSION['Wacontrol'][1];
    }
    else if(isset($_COOKIE['Wacontroltoken'])){
        $id =  $_COOKIE['Wacontrolid'];
        $senha =  $_COOKIE['Wacontroltoken'];
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
        if(empty($vazio)){$empty = 1; echo $erro; exit;}else{$empty = 0;}
    }
    if($empty == 0){
    $data = array(
        'nome'          => post('nome'),
        'cpf'           => post('cpf'),
        'endereco'      => post('endereco'),
        'email'         =>post('email'),
        'imagem'        =>$path,
        'data'          =>post('data')
    );
    $query = DBUpdate('ead_usuario',$data," id = '{$id}'");
    
        if ($query != 0) {
            echo 1;
        } else {
            echo "Erro no Banco de Dados";
        }
    }
}