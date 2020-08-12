<?php
//
// LISTAGEM
//

// Pasta para upload dos arquivos enviados
$upload_folder = 'wa/catalogo_produto/slider/uploads/';

// Adicionar Layer
if (isset($_GET['AddLayerSlider'])) {

  // Inicializa o upload do arquivo
  $handle = new Upload($_FILES['imagem']);

  // Item upload
  if ($handle->uploaded){
    $handle->file_overwrite = true;

    // Mantem o nome do arquivo baseado com a extensão dele
    if ($files['type'] == 'image/jpeg') {
      $handle->file_new_name_ext = 'jpg';
    } elseif ($files['type'] == 'image/png') {
      $handle->file_new_name_ext = 'png';
    } elseif ($files['type'] == 'image/gif') {
      $handle->file_new_name_ext = 'gif';
    }
  }

  $handle->file_new_name_body = md5(uniqid(rand(), true));
  $handle->Process($upload_folder);

  if ($handle->processed){

    $data = array(
      'id_slider'   => post('id_slider'),
      'id_produto'  => post('id_produto'),
      'nome'        => post('nome'),
      'cta'         => post('cta'),
      'imagem'      => $handle->file_dst_name
    );

    $query = DBCreate('ecommerce_slider_layer', $data);

    if ($query != 0) {
      Redireciona('?sucesso&VisualizarLayerSlider='.post('id_slider'));
    } else {
      Redireciona('?erro&VisualizarLayerSlider='.post('id_slider'));
    }
  }
  else{
    Redireciona('?erro&VisualizarSlider='.post('id_slider'));
  }
}
// Atualizar Slider
if (isset($_GET['AtualizarLayerSlider'])) {
  $id   = get('AtualizarLayerSlider');
  $data = array(
    'id_produto'  => post('id_produto'),
    'nome'        => post('nome'),
    'cta'         => post('cta')
  );

  if(!empty($_FILES['imagem']['name'])){
    // Inicializa o upload do arquivo
    $handle = new Upload($_FILES['imagem']);

    if ($handle->uploaded){
      $handle->file_overwrite = true;

      // Mantem o nome do arquivo baseado com a extensão dele
      if ($files['type'] == 'image/jpeg') {
        $handle->file_new_name_ext = 'jpg';
      } elseif ($files['type'] == 'image/png') {
        $handle->file_new_name_ext = 'png';
      } elseif ($files['type'] == 'image/gif') {
        $handle->file_new_name_ext = 'gif';
      }
    }

    $handle->file_new_name_body = md5(uniqid(rand(), true));
    $handle->Process($upload_folder);

    $data['imagem'] = $handle->file_dst_name;
  }

  $query = DBUpdate('ecommerce_slider_layer', $data, "id = '{$id}'");

  $i_query    = DBRead('ecommerce_slider_layer','*',"WHERE id = '{$id}'");
	$item       = $i_query[0];

  if ($query != 0) {
    Redireciona('?sucesso&VisualizarLayerSlider='.$item['id_slider']);
  } else {
    Redireciona('?erro&VisualizarLayerSlider='.$item['id_slider']);
  }
}



// Excluir Layer
if (isset($_GET['DeletarLayerSlider'])) {
  $id         = get('DeletarLayerSlider');
  $i_query    = DBRead('ecommerce_slider_layer','*',"WHERE id = '{$id}'");
	$item        = $i_query[0];

  $query = DBDelete('ecommerce_slider_layer',"id = '{$id}'");

//TODO:  Deletar fotos

  if ($query != 0) {
    Redireciona('?sucesso&VisualizarSlider='.$item['id_slider']);
  } else {
    Redireciona('?erro&VisualizarSlider='.$item['id_slider']);
  }
}


// Adicionar Slider
if (isset($_GET['AddSlider'])) {
  $data = array(
    'nome'             => post('nome'),
    'destino_click'    => post('destino_click'),
    'tempo_transicao'  => post('tempo_transicao'),
    'estilo'           => post('estilo')
  );

  $query = DBCreate('ecommerce_slider', $data);

  if ($query != 0) {
    Redireciona('?ListarSlider&sucesso');
  } else {
    Redireciona('?ListarSlider&erro');
  }
}

// Atualizar Slider
if (isset($_GET['AtualizarSlider'])) {
  $id   = get('AtualizarSlider');
  $data = array(
    'nome'             => post('nome'),
    'destino_click'    => post('destino_click'),
    'tempo_transicao'  => post('tempo_transicao'),
    'estilo'           => post('estilo')
  );

  $query = DBUpdate('ecommerce_slider', $data, "id = '{$id}'");

  if ($query != 0) {
    Redireciona('?ListarSlider&sucesso');
  } else {
    Redireciona('?ListarSlider&erro');
  }
}

// Excluir Slider
if (isset($_GET['DeletarSlider'])){
  $id     = get('DeletarSlider');
  $query  = DBDelete('ecommerce_slider',"id = '{$id}'");
  DBDelete('ecommerce_slider_layer',"id_slider = '{$id}'");

  //TODO:  Deletar fotos

  if ($query != 0) {
    Redireciona('?ListarSlider&sucesso');
  } else {
    Redireciona('?ListarSlider&erro');
  }
}
