<?php
//session_start();
	require_once('database/config.php');
  	require_once('database/config.database.php');
  	require_once('includes/funcoes.php');

  	//$PERMISSION = GetPermissionsUser();

  	//return;
  	//if(!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'listagem', 'adicionar')){ Redireciona('./index.php'); }

	// ID Lista
	$id_lista 	= $_GET['AdicionarItemLista'];

	// Buscando as categorias do produto
	$lista_ids_categorias = DBRead('ecommerce_lista_categoria', 'id_categoria', "WHERE id_lista = {$id_lista}");

	// Varre todos os ID de categoria da lista, cria uma array, e transforma logo em seguida em uma string
	$id_categorias = array();

	if(!empty($lista_ids_categorias)){
		foreach ($lista_ids_categorias as $linha) {
			array_push($id_categorias, $linha['id_categoria']);
		}

		$id_categorias   = implode(",", $id_categorias);
		$categorias = DBRead('ecommerce_categorias','*', "WHERE id NOT IN ($id_categorias)");
	}
	else{
		$categorias = DBRead('ecommerce_categorias','*');
	}
?>
<form id="formItem" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-12">

			<!-- ID CATEGORIA -->
			<input name="id_lista" type="hidden" value="<?php echo $id_lista;?>">

			<!-- TITULO -->
			<div class="form-group">
				<label>Categorias: </label>
				<select class="form-control add-item-listagem-categorias" name="id_categoria" required>
					<?php foreach($categorias as $categoria){ ?>
						<option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nome']; ?></option>
					<?php } ?>
				</select>
			</div>

			<button class="btnSubmit btn btn-primary float-right" type="submit">Adicionar</button>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(function () {
		$('.add-item-listagem-categorias').select2({
    	minimumResultsForSearch: Infinity
		});
		$('[data-toggle="tooltip"]').tooltip();
		$('#formItem').submit(function (e) {
			// Para de enviar o formulario
			e.preventDefault();

			// Muda texto do botão e desabilita ele
			$("#formItem .btnSubmit").attr("disabled", true).html("Enviando...");

			// Pega formulario
			var form = $('#formItem')[0];

			// Cria um FormData
			var data = new FormData(form);

			// Faz solicitação via AJAX
			$.ajax({
				type: 				'POST',
				processData: 	false,
				contentType: 	false,
				cache: 				false,
				url: 					'?AddItemLista',
				data: 				data
			})
			.done(function() {
				$("#formItem .btnSubmit").attr("disabled", false).html("Adicionar");
				window.location.replace("?VisualizarLista=<?php echo $id_lista;?>");
			});
		});
	});
</script>

<?php exit(); ?>
