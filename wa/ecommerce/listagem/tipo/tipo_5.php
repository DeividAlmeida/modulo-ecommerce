<?php
// Pegando informações da listagem (marcas da lista)
$marcas_lista = DBRead('ecommerce_lista_marca','id_marca',"WHERE id_lista = '{$id}'");

$ids_marca = array();

if(!is_array($marcas_lista)){
  ?>
    <center>Insira uma marca para exibir seus produtos.</center>
  <?php
  exit;
}
foreach ($marcas_lista as $linha) {
  array_push($ids_marca, $linha['id_marca']);
}
$ids_marca = implode(",", $ids_marca);

// Busca o produto baseado nos resultados anteriores
$lista_produtos = DBRead('ecommerce_prod_marcas','id_produto',"WHERE id_marca IN ($ids_marca)");

$ids_produtos = array();
foreach ($lista_produtos as $linha) {
  array_push($ids_produtos, $linha['id_produto']);
}

if(count($ids_produtos) == 0){
  ?>
    <center>Não há produtos para exibir nessa listagem com essas configurações. Confira as configurações e os produtos cadastrados.</center>
  <?php
  exit;
}

if(is_array($ids_produtos)){
  $ids_produtos = implode(",", $ids_produtos);
}
else {
  $ids_produtos = false;
}

if($lista['mostrar_paginacao'] == 'S'){
  $contagem_registro 	= DBCount('ecommerce','*',"WHERE id IN ($ids_produtos) ORDER BY {$lista['ordenar_por']} {$lista['asc_desc']}");

  $limite 		= $lista['paginacao'];
  $numPaginas = ceil($contagem_registro/$limite);
  $inicio 		= ($limite*$pag)-$limite;

  if(!$ids_produtos){
    $produtos = array();
  }
  else{
    $produtos   = DBRead(
      'ecommerce',
      'ecommerce.*, ecommerce_prod_imagens.uniq as id_foto_capa',
      "INNER JOIN ecommerce_prod_imagens ON ecommerce.id_imagem_capa = ecommerce_prod_imagens.id
      WHERE ecommerce.id IN ($ids_produtos)
      ORDER BY ecommerce.{$lista['ordenar_por']} {$lista['asc_desc']}
      LIMIT {$inicio}, {$limite}"
    );
  }
}
else{
  if(!$ids_produtos){
    $produtos = array();
  }
  else{
    $limite 		= $lista['paginacao'];

    $produtos   = DBRead(
      'ecommerce',
      'ecommerce.*, ecommerce_prod_imagens.uniq as id_foto_capa',
      "INNER JOIN ecommerce_prod_imagens ON ecommerce.id_imagem_capa = ecommerce_prod_imagens.id
      WHERE ecommerce.id IN ($ids_produtos)
      ORDER BY ecommerce.{$lista['ordenar_por']} {$lista['asc_desc']}
      LIMIT $limite"
    );
  }
}
