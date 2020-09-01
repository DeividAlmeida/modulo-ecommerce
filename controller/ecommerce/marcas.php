<?php
//
// Marca
//
require_once('database/upload.class.php');
if(!$_SESSION['node']['id']){ die(); exit(); }
// Pasta para upload dos arquivos enviados
$upload_folder = 'wa/ecommerce/uploads/';

// Adicionar Marca
if (isset($_GET['AddMarca'])) {
  $handle = new Upload($_FILES['imagem']);
  $handle->file_new_name_body = md5(uniqid(rand(), true));
  $handle->Process($upload_folder);

  $data = array(
    'nome'            => post('nome'),
    'descricao'       => post('descricao'),
    'imagem' => $handle->file_dst_name
  );

  $query = DBCreate('ecommerce_marcas', $data);

  if ($query != 0) {
    Redireciona('?ListarMarca&sucesso');
  } else {
    Redireciona('?ListarMarca&erro');
  }
}

// Atualizar Marca
if (isset($_GET['AtualizarMarca'])) {


  $handle = new Upload($_FILES['imagem']);
  $handle->file_new_name_body = md5(uniqid(rand(), true));
  $handle->Process($upload_folder);

  $id   = get('AtualizarMarca');
  $data = array(
    'nome'      => post('nome'),
    'descricao' => post('descricao')

  );

  if($_FILES['imagem']['name'] == null){}else{
    $data5 = array(
      'imagem' => $handle->file_dst_name
    );
    $query5 = DBUpdate('ecommerce_marcas', $data5, "id = '{$id}'");
  }
  $query = DBUpdate('ecommerce_marcas', $data, "id = '{$id}'");
  if ($query != 0) {
    Redireciona('?ListarMarca&sucesso');
  } else {
    Redireciona('?ListarMarca&erro');
  }
}

// Excluir Marca
if (isset($_GET['DeletarMarca'])) {
  $id     = get('DeletarMarca');
  $query  = DBDelete('ecommerce_marcas',"id = '{$id}'");
  if ($query != 0) {
    Redireciona('?ListarMarca&sucesso');
  } else {
    Redireciona('?ListarMarca&erro');
  }
}
