<?php
if (isset($_GET['AdicionarItemLista'])) {
	require_once('ecommerce/listagens/item/add.php');
}if (isset($_GET['AdicionarMarcaLista'])) {
	require_once('ecommerce/listagens/item/add_marca.php');
}
require_once('includes/funcoes.php');
require_once('includes/header.php');
require_once('includes/menu.php');
require_once('controller/ecommerce.php');
$TitlePage = 'Ecommerce';
$UrlPage	 = 'Ecommerce.php';
?>

<div class="has-sidebar-left">
	<header class="blue accent-3 relative nav-sticky">
		<div class="container-fluid text-white">
			<div class="row p-t-b-10 ">
				<div class="col">
					<h4><i class="icon icon-shopping-bag"></i> <?php echo $TitlePage; ?></h4>
				</div>
			</div>
		</div>
	</header>

	<div class="container-fluid animatedParent animateOnce my-3">
		<div class="pb-3">

			<a class="btn btn-sm btn-primary" href="?">Inicio</a>

			<span class="dropdown">

			<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'listagem')) { ?>
					<a class="btn btn-sm btn-primary" href="?Vendas" >Vendas</a>
				<?php } ?>

				<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'listagem')) { ?>
					<a class="btn btn-sm btn-primary" href="#" data-toggle="dropdown">Listagens</a>
				<?php } ?>

				<div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start">
					<a class="dropdown-item" href="?">Listagens cadastradas</a>
					<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'listagem', 'adicionar')) { ?>
						<a class="dropdown-item" href="?AdicionarLista">Cadastrar Listagem</a>
					<?php } ?>
				</div>
			</span>

			<span class="dropdown">

			<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria')) { ?>
				<a class="btn btn-sm btn-primary" href="#" data-toggle="dropdown">Categorias</a>
			<?php } ?>

				<div class="dropdown-menu dropdown-menu-left" x-placement="bottom-end">
					<a class="dropdown-item" href="?ListarCategoria">Categorias cadastradas</a>
					<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'adicionar')) { ?>
						<a class="dropdown-item" href="?AdicionarCategoria">Cadastrar categoria</a>
					<?php } ?>
				</div>
			</span>

			<span class="dropdown">

			<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria')) { ?>
				<a class="btn btn-sm btn-primary" href="#" data-toggle="dropdown">Marcas</a>
			<?php } ?>

				<div class="dropdown-menu dropdown-menu-left" x-placement="bottom-end">
					<a class="dropdown-item" href="?ListarMarca">Marcas cadastradas</a>
					<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'adicionar')) { ?>
						<a class="dropdown-item" href="?AdicionarMarca">Cadastrar marca</a>
					<?php } ?>
				</div>
			</span>

			<span class="dropdown">

			<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria')) { ?>
				<a class="btn btn-sm btn-primary" href="#" data-toggle="dropdown">Atributos</a>
			<?php } ?>

				<div class="dropdown-menu dropdown-menu-left" x-placement="bottom-end">
					<a class="dropdown-item" href="?ListarAtributo">Atributos cadastrados</a>
					<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'adicionar')) { ?>
						<a class="dropdown-item" href="?AdicionarAtributo">Cadastrar atributo</a>
					<?php } ?>
				</div>
			</span>

			<span class="dropdown">
			<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'produto')) { ?>
				<a class="btn btn-sm btn-primary" href="#" data-toggle="dropdown">Produtos</a>
				<?php } ?>

				<div class="dropdown-menu dropdown-menu-left" x-placement="bottom">
					<a class="dropdown-item" href="?ListarProduto">Produtos cadastrados</a>

					<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'produto', 'adicionar')) { ?>
					<a class="dropdown-item" href="?AdicionarProduto">Cadastrar Produto</a>
<?php } ?>
				</div>
			</span>
			
			<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'configuracao', 'acessar')) { ?>
				<a class="btn btn-sm btn-primary" href="?Config">Configuração</a>
<?php } ?>
<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'codigo', 'acessar')) { ?>
			<button class="btn btn-sm behance text-white" data-toggle="modal" data-target="#Ajuda"><i class="icon-question-circle"></i></button>
<?php } ?>
		</div>

		<?php
		if (isset($_GET['Config'])) :
			require_once('ecommerce/configuracao.php');
		elseif (isset($_GET['AdicionarCategoria'])) :
			require_once('ecommerce/categorias/add.php');
		elseif (isset($_GET['EditarCategoria'])) :
			require_once('ecommerce/categorias/editar.php');
		elseif (isset($_GET['ListarCategoria'])) :
			require_once('ecommerce/categorias/listar.php');
		elseif (isset($_GET['AdicionarMarca'])) :
			require_once('ecommerce/marcas/add.php');
		elseif (isset($_GET['EditarMarca'])) :
			require_once('ecommerce/marcas/editar.php');
		elseif (isset($_GET['ListarMarca'])) :
			require_once('ecommerce/marcas/listar.php');
		elseif (isset($_GET['AdicionarAtributo'])) :
			require_once('ecommerce/atributos/add.php');
		elseif (isset($_GET['EditarAtributo'])) :
			require_once('ecommerce/atributos/editar.php');
		elseif (isset($_GET['ListarAtributo'])) :
			require_once('ecommerce/atributos/listar.php');
		elseif (isset($_GET['AdicionarTermo'])) :
			require_once('ecommerce/termos/add.php');
		elseif (isset($_GET['EditarTermo'])) :
			require_once('ecommerce/termos/editar.php');
		elseif (isset($_GET['ListarTermo'])) :
			require_once('ecommerce/termos/listar.php');
		elseif (isset($_GET['AdicionarProduto'])) :
			require_once('ecommerce/produtos/add.php');
		elseif (isset($_GET['EditarProduto'])) :
			require_once('ecommerce/produtos/editar.php');
		elseif (isset($_GET['ListarProduto'])) :
			require_once('ecommerce/produtos/listar.php');
		elseif (isset($_GET['AdicionarLista'])) :
			require_once('ecommerce/listagens/add.php');
		elseif (isset($_GET['EditarLista'])) :
			require_once('ecommerce/listagens/editar.php');
		elseif (isset($_GET['VisualizarLista'])) :
			require_once('ecommerce/listagens/item/listar.php');
		elseif (isset($_GET['Vendas'])) :
			require_once('ecommerce/vendas/vendas.php');
		elseif (isset($_GET['VisualizarListaMarca'])) :
			require_once('ecommerce/listagens/item/listar_marca.php');
		else :
			require_once('ecommerce/listagens/listar.php');
		endif;
		?>
		<div class="modal fade bd-example-modal-lg" id="modalAdicionarItemListagem" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content b-0">
					<div class="modal-header r-0 bg-primary">
						<h6 class="modal-title text-white" id="exampleModalLabel">Adicionar Produto na Listagem</h6>
						<a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
					</div>

					<div class="modal-body no-b">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="Ajuda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content b-0">
				<div class="modal-header r-0 bg-primary">
					<h6 class="modal-title text-white" id="exampleModalLabel">Informações de Sobre o Módulo</h6>
					<a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
				</div>

				<div class="modal-body">
					<p>
						1- Recomendamos desativar efeitos parallax em páginas onde o módulo será integrado.<br>
						2- Bloqueie o acesso somente as páginas matrizes pelo robots.txt para que não sejam indexadas.<br>
					</p>
					<hr />
					<h5>Tags de Integração:</h5>
					<table class="table table-bordered table-striped">
						<tr>
							<th>Referencia</th>
							<th>Tag</th>
						</tr>

						<tr>
							<td>Produto - Nome</td>
							<td>[WAC_ECOMMERCE_PROD_NOME]</td>
						</tr>

						<tr>
							<td>Produto - Descrição</td>
							<td>[WAC_ECOMMERCE_PROD_DESCRICAO]</td>
						</tr>

						<tr>
							<td>Produto - Cabeçalho</td>
							<td>[WAC_ECOMMERCE_PROD_CABECALHO]</td>
						</tr>

						<tr>
							<td>Produto - Palavras Chave</td>
							<td>[WAC_ECOMMERCE_PROD_PALAVRAS_CHAVES]</td>
						</tr>

						<tr>
							<td>Produto - Resumo</td>
							<td>[WAC_ECOMMERCE_PROD_RESUMO]</td>
						</tr>

						<tr>
							<td>Produto - URL do Produto</td>
							<td>[WAC_ECOMMERCE_PROD_URL]</td>
						</tr>

						<tr>
							<td>Produto - URL da imagem de destaque do Produto</td>
							<td>[WAC_ECOMMERCE_PROD_IMAGEM_URL]</td>
						</tr>

						<tr>
							<td>Produto - Listagem de produtos mais vistos</td>
							<td>[WAC_ECOMMERCE_LISTA_PROD_MAIS_VISTOS]</td>
						</tr>

						<tr>
							<td>Produto - Listagem de produtos relacionados</td>
							<td>[WAC_ECOMMERCE_LISTA_PROD_RELACIONADOS]</td>
						</tr>
					</table>
					<hr />

					<h5>Tags do Facebook SEO (Inserir nas Propriedades da Página em Custom meta tags):</h5>
					<code class="form-control" rows="5" readonly>
						&lt;meta property=&quot;og:title&quot; content=&quot;[WAC_ECOMMERCE_PROD_NOME]&quot; /&gt;<br />&lt;meta property=&quot;og:url&quot; content=&quot;[WAC_ECOMMERCE_PROD_URL]&quot; /&gt;<br />&lt;meta property=&quot;og:image&quot; content=&quot;[WAC_ECOMMERCE_PROD_IMAGEM_URL]&quot; /&gt;<br />&lt;meta property=&quot;og:description&quot; content=&quot;[WAC_ECOMMERCE_PROD_RESUMO]&quot; /&gt;
					</code>
					<em>Atenção: Incluir no local desejado na página matriz usando o código HTML.</em>
					<hr />
					
					<h5>Boas Práticas para uma boa indexação (SEO):</h5>
					<p>Tente utilizar esses dados como base para criar as postagens de modo que elas sejam bem indexadas pelo google:</p>
					<ul>
						<li>Titulo: Máx de 90 Caracteres</li>
						<li>Palavras Chaves: Máx de 200 Caracteres</li>
						<li>Resumo: Máx de 160 Caracteres</li>
					</ul>
					<hr />
					<h5>Para obter o cálculo correto do preço e prazo de entrega do frete siga as seguintes recomendações ao cadastrar o produto:</h5>
					<br><ul>
						<li>O comprimento não pode ser maior que 105 cm ou inferior a 16 cm.</li>
						<li>A largura não pode ser maior que 105 cm ou inferior a 11 cm.</li>
						<li>A altura não pode ser maior que 105 cm ou inferior a 2 cm.</li>
						<li>A soma resultante do comprimento + largura + altura não deve superar a 200 cm.</li>
					</ul>
				</div>
			</div>
		</div>

		<?php require_once('includes/footer.php'); ?>

		<script type="text/javascript">
			$("#DataTableListaProdutos").DataTable({
				"pageLength": 10,
				"processing": true,
				"serverSide": true,
				"ajax": "controller/ecommerce/produtos_listar.php",
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true,
				"columnDefs": [{
					"targets": 'no-sort',
					"orderable": false,
				}],
				"language": {
					"sEmptyTable": "Nenhum registro encontrado",
					"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
					"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
					"sInfoFiltered": "(Filtrados de _MAX_ registros)",
					"sInfoPostFix": "",
					"sInfoThousands": ".",
					"sLengthMenu": "Mostrar _MENU_ resultados por página",
					"sLoadingRecords": "Carregando...",
					"sProcessing": "Processando...",
					"sZeroRecords": "Nenhum registro encontrado",
					"sSearch": "Pesquisar",
					"oPaginate": {
						"sNext": "Próximo",
						"sPrevious": "Anterior",
						"sFirst": "Primeiro",
						"sLast": "Último"
					},
					"oAria": {
						"sSortAscending": ": Ordenar colunas de forma ascendente",
						"sSortDescending": ": Ordenar colunas de forma descendente"
					}
				}
			});
			$('#formAtualizarConfig').submit(function(e) {
				e.preventDefault();
				var data = $('#formAtualizarConfig').serialize();
				console.log(data);
				$.ajax({
					data: data,
					type: "POST",
					cache: false,
					url: "ecommerce.php?AtualizarConfig",
					beforeSend: function(data) {
						swal({
							title: 'Aguarde!',
							text: 'Estamos gerando as páginas dos produtos atualizadas.\nNão recarregue a página até a mensagem de sucesso.',
							type: "info",
							html: true,
							showConfirmButton: true
						});
					},
					complete: function(data) {
						swal("Configurações Atualizadas!", "Configuração salvas e matrizes atualizadas com sucesso!", "success")
					}
				});
			});
			$('.adicionarListagemItem').click(function() {
				var dataURL = $(this).attr('data-href');
				$('#modalAdicionarItemListagem .modal-body').load(dataURL, function() {
					$('#modalAdicionarItemListagem').modal({
						show: true
					});
				});
			});
			$(function() {
				$('[data-toggle="tooltip"]').tooltip();

				// Select da categoria
				$('.produto-categorias').select2();
				$('.produto-atributos').select2();				
				$('.produto-prod_relacionados').select2();
				$('.slider-layer-produto').select2();

				$("#ckbCheckAll").click(function() {
					$(".checkBoxClass").prop('checked', $(this).prop('checked'));
				});

				$(".checkBoxClass").change(function() {
					if (!$(this).prop("checked")) {
						$("#ckbCheckAll").prop("checked", false);
					}
				});
				$('#formActionProduto').submit(function(e) {
					var data = $(this).serializeArray();
					console.log(data);
					e.preventDefault();
					swal({
						title: "Você tem certeza?",
						text: "Deseja realmente deletar esses produtos?",
						type: "warning",
						buttons: {
							cancel: "Não",
							confirm: {
								text: "Sim",
								className: "btn-primary",
							},
						},
						closeOnCancel: false
					}).then(function(isConfirm) {
						if (isConfirm) {
							$('#formActionProduto').off("submit").submit();
						}
					});
				});
			});
		</script>

		<?php if (isset($_GET['AdicionarProduto']) || isset($_GET['EditarProduto'])) { ?>
			<script type="text/javascript" src="css_js/speakingurl.min.js"></script>
			<script type="text/javascript" src="css_js/jquery.stringtoslug.min.js"></script>
			<script type="text/javascript">
				// Função: Gerador de ID único
				var ID = function() {
					return Math.random().toString(36).substr(2, 9);
				};

				// Adiciona uma linha de foto no produto
				function addLinhaFotoProduto() {
					id = ID();
					$("#foto-wrapper tbody").append("\
				<tr id='foto-" + id + "'> \
					<td><input name='foto_" + id + "' type='file' accept='image/*' required/></td> \
					<td><input class='form-check-input' name='capa' type='radio' value='" + id + "' required> Capa do Produto</td> \
					<td><button type='button' id='produto-rem-" + id + "' class='produto-rem-form btn btn-sm btn-danger float-right'>Deletar</button></td> \
				</tr> \
			");
				}

				function ExcluirFotoProduto(id) {
					swal({
						title: "Você tem certeza?",
						text: "Deseja realmente deletar esta foto?",
						type: "warning",
						buttons: {
							cancel: "Não",
							confirm: {
								text: "Sim",
								className: "btn-primary",
							},
						},
						closeOnCancel: false
					}).then(function(isConfirm) {
						if (isConfirm) {
							$.ajax({
								type: "GET",
								cache: false,
								url: '?DeletarFotoProduto=' + id + '',
								success: function(data) {
									swal("Sucesso!", "A foto foi excluída com sucesso", "success");
									$("#foto-" + id).remove();

									contagem_fotos = $("#fotos-adicionadas-wrapper tbody tr").length;

									if (contagem_fotos == 0) {
										addLinhaFotoProduto();
									}
								}
							});
						} else {
							swal("Cancelado", "O procedimento foi cancelado", "error");
						}
					});
				}

				$(document).ready(function() {
					// Quando usuário clica em add foto, executa função de add foto
					$('#produto-add-foto').click(function() {
						addLinhaFotoProduto();
					});

					// Quando usuário clica em remover foto, executa função de excluir foto
					$('#foto-wrapper').on('click', '.produto-rem-form', function() {
						// Pega ID do botão
						btn_id = $(this).attr('id');

						// Pega o ID do ID
						id = btn_id.split("produto-rem-");

						// Remove a DIV com todos campos
						$("#foto-" + id[1]).remove();
					});

					// Input da URL do produto sem espaço
					$(".produto-nome").stringToSlug({
						setEvents: 'keyup keydown blur',
						getPut: ".produto-url"
					});

					// Sempre que muda o tipo do produto, habilita ou desabilita campos
					$('[name^="tipo"]').change(function() {
						if ($(this).val() == 'orcamento') {
							$('[name^="link_venda"]').attr({
								disabled: true,
								required: false
							});
						} else {
							$('[name^="link_venda"]').attr({
								disabled: false,
								required: true
							});
						}
					});
					<?php if (isset($_GET['AdicionarProduto'])) { ?>
						addLinhaFotoProduto();
					<?php } ?>
					<?php if (isset($_GET['EditarProduto'])) { ?>
						$('.produto-categorias').val([<?php echo $string_ids_categorias; ?>]).change();
						$('.produto-atributos').val([<?php echo $string_ids_marcas; ?>]).change();
						$('.produto-prod_relacionados').val([<?php echo $string_ids_prod_relacionado; ?>]).change();
					<?php } ?>
				});
			</script>
		<?php } ?>

		