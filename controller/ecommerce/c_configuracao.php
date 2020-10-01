<?php

//
// CONFIGURAÇÃO
//
require_once('matriz_produto/index.php');

if (isset($_GET['AtualizarMatrizesTodosProdutos'])) {
  try{
    atualizarMatrizesTodosProdutos();
    http_response_code(200);
    exit();
  } catch (\Exception $e) {
    http_response_code(500);
    exit();
  }
}
else if (isset($_GET['AtualizarConfig'])) {
  $campos = array(
    'pagina_carrinho', 
    'pagina_checkout',
    'produto_cor_texto_descricao',   
    'matriz_produto',
    'pagina_resultado_busca',
    'listagem_cor_titulo',
    'listagem_cor_preco',
    'listagem_cor_borda',
    'listagem_cor_botao',
    'listagem_cor_hover_botao',
    'listagem_cor_filtro',
    'listagem_estilo',
    'btn_carrinho_cor_btn_meu_carrinho',
    'btn_carrinho_cor_fundo',
    'btn_carrinho_cor_texto',
    'btn_carrinho_cor_btn_ver_carrinho',
    'btn_carrinho_cor_hover_btn_ver_carrinho',
    'btn_carrinho_cor_texto_btn_ver_carrinho',
    'busca_btn_tipo',
    'busca_btn_cor',
    'busca_btn_cor_hover',
    'busca_btn_cor_texto',
    'busca_btn_tamanho',
    'busca_limite_pagina',
    'produto_cor_titulo',
    'produto_cor_preco',
    'produto_cor_descricao',
    'produto_cor_botao',
    'produto_cor_hover_botao',
    'produto_cor_texto_botao',
    'produto_cor_tag_categoria',
    'produto_cor_texto_tag_categoria',
    'carrocel_cor_btn',
    'carrocel_cor_btn_texto',
    'carrocel_cor_hover_btn',
    'carrocel_cor_titulo',
    'carrocel_cor_hover_titulo',
    'carrocel_cor_descricao',
    'carrocel_cor_setas',
    'carrocel_cor_hover_setas',
    'carrinho_cor_btns',
    'carrinho_cor_btn_finalizar',
    'moeda'
  );

  foreach($campos as $campo){
    DBUpdate('ecommerce_config', array('valor' => post($campo)), "id = '$campo'");
  }

  try{
    atualizarMatrizesTodosProdutos();
    http_response_code(200);
    exit();
  } catch (\Exception $e) {
    http_response_code(500);
    exit();
  }
}
if(isset($_GET['editaEmail'])){
  $data = array(
    'nome'                  => post('nome'),
    'remetente'             => post('remetente'),
    't_pagamento_pendente'  => post('t_pagamento_pendente'),
    'pagamento_pendente'    => post('pagamento_pendente'),
    't_processando'         => post('t_processando'),
    'processando'           => post('processando'),
    't_aguardando'          => post('t_aguardando'),
    'aguardando'            => post('aguardando'),
    't_pedido_enviado'      => post('t_pedido_enviado'),
    'pedido_enviado'        => post('pedido_enviado'),
    't_concluido'           => post('t_concluido'),
    'concluido'             => post('concluido'),
    't_cancelado'           => post('t_cancelado'),
    'cancelado'             => post('cancelado'),
    't_reembolsado'         => post('t_reembolsado'),
    'reembolsado'         => post('reembolsado'),
    'email_usuario'         => post('email_usuario'),
    'email_senha'           => post('email_senha'),
    'email_porta'           => post('email_porta'),
    'email_servidor'        => post('email_servidor'),
    'email_protocolo_seguranca' => post('email_protocolo_seguranca')

  );
  $query  = DBUpdate('ecommerce_config_email', $data, "id = '1'");
}
if(isset($_GET['editaEntrega'])){
  $data = array(
    'estado'         => post('estado'),
    'cidade'         => post('cidade'),
    'bairro'         => post('bairro'),
    'rua'            => post('rua'),
    'numero'         => post('numero'),
    'cep'            => post('cep'),
    'telefone'       => post('telefone'),
    'email'          => post('email'),
    'complemento'    => post('complemento')

  );
  $query  = DBUpdate('ecommerce_config_entrega', $data, "id = '1'");
}


if(isset($_GET['statusEntrega'])){
  $status =$_GET['statusEntrega'];
  if($status == "true"){
    $callback = "checked";
  }else{ $callback = ""; }
  $query  = DBUpdate('ecommerce_config_entrega', array('entrega' => $callback), "id = '1'");
}

if(isset($_GET['statusRetirada'])){
  $status =$_GET['statusRetirada'];
  if($status == "true"){
    $callback = "checked";
  }else{ $callback = ""; }
  $query  = DBUpdate('ecommerce_config_entrega', array('retirada' => $callback), "id = '1'");
}

if(isset($_GET['pagseguro'])){
  $data = array(
    'email'         => post('email'),
    'token'         => post('token')
  );
  $query  = DBUpdate('ecommerce_config_pagseguro', $data, "id = '1'");
}

if(isset($_GET['statusPagseguro'])){
  $status =$_GET['statusPagseguro'];
  if($status == "true"){
    $callback = "checked";
  }else{ $callback = ""; }
  $query  = DBUpdate('ecommerce_config_pagseguro', array('status' => $callback), "id = '1'");
}

if(isset($_GET['deposito'])){

  $resources = array_combine(array_keys($_POST['nome']), array_map(function ($nome, $conta, $banco, $agencia) {
    return compact('nome', 'conta', 'banco', 'agencia');
    },$_POST['nome'], $_POST['conta'], $_POST['banco'], $_POST['agencia']));
    $_POST['dtl'] = json_encode($resources, JSON_FORCE_OBJECT);

  $data = array(
    'titulo'       => post('titulo'),
    'descricao'    => post('descricao'),
    'instucoes'    => post('instucoes'),
    'descricao'    => post('descricao'),
    'detalhes'    => $_POST['dtl']
  );
  $query  = DBUpdate('ecommerce_config_deposito', $data, "id = '1'");
}

if(isset($_GET['statusDeposito'])){
  $status =$_GET['statusDeposito'];
  if($status == "true"){
    $callback = "checked";
  }else{ $callback = ""; }
  $query  = DBUpdate('ecommerce_config_deposito', array('status' => $callback), "id = '1'");
}

if(isset($_GET['editaLink'])){
  $upload_folder = 'wa/ecommerce/uploads/';
  $handle = new Upload($_FILES['img']);
  $handle->file_new_name_body = md5(uniqid(rand(), true));
  $handle->Process($upload_folder);

  $data = array(
    'cabecalho'       => post('cabecalho'),
    'texto'           => post('texto')
  );

  $query  = DBUpdate('ecommerce_config_link', $data, "id = '1'");
  if(empty($_FILES['img']['name'])){}else{DBUpdate('ecommerce_config_link', array('logo'   => $handle->file_dst_name), "id = '1'");}
 
}