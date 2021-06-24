<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
$retirada = DBRead('ecommerce_config_entrega','*',"WHERE id = '1'")[0]; 
$deposito = DBRead('ecommerce_config_deposito','*',"WHERE id = '1'")[0]; 

$query = DBRead('ecommerce_config','*');

$config = [];
foreach ($query as $ke => $row) {
  $config[$row['id']] = $row['valor'];
}

$total_carrinho = 0;
?>
<style>
.shop--cart .btn, #formCarrinhoSucesso .btn{
  border: 0;
  background-color: <?php echo $config['carrinho_cor_btns']; ?> !important;
}
#cartCheckout{
	background-color: <?php echo $config['carrinho_cor_btn_finalizar']; ?> !important;
}
</style>
<meta http-equiv="Content-Type" content="charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

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
		<h2 class="font-weight-bold text-center" style=" font-size:35px;">Informações do Pedido<h2>
  	</div>

	<div class="card-body">

<div class="shop--cart">

<?php
if(isset($_SESSION["car"]) && is_array($_SESSION["car"]) && count($_SESSION["car"]) > 0){
?>
	<meta charset="UTF-8">
	<div class="shop--cart__block"></div>
	<div class="table-responsive">
	<table id="shop--cart--table" class="shop--cart--table table m-0 table-striped">
      <tr>
	    <th>Imagem</th>
	    <th>Produto</th>
	    <th>Quantidade</th>
	    <th>Preço</th>
	    <th>Total</th>
	  </tr>

	  <?php foreach($_SESSION["car"] as $id => $qtd ){
	    $query = DBRead('ecommerce', '*', "WHERE id = $qtd[0]");
	    $produto = $query[0];

	    // Carregando Fotos do produto
	    $fotos  = DBRead('ecommerce_prod_imagens','*', "WHERE id_produto = {$produto['id']}");

	    // Busca pela foto de capa e salva em variavel
	    foreach($fotos as $foto){
	      if($foto['id'] == $produto['id_imagem_capa']){
	        $foto_capa = $foto;
	      }
	    }

	    // URL da imagem da capa
	    $url_img_capa = RemoveHttpS(ConfigPainel('base_url'))."wa/ecommerce/uploads/".$foto_capa['uniq'];
	    
	    if ($produto['a_consultar'] <> 'S') {
	    	$total_carrinho += floatval(str_replace(",", ".", $qtd[2])) * floatval(str_replace(",", ".", $qtd[1]));
	    }
	    
	  ?>

	    <tr style="background-color: #fff;">
	      <td><img src="<?php echo $url_img_capa ?>" alt="Foto Produto <?php echo $produto['nome']; ?>" width="100"></td>
		  <td><?php echo $produto['nome']; ?><br><span id="trm<?php echo $id ?>">
		  <script> 
		  const a = document.getElementById("trm<?php echo $id ?>");
		  const b = sessionStorage.getItem("<?php echo $id ?>");
		  let c = a.innerHTML = b;
		   </script></span></td>
	      <td id="cart_qtd_<?php echo $id; ?>" pdt="<?php echo $qtd[0]; ?>" vlf="<?php echo $qtd[2]; ?>">
                <?php echo $qtd[1] ?>

				</td>
		<?php if ($produto['a_consultar'] <> 'S') { ?>
	      <td><?php echo $config['moeda'].''.number_format($qtd[2], 2, ",", "."); ?></td>
	      <td><?php echo $config['moeda'].' '.number_format(floatval(str_replace(",", ".", $qtd[2])) * floatval(str_replace(",", ".", $qtd[1])), 2, ",", "."); ?></td>
	  	<?php } else { ?>
	  		<td>A Consultar</td>
	      	<td>A Consultar</td>
	  	<?php } ?>
	    </tr>
	  <?php } ?>
	  <tr>
	      <td><b>Tipo de Entrega</b></td>
	      <td><span id="frt" ></span>
	          <script>
	              const f = document.getElementById("frt");
	              const ff = document.getElementById("vfrt");
	              const fff = document.getElementById("ttl");
	              const z = sessionStorage.getItem("frete");
	              const zz = sessionStorage.getItem("vfrete");
	              const zzz = sessionStorage.getItem("ttl");
        		  f.innerHTML = z;
        		  ff.innerHTML = zz;
        		  fff.innerHTML = zzz;
	          </script>
	      </td>
	      <td></td>
	      <td><span id="vfrt" ></span></td>
	      <td></td>
	  </tr>
		<tr>
			<td colspan="3"></td>
			<td><strong>Total</strong></td>
			<td><span id="ttl" ></span></td>
		</tr>
	</table>
	</div>


	<div class="row">
		<div class="col-xs-6 text-left">
			
		</div>
	</div>

<? }  ?>

</div>

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
	<?php session_destroy(); ?>
	<script> new EcommerceBtnCarrinho(); </script>