<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
require_once('controller.php');



$query = DBRead('ecommerce_config','*');

$config = [];
foreach ($query as $key => $row) {
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

<div class="shop--cart">

<?php
if(isset($_SESSION["car"]) && is_array($_SESSION["car"]) && count($_SESSION["car"]) > 0){
?>
	<meta charset="UTF-8">
	<div class="shop--cart__block"></div>
	<div class="table-responsive-sm">
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

	    <tr>
	      <td><img src="<?php echo $url_img_capa ?>" alt="Foto Produto <?php echo $produto['nome']; ?>" width="100"></td>
		  <td><?php echo $produto['nome']; ?><br><span style="word-wrap: normal" id="trm<?php echo $id ?>">
		  <script> 
		  const a = document.getElementById("trm<?php echo $id ?>");
		  const b = sessionStorage.getItem("<?php echo $id ?>");
		  let c = a.innerHTML = b;
		   </script></span></td>
	      <td class="produtos" id="cart_qtd_<?php echo $id; ?>" pdt="<?php echo $qtd[0]; ?>" vlf="<?php echo $qtd[2]; ?>" style="white-space: nowrap;">
					<input class="cart_qtd" type="number" style="width:50px;" value="<?php echo $qtd[1]; ?>"/>
					<button class="cart_qtd_delete btn btn-sm btn-primary"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
				</td>
		<?php if ($produto['a_consultar'] <> 'S') { ?>
	      <td><?php echo $config['moeda'].' '.str_replace(".",",",$qtd[2]); ?></td>
	      <td><?php echo $config['moeda'].' '.number_format(floatval(str_replace(",", ".", $qtd[2])) * floatval(str_replace(",", ".", $qtd[1])), 2, ",", "."); ?></td>
	  	<?php } else { ?>
	  		<td>A Consultar</td>
	      	<td>A Consultar</td>
	  	<?php } ?>
	    </tr>
	  <?php } ?>
	  <tr>
			<td colspan="3"></td>
			<td><strong>Desconto</strong></td>
			<td><span id="desconto"><?php echo $config['moeda'].' '; ?>0,00</span></td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td><strong>Total</strong></td>
			<td><?php echo $config['moeda'].' '.number_format ($total_carrinho, 2, ",", ".") ?></td>
		</tr>
	</table>
	</div>


	<div class="row">
		<div class="col-xs-6 text-left">
			<div class="col-xs-6" >
			    <input type="text" id="cupom">
			</div>
			<div class="col-xs-6">   
			    <a id="cartCheckout" onclick="Cupom(document.getElementById('cupom').value)" class="btn btn-primary" >Adicionar cupom</a>
			</div>
		</div>
		<div class="col-xs-6 text-right">
			<a id="cartCheckout" class="btn btn-primary" href="<?php echo $config['pagina_checkout']; ?>" >Finalizar Pedido</a>			
		</div>

	</div>

<? } else {?>
	<span>Seu carrinho está vazio!</span>
<? } ?>

</div>
<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>epack/css/elements/form.css">
<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>epack/css/elements/animate.css">
<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>epack/css/elements/modal.css">
<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>wa/ecommerce/assets/css/carrinho.css">
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
window.onload = sessionStorage.setItem('cuponsUsados', '');
function Cupom(get){ 
    let desconto = document.getElementById('desconto');
    desconto.innerHTML =  "<i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i>";
    let frete = document.getElementById('vl_frete');
    let total = document.getElementById('valor');
    let geral = document.getElementById('valor_geral');
    let qtd = 0;
    let vlf = 0;
    var form = new FormData();
    let itens = document.getElementsByClassName('produtos');
    let cupons = sessionStorage.getItem("cuponsUsados").split(',');
    for(i=0; i< itens.length; i++){
       form.append([i], itens[i].getAttribute("pdt"));
       qtd += parseInt(document.getElementsByClassName('cart_qtd')[i].value);
    }
   form.append("quantidade", qtd);
    fetch(UrlPainel+'wa/ecommerce/apis/cupons.php?id='+get, {
        method: "POST",
        body: form
    }).then((res)=>{
        res.text().then(data =>{
            
            if(data == "0"){
                desconto.innerHTML = "<?php echo $config['moeda']?> 0,00";
                
            }
            else{
                
                cupons.push(get);
                sessionStorage.setItem("cuponsUsados", cupons);
                sessionStorage.setItem("cupom"+get, data);
                let unique = [...new Set(cupons)];
                for(a=1; a<unique.length;a++){
                    vlf += parseFloat(sessionStorage.getItem("cupom"+unique[a]));
                    
                }
                desconto.innerHTML = "<?php echo $config['moeda']?> "+ parseFloat(vlf).toFixed(2).toString().replace(".", ",");
                
            }
            
        });
    });
}
</script>
<script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>wa/ecommerce/assets/js/carrinho.js"></script>