<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
require_once('../../../database/upload.class.php');
$senha = md5($_POST['senha']);
$upload_folder = '../../../wa/ead/uploads/';
$handle = new Upload($_FILES['imagem']);
$handle->file_new_name_body = md5(uniqid(rand(), true));
$handle->Process($upload_folder);
$path = $handle->file_dst_name;
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
    'senha'         =>$senha,
    'imagem'        =>$path,
    'data'          =>post('data')
);
$id = DBCreate('ecommerce_usuario', $data, true);
    if ($id != 0) {
        session_start();
        $_SESSION['Wacontrol'] = [$id, $senha];
        echo 1;
    } else {
        echo "Erro no Banco de Dados";
    }
}