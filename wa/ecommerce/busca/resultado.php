<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');

if(isset($_GET['b'])){
  $busca = $_GET['b'];
  $pag 		= (isset($_GET['pag']) && $_GET['pag'] != 'undefined' )? $_GET['pag'] : 1;
  $uniqid = uniqid();
  $tamanho_coluna = 3;
  $lista['mostrar_paginacao'] = 'S';

  $query = DBRead('ecommerce_config','*');
  $config = [];
  foreach ($query as $key => $row) {
    $config[$row['id']] = $row['valor'];
  }

  $contagem_registro 	= DBCount('ecommerce','*',"
  WHERE ecommerce.nome LIKE '%$busca%'
  OR ecommerce.palavras_chave LIKE '%$busca%'
  OR ecommerce.resumo LIKE '%$busca%'");

  $limite 		= $config['busca_limite_pagina'];
  $numPaginas = ceil($contagem_registro/$limite);
  $inicio 		= ($limite*$pag)-$limite;

  $produtos   = DBRead(
    'ecommerce',
    'ecommerce.*, ecommerce_prod_imagens.uniq as id_foto_capa',
    "INNER JOIN ecommerce_prod_imagens ON ecommerce.id_imagem_capa = ecommerce_prod_imagens.id
    WHERE ecommerce.nome LIKE '%$busca%'
    OR ecommerce.palavras_chave LIKE '%$busca%'
    OR ecommerce.resumo LIKE '%$busca%'
    LIMIT $inicio, $limite"
  );

  if(!empty($produtos)){
    // Escolhendo arquivo para o estilo
    switch ($config['listagem_estilo']) {
      case 1:
        require_once('../listagem/includes/estilo_1.php');
        break;

      case 2:
        require_once('../listagem/includes/estilo_2.php');
        break;

      case 3:
        require_once('../listagem/includes/estilo_3.php');
        break;

      case 4:
        require_once('../listagem/includes/estilo_4.php');
        break;

      case 5:
        require_once('../listagem/includes/estilo_5.php');
        break;

      default:
        require_once('../listagem/includes/estilo_1.php');
        break;
    }
    ?>
    <meta charset="UTF-8">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px">
    	<center>
    		<div class="btn-group" role="group" aria-label="...">
    			<?php $i = $pag; ?>
    			<?php if ($i <= '1') { ?>
    					<button type="hidden" class="btn btn-default btn-xs hidden" disabled>Anterior</button>
    			<?php } elseif ($i >= '2') { $i = $i - '1'; ?>
    					<button type="button" class="btn btn-default btn-xs" onclick="CatalogoProdutosBuscaResultado('<?php echo $i; ?>');">Anterior</button>
    			<?php } ?>
    				<?php $i = $pag; ?>
    			<?php if ($numPaginas >= '1' && $numPaginas < '9') { $numPaginas = '0'.$numPaginas; } elseif ($numPaginas > '9') { $numPaginas = $numPaginas; } ?>
    			<?php if ($i >= '1' && $i <= '9') { ?>
    					<button type="button" class="btn btn-default btn-xs" disabled>Página 0<?php echo $i; ?> de <?php echo $numPaginas; ?></button>
    			<?php } elseif ($i > '9') { ?>
    					<button type="button" class="btn btn-default btn-xs" disabled>Página <?php echo $i; ?> de <?php echo $numPaginas; ?></button>
    			<?php } ?>
    				<?php $i = $pag; ?>
    			<?php if ($i >= 1 && $i < $numPaginas) { $i++; ?>
    					<button type="button" class="btn btn-default btn-xs" onclick="CatalogoProdutosBuscaResultado('<?php echo $i; ?>');">Próximo</button>
    			<?php } elseif ($i == $numPaginas) { ?>
    					<button type="button" class="btn btn-default btn-xs hidden" disabled>Próximo</button>
    			<?php } ?>
    		</div>
    </div>
    <link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>/epack/css/elements/animate.css">
    <script>
    $(document).ready( function() {
    	$('#shop--list<?php echo $uniqid; ?> .shop--list--bar__view-grid').click(function(){
    		shopUpdateListView('<?php echo $uniqid; ?>', true, 'col-md-<?php echo $tamanho_coluna; ?>');
    	});
    	$('#shop--list<?php echo $uniqid; ?> .shop--list--bar__view-list').click(function(){
    		shopUpdateListView('<?php echo $uniqid; ?>', false, 'col-md-12');
    	});
    });
    </script>
    <?php
  }
  else{
    ?>
    Nenhum resultado para sua pesquisa foi encontrado!
    <?php
  }
}
?>
