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
    'email_recebimento',
    'email_usuario',
    'email_senha',
    'email_porta',
    'email_servidor',
    'email_protocolo_seguranca',
    'email_disparo',
    'email_recebimento',
    'email_cor_bg',
    'email_cor_header_bg',
    'email_cor_header_texto',
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
    'produto_cor_texto_descricao',
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
    'cep_origem',
    'pagina_checkout',

  );

  

  foreach($campos as $campo){
    DBUpdate('ecommerce_config', array('valor' => $campo), "id = '$campo'");
  }
  exit();
  
}
