<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
require_once('../../../database/upload.class.php');
session_start();
$token = md5(session_id());
if(isset($_GET['token']) && $_GET['token'] === $token) {
   
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
    unset($_POST['email']);
    foreach($_POST as $chave => $vazio){
        $data[$chave] = $vazio;
    }
    $query = DBCreate('ecommerce_usuario', $data, true);
    
        if ($query != 0) {
            echo 1;
        } else {
            echo "Erro no Banco de Dados";
        }
    
}