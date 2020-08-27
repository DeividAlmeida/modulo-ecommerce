<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
$retirada = DBRead('ecommerce_config_entrega','*',"WHERE id = '1'")[0]; 
$deposito = DBRead('ecommerce_config_deposito','*',"WHERE id = '1'")[0]; 
?>

<meta http-equiv="Content-Type" content="charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<div class="card">
  	<div class="card-header">
		<h2 class="font-weight-bold text-center" style=" font-size:35px;"><?php echo $deposito['titulo']; ?><h2>
		<p class="font-weight-normal" style=" font-size:16px;"><?php echo $deposito['descricao']; ?></p>
  	</div>

	<div class="card-body">
		<div class="card-group">
		<?php $dtls = json_decode($deposito['detalhes'], true); foreach( $dtls as $key => $dtl): ?>	
			<div class="card border-light md-<?php echo 12/count($dtls); ?>">
				<div class="card-body">
				<h5 class="card-title"><?php echo $dtl['banco']?></h5>
					<div class="card-body">
						<p class="card-text"> 
							<h4  class="font-weight-bold">Nome da Conta:</h4>
							<h6> <?php echo $dtl['nome']?></h6>
						</p>
						<p class="card-text">
							<h4  class="font-weight-bold">Conta:</h4>
							<h6> <?php echo $dtl['conta']?></h6>
						</p>
						<p class="card-text">
							<h4  class="font-weight-bold">Agéncia:</h4>
							<h6> <?php echo $dtl['agencia']?></h6>
						</p>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>

		<footer class="blockquote-footer"><p class="font-weight-normal"><?php echo $deposito['instucoes']; ?></p></footer>
	</div>
</div>
<br><br><br>

<div class="card">
	<div class="card-header">
    	<h2 class="h1-responsive font-weight-bold text-center" style=" font-size:20px;">Informações de Contato</h2>
	</div>
	<div class="container">
		<div class="card-body row">
				<label class="card-text col-md-6">
					<p class="font-weight-bold" >Estado:</p>
					<p class="font-weight-normal" ><?php echo $retirada['estado']?></p>
				
					<p class="font-weight-bold" >Cidade:</p>
					<p class="font-weight-normal" ><?php echo $retirada['cidade']?></p>

					<p class="font-weight-bold" >Bairro:</p>
					<p class="font-weight-normal" ><?php echo $retirada['bairro']?></p>

					<p class="font-weight-bold" >Rua:</p>
					<p class="font-weight-normal" ><?php echo $retirada['rua']?></p>
				</label>
				<label class="card-text col-md-6">
					<p class="font-weight-bold" >Número:</p>
					<p class="font-weight-normal" ><?php echo $retirada['numero']?></p>

					<p class="font-weight-bold" >CEP:</p>
					<p class="font-weight-normal" ><?php echo $retirada['cep']?></p>

					<p class="font-weight-bold" >Telefone:</p>
					<p class="font-weight-normal" ><?php echo $retirada['telefone']?></p>
				
					<p class="font-weight-bold" >E-mail:</p>
					<p class="font-weight-normal" ><?php echo $retirada['email']?></p>
				</label>
			</div>
		</div>
		<hr class="my-2">
		<footer class="text-center"><p class="font-weight-normal"><?php echo $retirada['complemento']?></p></footer>
	</div>