<?php
//
// CATEGORIA
//

// Adicionar Categoria
if (isset($_GET['AddCategoria'])) {
  $data = array(
    'nome'            => post('nome'),
    'descricao'       => post('descricao')
  );

  $query = DBCreate('ecommerce_categorias', $data);

  if ($query != 0) {
    Redireciona('?ListarCategoria&sucesso');
  } else {
    Redireciona('?ListarCategoria&erro');
  }
}

// Atualizar Categoria
if (isset($_GET['AtualizarCategoria'])) {
  $id   = get('AtualizarCategoria');
  $data = array(
    'nome'      => post('nome'),
    'descricao' => post('descricao')
  );

  $query = DBUpdate('ecommerce_categorias', $data, "id = '{$id}'");
  if ($query != 0) {
    Redireciona('?ListarCategoria&sucesso');
  } else {
    Redireciona('?ListarCategoria&erro');
  }
}

// Excluir Categoria
if (isset($_GET['DeletarCategoria'])) {
  $id     = get('DeletarCategoria');
  $query  = DBDelete('ecommerce_categorias',"id = '{$id}'");
  if ($query != 0) {
    Redireciona('?ListarCategoria&sucesso');
  } else {
    Redireciona('?ListarCategoria&erro');
  }
}
