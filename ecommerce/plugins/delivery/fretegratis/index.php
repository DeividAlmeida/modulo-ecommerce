<?php 
header('Access-Control-Allow-Origin: *');
require_once('../../../../includes/funcoes.php');
require_once('../../../../database/config.database.php');
require_once('../../../../database/config.php');
$read =  DBRead('ecommerce_fretegratis','*')[0];
$fretegratis = DBRead('ecommerce_plugins','*', "WHERE id = '4'")[0];
?>
<div class="card">
    <div class="card-header white">
        <strong>Configuração Meio de Entrega</strong>
    </div>
    <form id="free" method="post" onsubmit="return false">
    <div class="card-body">                         
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="usuario">Descrição:</label>
                    <input type="text" name="descricao"  class="form-control" placeholder="Ex.: Prazo de entrega 1 dia útil"  value="<?php echo $read['descricao']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="usuario">Valor:</label>
                    <input type="number" min="0" step="0.01" name="valor"  class="form-control" placeholder="A partir desse valor o frete será grátis" value="<?php echo $read['valor']; ?>">
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<script>
function post(){
    let m = new XMLHttpRequest();
    let form = new FormData();
    let f = document.getElementById('free');
    let inputs = f.querySelectorAll('input');
    for(let i = 0; i < inputs.length; i++ ){ 
        form.append(inputs[i].name, inputs[i].value)
        
    };
    m.open("POST", "ecommerce.php?fretegratis");
    m.send(form);
    m.onprogress = function () {
        swal("Informações Atualizadas!", "Informações atualizadas com sucesso!", "success")
    };
}
</script>       
     