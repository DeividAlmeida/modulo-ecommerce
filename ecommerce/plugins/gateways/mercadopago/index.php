<?php 
header('Access-Control-Allow-Origin: *');
require_once('../../../../includes/funcoes.php');
require_once('../../../../database/config.database.php');
require_once('../../../../database/config.php');
$read =  DBRead('ecommerce_mercadopago','*', "WHERE id = '1'")[0];
$mercadopago = DBRead('ecommerce_plugins','*', "WHERE nome = 'mercadopago'")[0];
?>

<div class="card">
    <div class="card-header white">
    <strong>Configurar Meio de Pagamento</strong>
    <button class="btn btn-sm behance text-white" data-toggle="modal" data-target="#AjudaMP"><i class="icon-question-circle"></i></button>
</div>
<div class="card-body">        
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="usuario">Token de Acesso:</label>
                <input type="text" name="token" id="token" class="form-control" placeholder="Coloque o seu access token" value="<?php echo $read['token']; ?>">
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-primary" type="submit" onclick="mercadopago()"><i class="icon icon-floppy-o" ></i>Salvar Mudanças</button> 
</div>

<div class="modal fade MP" id="AjudaMP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document" >
			<div class="modal-content" style="border-color: secondary;">
				<div class="modal-header r-0 bg-primary">
					<h6 class="modal-title text-white" id="exampleModalLabel">Informações de Sobre o Plug-in</h6>
					<a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
				</div>

				<div class="modal-body">
					<p>
						Seu servidor deve está rodando com a versão 7.1.0 do PHP ou superior.<br>
					</p>
				</div>
			</div>
		</div>
<script>
function mercadopago(){
    let m = new XMLHttpRequest();
    let c = document.getElementById('token').value;
    m.open("GET", "?mercadopago&token="+c);
    m.send();
    m.onload = () => {swal("Informações de pagamento Atualizadas!", "Informações de pagamento atualizadas com sucesso!", "success");}
}
</script>