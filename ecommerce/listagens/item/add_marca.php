<?php
//session_start();
	require_once('database/config.php');
  	require_once('database/config.database.php');
  	require_once('includes/funcoes.php');

  	//$PERMISSION = GetPermissionsUser();

  	//return;
  	//if(!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'listagem', 'adicionar')){ Redireciona('./index.php'); }

	// ID Lista
	$id_lista 	= $_GET['AdicionarMarcaLista'];

	// Buscando as marcas do produto
	$lista_ids_marcas = DBRead('ecommerce_lista_marca', 'id_marca', "WHERE id_lista = {$id_lista}");

	// Varre todos os ID de marca da lista, cria uma array, e transforma logo em seguida em uma string
	$id_marcas = array();

	if(!empty($lista_ids_marcas)){
		foreach ($lista_ids_marcas as $linha) {
			array_push($id_marcas, $linha['id_marca']);
		}

		$id_marcas   = implode(",", $id_marcas);
		$marcas = DBRead('ecommerce_marcas','*', "WHERE id NOT IN ($id_marcas)");
	}
	else{
		$marcas = DBRead('ecommerce_marcas','*');
	}
?>
<form id="formItem" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-12">

			<!-- ID marca -->
			<input name="id_lista" type="hidden" value="<?php echo $id_lista;?>">

			<!-- TITULO -->
			<div class="form-group">
				<label>Marcas: </label>
				<select class="form-control add-item-listagem-marcas" name="id_marca" required>
					<?php foreach($marcas as $marca){ ?>
						<option value="<?php echo $marca['id']; ?>"><?php echo $marca['nome']; ?></option>
					<?php } ?>
				</select>
			</div>

			<button class="btnSubmit btn btn-primary float-right" type="submit">Adicionar</button>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(function () {
		$('.add-item-listagem-marcas').select2({
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
				url: 					'?AddMarcaLista',
				data: 				data
			})
			.done(function() {
				$("#formItem .btnSubmit").attr("disabled", false).html("Adicionar");
				window.location.replace("?VisualizarListaMarca=<?php echo $id_lista;?>");
			});
		});
	});
</script>

<?php exit(); ?>
