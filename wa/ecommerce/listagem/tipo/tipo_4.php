<?php
if($lista['mostrar_paginacao'] == 'S'){
  $contagem_registro 	= DBCount('ecommerce','*',"LIMIT ".$lista['paginacao']." ");

  $limite 		= $lista['paginacao'];
  $numPaginas = ceil($contagem_registro/$limite);
  $inicio 		= ($limite*$pag)-$limite;

  $produtos   = DBRead(
    'ecommerce',
    'ecommerce.*, ecommerce_prod_imagens.uniq as id_foto_capa',
    "INNER JOIN ecommerce_prod_imagens ON ecommerce.id_imagem_capa = ecommerce_prod_imagens.id
    ORDER BY ecommerce.id DESC
    LIMIT {$inicio}, {$limite}"
  );
}
else{
  $limite 		= $lista['paginacao'];

  $produtos   = DBRead(
    'ecommerce',
    'ecommerce.*, ecommerce_prod_imagens.uniq as id_foto_capa',
    "INNER JOIN ecommerce_prod_imagens ON ecommerce.id_imagem_capa = ecommerce_prod_imagens.id
    ORDER BY ecommerce.id DESC
    LIMIT $limite"
  );
}
