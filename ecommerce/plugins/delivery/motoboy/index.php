<?php 
header('Access-Control-Allow-Origin: *');
require_once('../../../../includes/funcoes.php');
require_once('../../../../database/config.database.php');
require_once('../../../../database/config.php');
$reading =  DBRead('ecommerce_motoboy','*')[0];
$motoboy = DBRead('ecommerce_plugins','*', "WHERE id = '1'")[0];
?>
<script src="css_js/jquery.multifield.min.js"></script>
<div class="card">
    <div class="card-header white">
        <strong>Configuração Meio de Entrega</strong>
    </div>
    <form id="dedicado" method="post" onsubmit="return false">
        <div class="card-body">        
            <div id="input_group">              
                <div class="col-md-12"><button type="button" class="btn btn-primary btnAdd" style="margin-bottom: 15px;"><i class="icons icon-plus"></i></button></div>
                <?php $reads = json_decode($reading['tudo'], true); if(is_array($reads)): foreach($reads as $key => $read):  ?>
                <div class="groupItens">                
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="usuario">Descrição:</label>
                                <input required type="text" name="descricao[]"  class="form-control" placeholder="Ex.: Prazo de entrega 1 dia útil"  value="<?php echo $read['descricao']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="usuario">CEP Inicial:</label>
                                <input required minlength="8" maxlength="8" type="number" name="cep_inicial[]"  class="form-control" placeholder="CEP Inicial " value="<?php echo $read['cep_inicial']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="usuario">CEP Final:</label>
                                <input required minlength="8" maxlength="8" type="number" name="cep_final[]"class="form-control" placeholder="CEP Final" value="<?php echo $read['cep_final']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="usuario">Peso Mínimo: <i class="icon icon-question-circle tooltips" data-tooltip="Unidade de media (Kg)"><span class="inner">Unidade de media (Kg)</span></i></label>
                                <input required type="number" min="0" step="0.01" name="peso_inicial[]"  class="form-control" placeholder="Ex.: 0,1" value="<?php echo $read['peso_inicial']; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="usuario">Peso Máximo: <i class="icon icon-question-circle tooltips" data-tooltip="Unidade de media (Kg)"><span class="inner">Unidade de media (Kg)</span></i></label>
                                <input required type="number" min="0" step="0.01" name="peso_final[]"  class="form-control" placeholder="Ex.: 0,5" value="<?php echo $read['peso_final']; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="usuario">Valor:</label>
                                <input required type="number"  min="0" step="0.01" name="valor[]"  class="form-control" placeholder="Valor do frete" value="<?php echo $read['valor']; ?>">
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
                            <input required type="text" name="descricao[]" id="descricao" class="form-control" placeholder="Ex.: Prazo de entrega 1 dia útil" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="usuario">CEP Inicial:</label>
                            <input required type="number" required minlength="8" maxlength="8" name="cep_inicial[]" id="cep_inicial" class="form-control" placeholder="CEP Inicial " >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="usuario">CEP Final:</label>
                            <input required type="number" required minlength="8" maxlength="8"  name="cep_final[]" id="cep_final" class="form-control" placeholder="CEP Final" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="usuario">Peso Mínimo: <i class="icon icon-question-circle tooltips" data-tooltip="Unidade de media (Kg)"><span class="inner">Unidade de media (Kg)</span></i></label>
                            <input required type="number" name="peso_inicial[]" id="peso_inicial" class="form-control" placeholder="Ex.: 0,1">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="usuario">Peso Máximo: <i class="icon icon-question-circle tooltips" data-tooltip="Unidade de media (Kg)"><span class="inner">Unidade de media (Kg)</span></i></label>
                            <input required type="number" step='0.01' name="peso_final[]" id="peso_final" class="form-control" placeholder="Ex.: 0,6" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="usuario">Valor:</label>
                            <input required type="number" step='0.01' name="valor[]" id="valor" class="form-control" placeholder="Valor do frete" >
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
    </form>
</div>
    
<script>
function post(){
    let m = new XMLHttpRequest();
    let form = new FormData();
    let f = document.getElementById('dedicado');
    let inputs = f.querySelectorAll('input');
    for(let i = 0; i < inputs.length; i++ ){ 
        form.append(inputs[i].name, inputs[i].value)
        
    };
    m.open("POST", "ecommerce.php?motoboy");
    m.send(form);
    m.onprogress = function () {
        swal("Informações Atualizadas!", "Informações atualizadas com sucesso!", "success")
    };
}
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