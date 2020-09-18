<?php
//
// LISTAGEM
//

// Adicionar Categoria
if (isset($_GET['AddItemLista'])) {
  $data = array(
    'id_lista'           => post('id_lista'),
    'id_categoria'       => post('id_categoria')
  );

  $query = DBCreate('ecommerce_lista_categoria', $data);

  if ($query != 0) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
}

// Excluir Categoria
if (isset($_GET['DeletarCategoriaLista'])) {
  $id         = get('DeletarCategoriaLista');
  $i_query    = DBRead('ecommerce_lista_categoria','*',"WHERE id = '{$id}'");
	$item        = $i_query[0];

  $query = DBDelete('ecommerce_lista_categoria',"id = '{$id}'");

  if ($query != 0) {
    Redireciona('?sucesso&VisualizarLista='.$item['id_lista']);
  } else {
    Redireciona('?erro&VisualizarLista='.$item['id_lista']);
  }
}

// Adicionar Marca
if (isset($_GET['AddMarcaLista'])) {
  $data = array(
    'id_lista'           => post('id_lista'),
    'id_marca'       => post('id_marca')
  );

  $query = DBCreate('ecommerce_lista_marca', $data);

  if ($query != 0) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
}

// Excluir Marca
if (isset($_GET['DeletarmarcaLista'])) {
  $id         = get('DeletarmarcaLista');
  $i_query    = DBRead('ecommerce_lista_marca','*',"WHERE id = '{$id}'");
  $item        = $i_query[0];

  $query = DBDelete('ecommerce_lista_marca',"id = '{$id}'");

  if ($query != 0) {
    Redireciona('?sucesso&VisualizarListaMarca='.$item['id_lista']);
  } else {
    Redireciona('?erro&VisualizarListaMarca='.$item['id_lista']);
  }
}

// Adicionar Lista
if (isset($_GET['AddLista'])) {
  $data = array(
    'titulo'              => post('titulo'),
    'ordenar_por'         => post('ordenar_por'),
    'asc_desc'            => post('asc_desc'),
    'colunas'             => post('colunas'),
    'mostrar_paginacao'   => post('mostrar_paginacao'),
    'mostrar_filtro'      => post('mostrar_filtro'),
    'paginacao'           => post('paginacao'),
    'carrocel'            => post('carrocel'),
    'efeito'              => post('efeito'),
    'tipo'                => post('tipo')
  );

  $query = DBCreate('ecommerce_listas', $data);

  if ($query != 0) {
    Redireciona('?&sucesso');
  } else {
    Redireciona('?&erro');
  }
}

if (isset($_GET['DuplicarLista'])) {
  $id         = get('DuplicarLista');
  $query      = DBRead('ecommerce_listas','*',"WHERE id = '{$id}'");
  $lista      = $query[0];
  unset($lista['id']);

  $query = DBCreate('ecommerce_listas', $lista);

  if ($query != 0) {
    Redireciona('?&sucesso');
  } else {
    Redireciona('?&erro');
  }
}

// Atualizar Lista
if (isset($_GET['AtualizarLista'])) {
  $id   = get('AtualizarLista');
  $data = array(
    'titulo'              => post('titulo'),
    'ordenar_por'         => post('ordenar_por'),
    'asc_desc'            => post('asc_desc'),
    'colunas'             => post('colunas'),
    'mostrar_paginacao'   => post('mostrar_paginacao'),
    'mostrar_filtro'      => post('mostrar_filtro'),
    'paginacao'           => post('paginacao'),
    'carrocel'            => post('carrocel'),
    'efeito'              => post('efeito'),
    'tipo'                => post('tipo')
  );

  $query = DBUpdate('ecommerce_listas', $data, "id = '{$id}'");

  if ($query != 0) {
    Redireciona('?&sucesso');
  } else {
    Redireciona('?&erro');
  }
}

// Excluir Lista
if (isset($_GET['DeletarLista'])) {
  $id     = get('DeletarLista');
  $query  = DBDelete('ecommerce_listas',"id = '{$id}'");
  DBDelete('ecommerce_lista_categoria',"id_lista = '{$id}'");
  if ($query != 0) {
    Redireciona('?&sucesso');
  } else {
    Redireciona('?&erro');
  }
}
