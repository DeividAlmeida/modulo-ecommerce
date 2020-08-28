
<?php 
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
$id = base64_decode($_GET['Z']);
$read = DBRead('ecommerce_vendas','*',"WHERE id = '{$id}'")[0];
$reading = DBRead('ecommerce_config_entrega','*',"WHERE id = '1'")[0]; 
$data = new DateTime();
$data->format('d/m/Y H:i:s');
$data = new DateTime($read['data']);
$p = json_decode($read['produto'], true);

$pagamento_pendente = 20;
$processando = 20;
$aguardando = 40;
$pedido_enviado = 60;
$concluido = 100;


if($read['status'] == "pedido_enviado" && $read['rastreamento'] != "" && $read['rastreamento'] != NULL) : ?>
<script>
window.onload = function() {
    document.getElementById('bar').style.width = '80%';
};
</script>
<?php else : ?>
<script>
window.onload = function() {
    const pagamento_pendente = '20%';
    const processando = '20%';
    const aguardando = '40%';
    const pedido_enviado = '60%';
    const concluido = '100%';
    document.getElementById('bar').style.width = <?php print_r($read['status']); ?>;
};
</script>
<?php endif ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<div class="card">
  	<div class="card-header">
		<h2 class="font-weight-bold text-center" style=" font-size:35px;">Detalhes do seu Pedido #<?php echo $read['id']; ?><h2>
  	</div>
    <div class="container-fluid">
	    <div class="card-body">
            <div class="row justify-content-md-center">
                <div class="col-auto">
                    <p class="card-text">
                        <h4  class="font-weight-bold   d-flex flex-nowrap">Data do Pedido:</h4>
						<h6 class="text-right  d-flex flex-nowrap"><?php echo $data->format('d/m/Y H:i:s');; ?></h6>
                    </p>
                </div> 
                <div class="col-auto">
                    <p class="card-text">
                        <h4  class="font-weight-bold   d-flex flex-nowrap">Código de Rastreio:</h4>
						<h6 class="text-right  d-flex flex-nowrap"><?php echo $read['rastreamento']; ?></h6>
                    </p>
                </div> 
                <div class="col-auto">
                    <p class="card-text">
                        <h4  class="font-weight-bold   d-flex flex-nowrap">Valor da compra:</h4>
						<h6 class="text-right  d-flex flex-nowrap"> <?php echo "R$ ".number_format($read['valor'], 2, ",", "."); ?></h6>
                    </p>
                </div> 
            </div><br><br>
            <div class="row justify-content-md-center">
                <h4  class="font-weight-bold   d-flex flex-nowrap">Produto(s):</h4>
                <?php foreach($p as $a): ?>
                <div class="col-auto">
                    <p class="card-text">
						<h6 ><?php echo $a['produto']; ?> </h6>
                    </p>
                </div>
                <?php endforeach ?>
            </div><br><br><hr><br><br>
			<div class="row">
			    <?php if($read['status'] == "cancelado" ||  $read['status'] == "reembolsado"): ?>
			    <h2 class="font-weight-bold justify-content-md-center" style=" font-size:35px;">Seu pedido foi <?php echo $read['status']; ?><h2>
			 </div>
			        <?php else: ?>
				<div class="col-2">
					<div class="card-body">
						<div class="card-text" style="width:100%; min-width:50px; margin-left:0%"> 
							<?php require_once('1.php'); ?>
                        </div>
					</div>
                </div>
                <div class="col-2">
					<div class="card-body">
						<div class="card-text" style="width:100%; min-width:50px; margin-left:40%"> 
							<?php require_once('2.php'); ?>
                        </div>
					</div>
                </div>
                <div class="col-2">
					<div class="card-body">
						<div class="card-text" style="width:100%; min-width:50px; margin-left:80%"> 
							<?php require_once('3.php'); ?>
                        </div>
					</div>
                </div>
                <div class="col-2">
					<div class="card-body">
						<div class="card-text" style="width:100%; min-width:50px; margin-left:100%"> 
							<?php require_once('4.php'); ?>
                        </div>
					</div>
                </div>
                <div class="col-2">
					<div class="card-body">
						<div class="card-text" style="width:100%; min-width:50px; margin-left:150%"> 
							<?php require_once('5.php'); ?>
                        </div>
					</div>
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" id="bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" ></div>
            </div>
        </div>
        <div class="row">
            <div class="col-2" >
                <h5 class="d-flex flex-nowrap" style="width:100%; font-size:100%; ">Pedido Recebido</h5>
            </div>
            <div class="col-2" >
                <h5 class="text-center d-flex flex-nowrap" style="width:100%; font-size:100%; margin-left:40%">Pagamento Aprovado</h5>
            </div>
            <div class="col-2" >
                <h5 class="text-center d-flex flex-nowrap"" style="width:100%; font-size:100%;  margin-left:60%">Enviado ao Trasportador</h5>
            </div>
            <div class="col-2" >
                <h5 class="text-center d-flex flex-nowrap"" style="width:100%; font-size:100%;  margin-left:80%">Pedido em Transporte</h5>
            </div>
            <div class="col-2" >
                <h5 class=" text-right  d-flex flex-nowrap"" style="width:100%; font-size:100%; margin-left:120%">Pedido Entregue</h5>
            </div>
            <?php endif ?>
        </div><br><br><hr><br><br>
        <div class="row  justify-content-md-center">
            <div class="col-auto" >
                <div class="form-group" style="width:30%; height:auto;min-width:180px;">
                    <?php require_once('apoio.php'); ?>
                </div>
            </div>
            <div class="col-auto" >
                <div class="form-group"  >
                    <p class="card-text ">
                        <h4  class="font-weight-bold text-right  d-flex flex-nowrap">Telefone:</h4>
						<h6 class="text-right  d-flex flex-nowrap"><?php echo $reading['telefone']; ?></h6>
                    </p>
                    <p class="card-text">
                        <h4  class="font-weight-bold   d-flex flex-nowrap">Email:</h4>
						<h6 class="text-right  d-flex flex-nowrap"><?php echo $reading['email']; ?></h6>
                    </p>
                </div>
            </div>
        <div>    
    </div>
</div>
