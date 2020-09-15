<?php
	header('Access-Control-Allow-Origin: *');
	require_once('../../../includes/funcoes.php');
	require_once('../../../database/config.database.php');
	require_once('../../../database/config.php');

  // Pegar listagem
  $id 		= get('id');
  $pag 		= (isset($_GET['pag']))? $_GET['pag'] : 1;
	$uniqid = uniqid();

  if (ModoManutencao()) { header("Location: ../manutencao.php"); }

	// Pega configuração
	$query = DBRead('ecommerce_config','*');

	$config = [];
	foreach ($query as $key => $row) {
		$config[$row['id']] = $row['valor'];
	}

  // Pegando informações da lista
  $query = DBRead('ecommerce_listas','*',"WHERE id = '{$id}'");
	$lista = $query[0];
	
	switch ($lista['tipo']) {
		// Categoria
		case '1':
			require_once('tipo/tipo_1.php');
			break;
		// Mais vistos
		case '2':
			require_once('tipo/tipo_2.php');
			break;
		// Mais vendidos
		case '3':
			require_once('tipo/tipo_3.php');
			break;
		// Mais recentes
		case '4':
			require_once('tipo/tipo_4.php');
			break;
		// Marcas	
		case '5':
			require_once('tipo/tipo_5.php');
			break;
		default:
			require_once('tipo/tipo_1.php');
	}

  
	// Definindo tamanho das colunas
	switch ($lista['colunas']) {
		case 2:
			$tamanho_coluna = 6;
			break;

		case 3:
			$tamanho_coluna = 4;
			break;

		case 4:
			$tamanho_coluna = 3;
			break;

		default:
			$tamanho_coluna = 6;
			break;
	}

	if($lista['carrocel'] == 'S'){
		require_once('includes/carousel.php');
	}
	else{
		// Escolhendo arquivo para o estilo
		switch ($config['listagem_estilo']) {
			case '1':
				require_once('includes/estilo_1.php');
				break;

			case '2':
				require_once('includes/estilo_2.php');
				break;

			case '3':
				require_once('includes/estilo_3.php');
				break;

			case '4':
				require_once('includes/estilo_4.php');
				break;

			case '5':
				require_once('includes/estilo_5.php');
				break;

			default:
				require_once('includes/estilo_1.php');
				break;
		}
	}
?>

<?php if($lista['mostrar_paginacao'] == 'S'){ ?>
	<meta charset="UTF-8">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px">
		<center>
			<div class="btn-group" role="group" aria-label="...">
				<?php $i = $pag; ?>
				<?php if ($i <= '1') { ?>
						<button type="hidden" class="btn btn-default btn-xs hidden" disabled>Anterior</button>
				<?php } elseif ($i >= '2') { $i = $i - '1'; ?>
						<button type="button" class="btn btn-default btn-xs" onclick="EcommerceListagem(<?php echo $id; ?>,'<?php echo $i; ?>');">Anterior</button>
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
						<button type="button" class="btn btn-default btn-xs" onclick="EcommerceListagem(<?php echo $id; ?>,'<?php echo $i; ?>');">Próximo</button>
				<?php } elseif ($i == $numPaginas) { ?>
						<button type="button" class="btn btn-default btn-xs hidden" disabled>Próximo</button>
				<?php } ?>
			</div>
	</div>
<?php } ?>

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
