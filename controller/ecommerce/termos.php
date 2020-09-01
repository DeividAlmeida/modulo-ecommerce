<?php
//
// Termo
//

// Adicionar Termo
if (isset($_GET['AddTermo'])) {
  $id   = get('AddTermo');
  $data = array(
    'nome'            => post('nome'),
    'id_atributo'       => $id
  );

  $query = DBCreate('ecommerce_termos', $data);

  if ($query != 0) {
    Redireciona('?ListarAtributo&sucesso');
  } else {
    Redireciona('?ListarAtributo&erro');
  }
}

// Atualizar Termo
if (isset($_GET['AtualizarTermo'])) {
  $id   = get('AtualizarTermo');
  $data = array(
    'nome'      => post('nome'),
  );

  $query = DBUpdate('ecommerce_termos', $data, "id = '{$id}'");
  if ($query != 0) {
    Redireciona('?ListarAtributo&sucesso');
  } else {
    Redireciona('?ListarAtributo&erro');
  }
}

// Excluir Termo
if (isset($_GET['DeletarTermo'])) {
  $id     = get('DeletarTermo');
  $query  = DBDelete('ecommerce_termos',"id = '{$id}'");
  if ($query != 0) {
    Redireciona('?ListarAtributo&sucesso');
  } else {
    Redireciona('?ListarAtributo&erro');
  }
}
