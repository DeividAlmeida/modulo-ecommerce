<?php header('Access-Control-Allow-Origin: *');
  require_once('../../includes/funcoes.php');
  require_once('../../database/config.database.php');
  require_once('../../database/config.php');
  $id = $_GET['id'];
  $termos = DBRead('ecommerce_termos','*',"WHERE id_atributo = '{$id}'"); ?>
 <form method="POST"  id="ajax_form" action="<?php echo ConfigPainel('base_url'); ?>/controller/ecommerce/produtos.php?AddProdutoTermo">     
    <div class="row">                               
        <div class="col-md-6">
          <!-- `termos` -->
          <div class="form-group">
            <label>Termos: </label>
            <input type="hidden" name="id_atributo" value="<?php echo $id;?>">
            <select class="form-control produto-categorias" name="id_termo[]" multiple="multiple" required>
              <?php foreach($termos as $termos){ ?>
                <option value="<?php echo $termos['id']; ?>"><?php echo $termos['nome']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Preço: </label>
            <input class="form-control" name="valor" type="number" step="any" id="valor" required>
          </div>
      </div>
    </div>
    <button type="submit" class="btnSubmit btn btn-primary float-right" >Adcionar</button>
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

          jQuery(document).ready(function(){
        jQuery('#ajax_form').submit(function(){  
            var dados = jQuery( this ).serialize();
            jQuery.ajax({
               type: "POST",
               url: "<?php echo ConfigPainel('base_url'); ?>/controller/ecommerce/produtos.php?AddProdutoTermo",
               data: dados,
               });setTimeout(function(){$("#no-d").load('<?php echo ConfigPainel('base_url'); ?>/ecommerce/produtos/processa_termos_listados.php?radar=<?php echo $_GET['radar']; ?>', )}, 1000);               
                return false;
                });
              });
          
        </script>