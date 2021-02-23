<?php 
header('Access-Control-Allow-Origin: *');
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
$reading =  DBRead('ecommerce_motoboy','*')[0];
$motoboy = DBRead('ecommerce_plugins','*', "WHERE id = '1'")[0];
?>
<script src="css_js/jquery.multifield.min.js"></script>
<div class="card">
    <div class="card-header white">
        <strong>Configuração Meio de Pagamento</strong>
    </div>
    <div class="card-body">        
        <div id="input_group">              
            <div class="col-md-12"><button type="button" class="btn btn-primary btnAdd" style="margin-bottom: 15px;"><i class="icons icon-plus"></i></button></div>
            <?php $reads = json_decode($reading['tudo'], true); if(is_array($reads)): foreach($reads as $key => $read):  ?>
            <div class="groupItens">                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="usuario">Descrição:</label>
                            <input type="text" name="descricao[]"  class="form-control" placeholder="Ex.: Prazo de entrega 1 dia útil"  value="<?php echo $read['descricao']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="usuario">CEP Inicial:</label>
                            <input type="number" name="cep_inicial[]"  class="form-control" placeholder="CEP Inicial " value="<?php echo $read['cep_inicial']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="usuario">CEP Final:</label>
                            <input type="number" name="cep_final[]"class="form-control" placeholder="CEP Final" value="<?php echo $read['cep_final']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="usuario">Peso Mínimo:</label>
                            <input type="number" min="0" step="0.01" name="peso_inicial[]"  class="form-control" placeholder="Unidade de medida Kg" value="<?php echo $read['peso_inicial']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="usuario">Peso Máximo:</label>
                            <input type="number" min="0" step="0.01" name="peso_final[]"  class="form-control" placeholder="Unidade de medida Kg" value="<?php echo $read['peso_final']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="usuario">Valor:</label>
                            <input type="number"  min="0" step="0.01" name="valor[]"  class="form-control" placeholder="Valor do frete" value="<?php echo $read['valor']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label ></label>
                            <a type="submit"  class="form-control btn btn-danger btnRemove" style="display: inline !important;"><i class="icon-trash"></i></a>
                        </div>
                    </div> 
                </div>
            </div>
            <?php endforeach;  else : ?>
        <div class="groupItens">   
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="usuario">Descrição:</label>
                        <input type="text" name="descricao[]" id="descricao" class="form-control" placeholder="Ex.: Prazo de entrega 1 dia útil" >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="usuario">CEP Inicial:</label>
                        <input type="number" name="cep_inicial[]" id="cep_inicial" class="form-control" placeholder="CEP Inicial " >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="usuario">CEP Final:</label>
                        <input type="number"  name="cep_final[]" id="cep_final" class="form-control" placeholder="CEP Final" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="usuario">Peso Mínimo:</label>
                        <input type="number" name="peso_inicial[]" id="peso_inicial" class="form-control" placeholder="Unidade de medida Kg">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="usuario">Peso Máximo:</label>
                        <input type="number" step='0.01' name="peso_final[]" id="peso_final" class="form-control" placeholder="Unidade de medida Kg" >
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="usuario">Valor:</label>
                        <input type="number" step='0.01' name="valor[]" id="valor" class="form-control" placeholder="Valor do frete" >
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label ></label>
                        <a type="submit"  class="form-control btn btn-danger btnRemove"><i class="icon-trash"></i></a>
                    </div>
                </div> 
            </div>
            
            <?php endif ?>
        </div>
    </div>
<script>
    $('#mdep').submit(function(e) {
        e.preventDefault();            
        var data = $(this).serializeArray();
        $.ajax({
            async:   false,
            data: data,
            type: "POST",
            cache: false,
            url: "ecommerce.php?deposito",
            complete: function( data ){
                swal("Informações de pagamento Atualizadas!", "Informações de pagamento atualizadas com sucesso!", "success")
            }
        });
    });

    $( document ).ready(function() {
        $('#input_group').multifield({
            section: '.groupItens',
            btnAdd:'.btnAdd',
            btnRemove:'.btnRemove',
            locale:{
            "multiField": {
                "messages": {
                "removeConfirmation": "Deseja realmente remover este campo?"
                }
            }
            }
        });
        });
</script>