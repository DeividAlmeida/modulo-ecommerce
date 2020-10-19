<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
$gateways =  DBRead('ecommerce_plugins','*', "WHERE status = 'checked' AND tipo='gateways'");
$deliveries =  DBRead('ecommerce_plugins','*', "WHERE status = 'checked' AND tipo='delivery'");
$read = DBRead('ecommerce_config_entrega','*',"WHERE id = '1'")[0]; 
$retirada = DBRead('ecommerce_config_entrega','*',"WHERE id = '1'")[0];
$deposito = DBRead('ecommerce_config_deposito','*',"WHERE id = '1'")[0];
$pagseguro = DBRead('ecommerce_config_pagseguro','*',"WHERE id = '1'")[0]; 
$query = DBRead('ecommerce_config','*');
$config = [];
  foreach ($query as $key => $row) {
    $config[$row['id']] = $row['valor'];
  }
?>
		<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>epack/css/elements/animate.css">
		<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>epack/css/elements/modal.css">
		<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>wa/ecommerce/assets/css/checkout.css">
		
<style>
    #normal{
        position:relative;
        top:50%;
    }
	#cartCheckout{
	background-color: <?php echo $config['carrinho_cor_btn_finalizar']; ?> !important;
	border-color: <?php echo $config['carrinho_cor_btn_finalizar']; ?> !important;
}
.product-name{
    color: <?php echo $config['carrinho_cor_btn_finalizar']; ?> !important;
}
</style>			
		
		<meta http-equiv="Content-Type" content="charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		

		<div class="page-wrapper">
			<div id="main" class="column1 boxed">
				<div class="container">
					<div class="row main-content-wrap">
						<div class="main-content col-lg-12">			
							<div id="content" role="main">				
								<article class="post-209 page type-page status-publish hentry">				
									<span class="entry-title" style="display: none;">Checkout</span><span class="vcard" style="display: none;"><span class="fn"><a href="https://www.inspiracaocosmeticos.com.br/author/inspiracao-user/" title="Posts de inspiracao-user" rel="author">inspiracao-user</a></span></span><span class="updated" style="display:none">2016-06-20T09:22:56-03:00</span>
										<div class="page-content" style="margin:30px;">
											<div class="woocommerce">
												<br>
												<form name="checkout" method="post" class="checkout woocommerce-checkout" id="fcheckout" action="<?php echo ConfigPainel('base_url'); ?>wa/ecommerce/checkout/composer.php" enctype="multipart/form-data"  style="position: static; zoom: 1;">																																							
													<div class="row">		
														<div class="col-lg-4" id="customer_details">
															<div class="woocommerce-billing-fields clearfix">	
																<center><strong>Detalhes de cobrança</strong></center><br>	
																<div class="woocommerce-billing-fields__field-wrapper">
																	<p class="form-row form-row-first validate-required woocommerce-invalid woocommerce-invalid-required-field" id="billing_first_name_field" data-priority="10">
																		<label for="billing_first_name" class="">Nome&nbsp;<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input required type="text" class="input-text " name="billing_first_name" id="billing_first_name" placeholder="" value="" autocomplete="given-name"></span>
																	</p>
																	<p class="form-row form-row-last validate-required woocommerce-invalid woocommerce-invalid-required-field" id="billing_last_name_field" data-priority="20"><label for="billing_last_name" class="">Apelido&nbsp;<abbr class="required" title="obrigatório">*</abbr></label>
																		<span class="woocommerce-input-wrapper">
																			<input required type="text" class="input-text " name="billing_last_name" id="billing_last_name" placeholder="" value="" autocomplete="family-name">
																		</span>
																	</p>
																	<p class="form-row form-row-wide person-type-field validate-required woocommerce-validated" id="billing_persontype_field" data-priority="22"style="display: none;">
																		<label for="billing_persontype" class="">Pessoa&nbsp;																	
																			<abbr class="required" title="obrigatório">*																				
																			</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<select  value="N/A" onchange="person(document.getElementById('billing_persontype').value)" name="billing_persontype" id="billing_persontype" class="select wc-ecfb-select select2-hidden-accessible" data-placeholder="" tabindex="-1" aria-hidden="true" >
																				<option value="0">Selecione uma opção…</option>
																				<option value="1">Pessoa Física</option>
																				<option value="2">Pessoa Jurídica</option>
																			</select>																																	
																		</span>																	
																	</p>																	
																	<p class="form-row form-row-wide person-type-field validate-required woocommerce-invalid woocommerce-invalid-required-field" id="billing_cpf_field" data-priority="23" style="display: none;">
																		<label for="billing_cpf" id="cpf" class="">CPF&nbsp; 
																			<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<label for="billing_cpf" id="cnpj" class="">CNPJ&nbsp; 
																			<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input  type="tel" class="input-text " name="id_pessoa" id="billing_cpf" placeholder="" value="N/A" maxlength="14">
																		</span>
																	</p>												
																	<p class="form-row form-row-wide address-field update_totals_on_change validate-required" id="billing_country_field" data-priority="40">
																		<label for="billing_country" class="">País&nbsp;
																			<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<strong>Portugal</strong>
																			<input type="hidden" name="billing_country" id="billing_country" value="PT" autocomplete="country" class="country_to_state" readonly="readonly">
																		</span>
																	</p>
																	<p class="form-row form-row-first address-field validate-required validate-postcode woocommerce-invalid woocommerce-invalid-required-field" id="billing_postcode_field" data-priority="45" data-o_class="form-row form-row-first address-field validate-required validate-postcode">
																		<label for="billing_postcode" class="">Código Postal&nbsp;
																			<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input pattern="[0-9]+$" required id="cepdestino" type="text" maxlength='7' minlength='7' class="input-text " name="billing_postcode" id="billing_postcode" placeholder="99999999" value="" autocomplete="postal-code">
																		</span>
																	</p>
																	<p class="form-row form-row-last address-field validate-required woocommerce-invalid woocommerce-invalid-required-field" id="billing_address_1_field" data-priority="50">
																		<label for="billing_address_1" class="">Morada&nbsp;
																			<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input type="text" class="input-text " name="billing_address_1" id="billing_address_1" value="" autocomplete="address-line1" data-placeholder="Nome da rua e número da casa">
																		</span>
																	</p>
																	<p class="form-row form-row-first address-field validate-required woocommerce-invalid woocommerce-invalid-required-field" id="billing_number_field" data-priority="55">
																		<label for="billing_number" class="">Número&nbsp;
																			<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input required type="text" class="input-text " name="billing_number" id="billing_number"  value="">
																		</span>
																	</p>
																	<p class="form-row form-row-last address-field woocommerce-validated" id="billing_address_2_field" data-priority="60">
																		<label for="billing_address_2" class="">Complemento&nbsp;
																			<span class="optional">(opcional)</span>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input type="text" class="input-text " name="billing_address_2" id="billing_address_2" value="" autocomplete="address-line2" data-placeholder="Apartamento, suíte, unidade, etc. (opcional)">
																		</span>
																	</p>
																	<p class="form-row form-row-first address-field woocommerce-validated" id="billing_neighborhood_field" data-priority="65" style="display: none;">
																		<label for="billing_neighborhood" class="">Bairro&nbsp;
																			<abbr class="required" title="obrigatório">*																				
																			</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input type="text" class="input-text " name="billing_neighborhood" id="billing_neighborhood" placeholder="" value="N/A">
																		</span>
																	</p>
																	<p class="form-row form-row-wide address-field validate-required woocommerce-invalid woocommerce-invalid-required-field" id="billing_city_field" data-priority="70" data-o_class="form-row form-row-last address-field validate-required">
																		<label for="billing_city" class="">Cidade&nbsp;
																			<abbr class="required" title="obrigatório">*																				
																			</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input required type="text" class="input-text " name="billing_city" id="billing_city" placeholder="" value="" autocomplete="address-level2">
																		</span>
																	</p>
																	<p class="form-row form-row-wide address-field validate-required validate-state woocommerce-validated" id="billing_state_field" data-priority="80" data-o_class="form-row form-row-wide address-field validate-required validate-state" style="display: none;">
																		<label for="billing_state" class="">Estado&nbsp;
																			<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<select  value="N/A" name="billing_state" id="billing_state" class="state_select select2-hidden-accessible" autocomplete="address-level1" data-placeholder="Selecione uma opção…" data-input-classes="" tabindex="-1" aria-hidden="true">
																				<option value="">Selecione uma opção…</option>
																				<option value="AC">Acre</option>
																				<option value="AL">Alagoas</option>
																				<option value="AP">Amapá</option>
																				<option value="AM">Amazonas</option>
																				<option value="BA">Bahia</option>
																				<option value="CE">Ceará</option>
																				<option value="DF">Distrito Federal</option>
																				<option value="ES">Espírito Santo</option>
																				<option value="GO">Goiás</option>
																				<option value="MA">Maranhão</option>
																				<option value="MT">Mato Grosso</option>
																				<option value="MS">Mato Grosso do Sul</option>
																				<option value="MG">Minas Gerais</option>
																				<option value="PA">Pará</option>
																				<option value="PB">Paraíba</option>
																				<option value="PR">Paraná</option>
																				<option value="PE">Pernambuco</option>
																				<option value="PI">Piauí</option>
																				<option value="RJ">Rio de Janeiro</option>
																				<option value="RN">Rio Grande do Norte</option>
																				<option value="RS">Rio Grande do Sul</option>
																				<option value="RO">Rondônia</option>
																				<option value="RR">Roraima</option>
																				<option value="SC">Santa Catarina</option>
																				<option value="SP">São Paulo</option>
																				<option value="SE">Sergipe</option>
																				<option value="TO">Tocantins</option>
																			</select>																			
																		</span>
																	</p>
																	<p class="form-row form-row-wide validate-required validate-phone woocommerce-invalid woocommerce-invalid-required-field" id="billing_phone_field" data-priority="100">
																		<label for="billing_phone" class="">Telefone&nbsp;
																			<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input required type="tel" class="input-text " name="billing_phone" id="billing_phone" placeholder="" value="" autocomplete="tel" maxlength="15">
																		</span>
																	</p>
																	
																	<p class="form-row form-row-wide validate-required validate-email woocommerce-invalid woocommerce-invalid-required-field" id="billing_email_field" data-priority="110">
																		<label for="billing_email" class="">Endereço de e-mail&nbsp;
																			<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input required type="email" class="input-text " name="billing_email" id="billing_email" placeholder="" value="" autocomplete="email username">
																		</span>
																	</p>
																	<div id="wcbcf-mailsuggest" style="color: rgb(204, 0, 0); font-size: small;">
																	</div>
																</div>
															</div>
															<div class="woocommerce-shipping-fields">
																<div class="shipping_address" style="display: none;">
																	<div class="woocommerce-shipping-fields__field-wrapper">																															
																		</div>
																	</div>
																</div>															
																<div class="woocommerce-additional-fields">
																	<div class="woocommerce-additional-fields__field-wrapper">
																		<p class="form-row notes woocommerce-validated" id="order_comments_field" data-priority="">
																			<label for="order_comments" class="">Notas do pedido&nbsp;
																				<span class="optional">(opcional)</span>
																			</label>
																			<span class="woocommerce-input-wrapper">
																				<textarea name="order_comments" class="input-text " id="order_comments" placeholder="Notas sobre seu pedido, por exemplo, informações especiais sobre entrega." rows="2" cols="5"></textarea>
																			</span>
																		</p>					
																	</div>
																</div>
															</div>														
														<div class="checkout-order-review align-left col-lg-8">
															<div id="order_review" class="woocommerce-checkout-review-order">
																<div class="row">
																	<div class="col-lg-6">
																		<strong><center>Revisão do pedido</center></strong><br>
																		<?php
																			if(isset($_SESSION["car"]) && is_array($_SESSION["car"]) && count($_SESSION["car"]) > 0) { ?>
																			<tbody>																		
																				
																		<table class="shop_table review-order woocommerce-checkout-review-order-table">
																			<thead>
																				<tr>
																					<th class="product-name">Produto</th>
																					<th class="product-total">Subtotal</th>
																				</tr>
																			</thead>
                                      <?php foreach($_SESSION["car"] as $id => $qtd ){
																				$query = DBRead('ecommerce', '*', "WHERE id = $qtd[0]");
																				$produto = $query[0];?>
																				<tr class="cart_item">
																				    <input type="hidden" name="produto[]" id="produto<?php echo $id ?>" value="">
																				    <input type="hidden" name="produto_pg[]" id="produto_pg" value="<?php echo $produto['nome']; ?>">
																			        <input type="hidden" name="qtd[]" id="qtd_fl" value="<?php  echo $qtd[1]; ?>">
																			        <input type="hidden" name="un_valor[]" id="un_valor" value="<?php echo floatval(str_replace(",", ".", $qtd[2])); ?>">
																				    <input type="hidden" name="id_pdt[]" id="id_pdt" value="<?php  echo $qtd[0]; ?>">
																				<td class="product-name"><strong><center><?php echo $produto['nome']; ?></center></strong><br>
																					<span id="trm<?php echo $id ?>">
																					
																						<script>
																							const a = document.getElementById("trm<?php echo $id ?>");
																							const b = sessionStorage.getItem("<?php echo $id ?>");
																							let c = a.innerHTML = b;
																							if(c !== null){
																							document.getElementById("produto<?php echo $id ?>").value = "<?php echo $produto['nome']; ?>" +"<br>"+c;
																							}else{
																							   document.getElementById("produto<?php echo $id ?>").value = "<?php echo $produto['nome']; ?>"; 
																							}
																						</script>
																					</span><hr>																				
																				<span class="product-quantity"><span> Quantidade: </span><?php  echo $qtd[1]; ?></span>
																				</td>
																				<td class="product-total">
																					<span class="woocommerce-Price-amount amount">
																						<span class="woocommerce-Price-currencySymbol" style="white-space: nowrap"><center><?php echo $config['moeda'].' '.number_format(floatval(str_replace(",", ".", $qtd[2])) * floatval(str_replace(",", ".", $qtd[1])), 2, ",", "."); ?></center></span></span>
																					</span>
																				</td>
																				</tr>
																				<?php $total_carrinho += floatval(str_replace(",", ".", $qtd[2])) * floatval(str_replace(",", ".", $qtd[1]));
																					  $total_peso += $produto['peso'] * $qtd[1];
																					  $total_comprimento += $produto['comprimento'] * $qtd[1];
																					  $total_altura += $produto['altura'] * $qtd[1];
																					  $total_largura += $produto['largura'] * $qtd[1];
																				 } ?>																				
																			</tbody>
																			<tfoot>
																				<tr class="cart-subtotal">
																					<th>Subtotal</th>
																					<td>
																						<span class="woocommerce-Price-amount amount">
																							<span class="woocommerce-Price-currencySymbol" style="white-space: nowrap"><center><?php echo $config['moeda'].' '.str_replace (".", ",", $total_carrinho)  ?></center></span></td>
																						</span>
																					</td>
																				</tr>
																				<tr class="woocommerce-shipping-totals shipping">
																					<td><strong><center>Entrega</center></strong> <span id="frete"></span>
                                                                                        <?php if(!empty($deliveries)){ foreach($deliveries as $kyd => $dvy){ ?>
                                                                                        <span id="<?php echo $dvy['id']; ?>" for=""></span>
                                                                                        
                                              <?php }} if($retirada['retirada'] == "checked") { ?>  
																					    <label for="retirada" style="cursor:pointer; margin-left:10px;" for="retirada"><input type="radio" name="frete" id="retirada" class="retirada" required style='cursor:pointer;white-space: nowrap' value="00,00"  > 
																					    <b>Retirada na loja</b><br>Valor do frete: R$ 0,00 / Prazo de entrega: imediato.</label> 
                                              <script>
                                                    document.getElementById("retirada").addEventListener("change", function() {
                                                      const z = 0;
                                                      const a = document.getElementById("retirada").value;
                                                      const b = z + <?php echo $total_carrinho; ?>;
                                                      const c = b.toFixed(2).toString().replace(".",",");																					  
                                                      document.getElementById("f_valor").innerHTML = "<?php echo $config['moeda']?> "+a;
                                                      document.getElementById("valor_geral").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                      document.getElementById("total").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                      document.getElementById("valor").value = b;
													  document.getElementById("tipo_entrega").value = "Retirada na Loja";
													  document.getElementById("vl_frete").value = 0;
                                                  });
                                              </script>
                                              <?php } ?>
                                              </td>

																					<td data-title="Entrega" > <span id="f_valor" ></span></td>
																				</tr>																			
									<script> 
									    $(document).ready(function(){
                                             $("#cepdestino").change(function(){
                                                 const cep = document.getElementById('cepdestino').value;
                                                <?php if(!empty($deliveries)){ foreach($deliveries as $keyd => $delivery){ ?>
                                                $("<?php echo '#'.$delivery['id']; ?>").load('<?php echo ConfigPainel('base_url').$delivery['path']."/wa/index.php?peso=".$total_peso."&valorcarrinho=".$total_carrinho; ?>&id='+cep);
                                                  
                                                 D<?php echo $delivery['id']; ?> = (z) =>{
                                                    const a = document.getElementById("<?php echo $delivery['nome']; ?>").value;	
                                                    const b = z + <?php echo $total_carrinho ?>;
                                                    const c = b.toFixed(2).toString().replace(".",",");																					 
                                                    document.getElementById("f_valor").innerHTML = "<?php echo $config['moeda']?> "+a;
                                                    document.getElementById("valor_geral").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                    document.getElementById("total").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                    document.getElementById("valor").value = b;
                                                    document.getElementById("vl_frete").value =  z;
                                                    document.getElementById("tipo_entrega").value = "<?php echo $delivery['titulo']; ?>";
                                                }
                                                <?php }} if($retirada['entrega'] == "checked") { ?>
                                                $("#frete").load('<?php echo ConfigPainel('base_url')?>wa/ecommerce/checkout/preload/');
                                                $("#frete").load('https://nameless-atoll-10880.herokuapp.com/'+cep+'<?php echo "/".$read['cep']."/".$total_peso."/".$total_comprimento."/".$total_altura."/".$total_largura; ?>');
                                               
                                              Cfrete = (z) =>{
                                                const a = document.getElementById("normal").value;
                                                const b = z + <?php echo $total_carrinho; ?>;
                                                const c = b.toFixed(2).toString().replace(".",",");																					  
                                                document.getElementById("f_valor").innerHTML = "<?php echo $config['moeda']?> "+a;
                                                document.getElementById("valor_geral").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                document.getElementById("total").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                document.getElementById("valor").value = b;
                                                document.getElementById("vl_frete").value = z.toFixed(2).toString().replace(",",".");
                                                document.getElementById("tipo_entrega").value = "PAC";
                                              };
                                              Cfrete1 = (z) =>{
                                                const a = document.getElementById("expresso").value;	
                                                const b = z + <?php echo $total_carrinho ?>;
                                                const c = b.toFixed(2).toString().replace(".",",");																					 
                                                document.getElementById("f_valor").innerHTML = "<?php echo $config['moeda']?> "+a;
                                                document.getElementById("valor_geral").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                document.getElementById("total").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                document.getElementById("valor").value = b;
                                                document.getElementById("vl_frete").value =  z.toFixed(2).toString().replace(",",".");
                                                document.getElementById("tipo_entrega").value = "Sedex";
                                              }
                                          <?php } ?>
                                            });
                                        });
                                    </script>											 																										
									<tr class="order-total">
										<th>Total</th>
										<td>
											<strong>
												<span class="woocommerce-Price-amount amount">
													<center><span class="woocommerce-Price-currencySymbol" id="total"  style="white-space: nowrap"></span><center>
												</span>
											</strong> 
										</td>
									</tr>
								</tfoot>
								
								<?php } else {?>
								<span>Seu carrinho está vazio!</span>
								<? } ?>
							</table>
						</div>
						<div class="col-lg-6">
							<div id="payment" class="woocommerce-checkout-payment">
								<center><strong>Métodos de Pagamento</center></strong><br>
								<ul class="wc_payment_methods payment_methods methods">
                                 <?php if($pagseguro['status'] == "checked"): ?> 
                                    <li class="wc_payment_method payment_method_pagseguro">
                                        <input id="payment_method_pagseguro" type="radio" required class="input-radio" name="payment_method" value="PagSeguro" onclick="compose('PagSeguro.php')" >
                                        <label for="payment_method_pagseguro" style="cursor:pointer">
                                          Pagar com <img src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>wa/ecommerce/checkout/PagSeguroLibrary/img/pagseguro.png" />	
                                        </label>                                                                                
                                    </li>
                                  <?php endif ?>
                                  <?php if(!empty($gateways)){ foreach($gateways as $keyp => $plugin){ ?>
                                        <li class="wc_payment_method payment_method_traferencia">
                                        <input id="payment_method_<?php echo $plugin['nome']; ?>" type="radio" required class="input-radio" name="payment_method" value="<?php echo $plugin['titulo']; ?>" onclick="compose(<?php echo "'../../../".$plugin['path']."/wa/index.php'"; ?>)">
                                        <label for="payment_method_<?php echo $plugin['nome']; ?>" style="cursor:pointer">
                                          Pagar com <?php if(!empty($plugin['img'])) { ?>
                                          <img style="width:auto; height:23px;" src="<?php echo RemoveHttpS(ConfigPainel('base_url')). $plugin['img'].'"/>'; } ?>
                                        </label>                                                                                
                                    </li>
                                    <?php }} ?>
                                    <script>
                                    compose = (a) => {
                                    document.getElementById('composer').value=a;
                                    }
                                    </script>
                                    <input type="hidden" id="composer" name="composer" value='PagSeguro.php'>
                                  <?php if($deposito['status'] == "checked"): ?>
                                    <li class="wc_payment_method payment_method_traferencia">
                                        <input id="payment_method_deposito" type="radio" required class="input-radio" name="payment_method" value="Depósito">
                                        <label for="payment_method_deposito" style="cursor:pointer">
                                          Pagar com depósito em conta bancária	
                                        </label>                                                                                
                                    </li>
                                   <script>
                                    $('#fcheckout').submit(function(e) {
                                    
                                          if(document.getElementById('payment_method_deposito').checked){
-                                            sessionStorage.setItem("vfrete", document.getElementById("f_valor").innerHTML);
-                                            sessionStorage.setItem("frete", document.getElementById("tipo_entrega").value);
-                                            sessionStorage.setItem("ttl", document.getElementById("total").innerHTML);
                                              e.preventDefault();            
                                              var adata = $(this).serializeArray();
                                              $.ajax({
                                                data: adata,
                                                type:    "POST",
                                                cache:   false,
                                                url:     UrlPainel+'wa/ecommerce/checkout/composer.php',
                                                success: function (adata) {
                                                  $.ajax({
                                                      type:    "GET",
                                                      cache:   false,
                                                      url:     UrlPainel+'wa/ecommerce/checkout/detalhes.php',
                                                      success: function (data) {
                                                        
                                                        jQuery('#EcommerceCheckout').html(data);
                                                      },
                                                  });
                                                }, 
                                              });           
                                            };
                                      });
                                    </script>
                                    <?php endif ?>
                                  </ul>
						        <div class="form-row place-order">
									<h3>Total Geral:&nbsp;&nbsp;
										<span>
											<strong>
												<span class="woocommerce-Price-amount amount" id="valor_geral">
													
												</span>
											</strong> 
										</span>
									</h3><br>
									<input required type="hidden" name="valor" id="valor" value="">
									<input required type="hidden" name="tipo_entrega" id="tipo_entrega" value="">
									<input required type="hidden" name="vl_frete" id="vl_frete" value="">
									<?php if($deposito['status'] != "checked" && $pagseguro['status'] != "checked"  && empty($gateways) ): else: ?>
									<center><input type="submit" id="cartCheckout"  value="Finalizar compra" ></center>
									<?php endif ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
							</div>
						</article>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
				<div id="fb-root" class=" fb_reset">
					<div style="position: absolute; top: -10000px; width: 0px; height: 0px;">
						<div>							
						</div>
					</div>
				</div>
				<div id="wws-layout-1" class="wws-popup-container wws-popup-container--position">					
				</div>
            <div class="wws-gradient wws-gradient--position">				
			</div>
		</div>
		<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
		<script>	
			person = (a) =>{
				const b = 	document.getElementById("billing_cpf_field");
				const c = 	document.getElementById("cpf");
				const g = 	document.getElementById("cnpj");
				const d = 	 a == "2";
				const e = 	 a == "1";
				const f =	 a == "0";
				if(d){b.style.display = "block";g.style.display = "block";c.style.display = "none"}
				else if(e){b.style.display = "block";g.style.display = "none";c.style.display = "block"}
				else if(f){b.style.display = "none";g.style.display = "block";c.style.display = "none"}
      };
      </script>