<?php
//
// Atributo
//

// Adicionar Atributo
if (isset($_GET['AddAtributo'])) {
  $data = array(
    'nome'            => post('nome'),
    'descricao'       => post('descricao')
  );

  $query = DBCreate('ecommerce_atributos', $data);

  if ($query != 0) {
    Redireciona('?ListarAtributo&sucesso');
  } else {
    Redireciona('?ListarAtributo&erro');
  }
}

// Atualizar Atributo
if (isset($_GET['AtualizarAtributo'])) {
  $id   = get('AtualizarAtributo');
  $data = array(
    'nome'      => post('nome'),
    'descricao' => post('descricao')
  );

  $query = DBUpdate('ecommerce_atributos', $data, "id = '{$id}'");
  if ($query != 0) {
    Redireciona('?ListarAtributo&sucesso');
  } else {
    Redireciona('?ListarAtributo&erro');
  }
}

// Excluir Atributo
if (isset($_GET['DeletarAtributo'])) {
  $id     = get('DeletarAtributo');
  $query  = DBDelete('ecommerce_atributos',"id = '{$id}'");
  if ($query != 0) {
    Redireciona('?ListarAtributo&sucesso');
  } else {
    Redireciona('?ListarAtributo&erro');
  }
}
