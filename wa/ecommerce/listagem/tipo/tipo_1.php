<?php
// Pegando informações da listagem (categorias da lista)
$categorias_lista = DBRead('ecommerce_lista_categoria','id_categoria',"WHERE id_lista = '{$id}'");

$ids_categoria = array();

if(!is_array($categorias_lista)){
  ?>
    <center>Insira uma categoria para exibir seus produtos.</center>
  <?php
  exit;
}
foreach ($categorias_lista as $linha) {
  array_push($ids_categoria, $linha['id_categoria']);
}
$ids_categoria = implode(",", $ids_categoria);

// Busca o produto baseado nos resultados anteriores
$lista_produtos = DBRead('ecommerce_prod_categorias','id_produto',"WHERE id_categoria IN ($ids_categoria)");

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
