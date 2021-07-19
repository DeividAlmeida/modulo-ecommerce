<?php header('Access-Control-Allow-Origin: *');
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
$id = $_GET['id'];
$id_produto = $_GET['radar'];

$prod_termos = DBRead('ecommerce_prod_termos', '*', "WHERE id = '{$id}'");
$termos = DBRead('ecommerce_termos', '*', "WHERE id = '{$prod_termos[0]["id_termo"]}'");
?>

<form method="POST" id="ajax_form" action="?EditarProdutoTermo=<?php echo $id; ?>">
  <div class="row">
    <div class="col-md-5">
      <!-- `termos` -->
      <div class="form-group">
        <label>Termos: </label>
        <input type="hidden" name="id_produto" value="<?php echo $id_produto; ?>">
        <input type="hidden" name="id_atributo" value="<?php echo $id; ?>">
        <select class="form-control produto-categorias" name="id_termo[]" multiple="multiple" disabled required>
          <?php foreach ($termos as $termos) { ?>
            <option value="<?php echo $termos['id']; ?>" <?php echo ($termos['id'] == $prod_termos[0]["id_termo"]) ? 'selected' : '' ?>><?php echo $termos['nome']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Estoque: </label>
        <input class="form-control" name="estoque" type="number" step="any" id="estoque" value="<?php echo $prod_termos[0]['estoque']; ?>" required>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>R$ Agregado: </label>
        <input class="form-control" name="valor" type="number" step="any" id="valor" value="<?php echo $prod_termos[0]['valor']; ?>" required>
      </div>
    </div>
  </div>
  <button type="submit" class="btnSubmit btn btn-primary float-right">Atualizar</button>
  <button type="button" id="produto-rem-rv6wwqr92" class="produto-rem-form btn btn-danger float-left" onclick="DeletarProdutoTermo<?php echo $id; ?>(this);" href="#!">Deletar</button>
  <script>
    function DeletarProdutoTermo<?php echo $id; ?>(t) {
      var xhttp = new XMLHttpRequest();
      xhttp.open("GET", "<?php echo ConfigPainel('base_url'); ?>/controller/ecommerce/produtos.php?DeletarProdutoTermo=<?php echo $id; ?>", true);
      xhttp.send();
      setTimeout(function() {
        $("#no-d").load('<?php echo ConfigPainel('base_url'); ?>/ecommerce/produtos/processa_termos_listados.php?radar=<?php echo $_GET['radar']; ?>')
      }, 1000);
    }
  </script>
</form>

<script>
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

  jQuery(document).ready(function() {
    jQuery('#ajax_form').submit(function() {
      var dados = jQuery(this).serialize();
      jQuery.ajax({
        type: "POST",
        url: "<?php echo ConfigPainel('base_url'); ?>/controller/ecommerce/produtos.php?EditarProdutoTermo=<?php echo $id; ?>",
        data: dados,
      });
      setTimeout(function() {
        $("#no-d").load('<?php echo ConfigPainel('base_url'); ?>/ecommerce/produtos/processa_termos_listados.php?radar=<?php echo $_GET['radar']; ?>', );
      }, 1000);
      return false;
    });
  });
</script>