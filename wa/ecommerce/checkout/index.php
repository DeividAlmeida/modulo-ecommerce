<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
#error_reporting(0);
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
$cupons  = DBRead('ecommerce_cupom','*');
$query = DBRead('ecommerce_config','*');
$config = [];
  foreach ($query as $key => $row) {
    $config[$row['id']] = $row['valor'];
  }
if(isset($_SESSION['E-Wacontrol'])){
    $id_cliente = $_SESSION['E-Wacontrol'][0];
}
else if(isset($_COOKIE['E-Wacontroltoken'])){
    $id_cliente =  $_COOKIE['E-Wacontrolid'];
}else{
    $id_cliente = null;
}
$usuario = DBRead('ecommerce_usuario','*',"WHERE id = '{$id_cliente}'")[0];
$enderecos = json_decode($usuario['endereco']);
?>
			<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>epack/css/elements/animate.css">
		<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>epack/css/elements/modal.css">
		<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>wa/ecommerce/assets/css/checkout.css">
		

		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
													<input name="id_cliente" type="hidden" value="<?php echo $id_cliente; ?>" />
													<div class="row">		
														<div class="col-lg-4" id="customer_details">
															<div class="woocommerce-billing-fields clearfix">	
																<center><strong> Detalhes de cobrança</strong></center><br>	
																<div class="woocommerce-billing-fields__field-wrapper">
																	<p class="form-row form-row-first validate-required woocommerce-invalid woocommerce-invalid-required-field" id="billing_first_name_field" data-priority="10">
																		<label for="billing_first_name" class="">Nome&nbsp;<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input required type="text" class="input-text " name="billing_first_name" id="billing_first_name" placeholder="" value="" autocomplete="given-name"></span>
																	</p>
																	<p class="form-row form-row-last validate-required woocommerce-invalid woocommerce-invalid-required-field" id="billing_last_name_field" data-priority="20"><label for="billing_last_name" class="">Sobrenome&nbsp;<abbr class="required" title="obrigatório">*</abbr></label>
																		<span class="woocommerce-input-wrapper">
																			<input required type="text" class="input-text " name="billing_last_name" id="billing_last_name" placeholder="" value="" autocomplete="family-name">
																		</span>
																	</p>
																	<p class="form-row form-row-wide person-type-field validate-required woocommerce-validated" id="billing_persontype_field" data-priority="22">
																		<label for="billing_persontype" class="">Pessoa&nbsp;																	
																			<abbr class="required" title="obrigatório">*																				
																			</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<select required onchange="person(document.getElementById('billing_persontype').value)" name="billing_persontype" id="billing_persontype" class="select wc-ecfb-select select2-hidden-accessible" data-placeholder="" tabindex="-1" aria-hidden="true">
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
																			<input required type="tel" class="input-text " name="id_pessoa" id="billing_cpf" placeholder="" value="" maxlength="14">
																		</span>
																	</p>												
																	<p class="form-row form-row-wide address-field update_totals_on_change validate-required" id="billing_country_field" data-priority="40">
																		<label for="billing_country" class="">País&nbsp;
																			<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<strong>Brasil</strong>
																			<input type="hidden" name="billing_country" id="billing_country" value="BR" autocomplete="country" class="country_to_state" readonly="readonly">
																		</span>
																	</p>
																	<p class="form-row form-row-first address-field validate-required validate-postcode woocommerce-invalid woocommerce-invalid-required-field" id="billing_postcode_field" data-priority="45" data-o_class="form-row form-row-first address-field validate-required validate-postcode">
																		<label for="billing_postcode" class="">CEP&nbsp;
																			<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input maxlength="8" required id="cepdestino" type="text" maxlength='8' minlength='8' class="input-text " name="billing_postcode" id="billing_postcode" placeholder="99999999" value="" autocomplete="postal-code">
																		</span>
																	</p>
																	<p class="form-row form-row-last address-field validate-required woocommerce-invalid woocommerce-invalid-required-field" id="billing_address_1_field" data-priority="50">
																		<label for="billing_address_1" class="">Rua&nbsp;
																			<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input type="text" class="input-text " name="billing_address_1" id="billing_address_1" placeholder="Nome da rua" value="" autocomplete="address-line1" data-placeholder="Nome da rua e número da casa">
																		</span>
																	</p>
																	<p class="form-row form-row-first address-field validate-required woocommerce-invalid woocommerce-invalid-required-field" id="billing_number_field" data-priority="55">
																		<label for="billing_number" class="">Número&nbsp;
																			<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input required type="text" class="input-text " name="billing_number" id="billing_number" placeholder="Número da casa" value="">
																		</span>
																	</p>
																	<p class="form-row form-row-last address-field woocommerce-validated" id="billing_address_2_field" data-priority="60">
																		<label for="billing_address_2" class="">Complemento&nbsp;
																			<span class="optional">(opcional)</span>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input type="text" class="input-text " name="billing_address_2" id="billing_address_2" placeholder="Apartamento, suíte, unidade, etc. (opcional)" value="" autocomplete="address-line2" data-placeholder="Apartamento, suíte, unidade, etc. (opcional)">
																		</span>
																	</p>
																	<p class="form-row form-row-first address-field woocommerce-validated" id="billing_neighborhood_field" data-priority="65">
																		<label for="billing_neighborhood" class="">Bairro&nbsp;
																			<abbr class="required" title="obrigatório">*																				
																			</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input required type="text" class="input-text " name="billing_neighborhood" id="billing_neighborhood" placeholder="" value="">
																		</span>
																	</p>
																	<p class="form-row form-row-last address-field validate-required woocommerce-invalid woocommerce-invalid-required-field" id="billing_city_field" data-priority="70" data-o_class="form-row form-row-last address-field validate-required">
																		<label for="billing_city" class="">Cidade&nbsp;
																			<abbr class="required" title="obrigatório">*																				
																			</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<input required type="text" class="input-text " name="billing_city" id="billing_city" placeholder="" value="" autocomplete="address-level2">
																		</span>
																	</p>
																	<p class="form-row form-row-wide address-field validate-required validate-state woocommerce-validated" id="billing_state_field" data-priority="80" data-o_class="form-row form-row-wide address-field validate-required validate-state">
																		<label for="billing_state" class="">Estado&nbsp;
																			<abbr class="required" title="obrigatório">*</abbr>
																		</label>
																		<span class="woocommerce-input-wrapper">
																			<select required name="billing_state" id="billing_state" class="state_select select2-hidden-accessible" autocomplete="address-level1" data-placeholder="Selecione uma opção…" data-input-classes="" tabindex="-1" aria-hidden="true">
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
                                                                          <tbody>
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
																							<span class="woocommerce-Price-currencySymbol" style="white-space: nowrap"><center><?php echo $config['moeda'].' '.number_format($total_carrinho, 2, ",", ".");  ?></center></span></span></td>
																						
																					
																				</tr>
																				<tr class="woocommerce-shipping-totals shipping">
																				    <td><strong><center>Desconto</center></strong> <span id="desconto"></span>
																				    <td><span id="d_valor"></span>
																				</tr>
																				<tr class="woocommerce-shipping-totals shipping">
																					<td><strong><center>Entrega</center></strong> <span id="frete"></span>
                                                                                        <?php if(!empty($deliveries)){ foreach($deliveries as $kyd => $dvy){ ?>
                                                                                        <span id="<?php echo $dvy['id']; ?>" for=""></span>
                                              <?php }} if($retirada['retirada'] == "checked") { ?>  
																					    <label for="retirada" style="cursor:pointer; margin-left:10px;" for="retirada"><input type="radio" name="frete" id="retirada" class="retirada" required style='cursor:pointer;white-space: nowrap' value="0,00"  > 
																					    <b>Retirada na loja</b><br>Valor do frete: R$ 0,00 / Prazo de entrega: imediato.</label> 
                                              <script>
                                                    document.getElementById("retirada").addEventListener("change", function() {
                                                      const z = 0;
                                                      document.getElementById("vl_frete").value = z;
                                                      let desconto = sessionStorage.getItem('totalDesconto');
                                                      const a = document.getElementById("retirada").value;
                                                      const v = parseFloat(document.getElementById('v_desconto').value = eval(desconto));
                                                      const b = z - v + <?php echo $total_carrinho; ?>;
                                                      const c = b.toFixed(2).toString().replace(".",",");																					  
                                                      document.getElementById("f_valor").innerHTML = "<?php echo $config['moeda']?> "+a;
                                                      document.getElementById("valor_geral").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                      document.getElementById("total").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                      document.getElementById("valor").value = b;
													  document.getElementById("tipo_entrega").value = "Retirada na Loja";
													  document.getElementById("d_valor").innerHTML = "<?php echo $config['moeda']?> "+v.toFixed(2).toString().replace(".",",");
													  
                                                  });
                                              </script>
                                              <?php } ?>
                                              </td>
											<td data-title="Entrega" > <span id="f_valor" ></span></td>
										</tr>																			
									<script> 
									       let desconto = sessionStorage.getItem('totalDesconto');
                                            if( desconto != null){ 
                                                document.getElementById('v_desconto').value = eval(desconto);
                                            }else{
                                                sessionStorage.setItem('totalDesconto', '0.00');
                                                document.getElementById('d_valor').innerHTML = "<?php echo $config['moeda']." 0,00" ?>";
                                            };
                                              function main_math(){
                                                  let desconto = sessionStorage.getItem('totalDesconto');
                                                 const cep = document.getElementById('cepdestino').value.replace('-','');
                                                <?php if(!empty($deliveries)){ foreach($deliveries as $keyd => $delivery){ ?>
                                                $("<?php echo '#'.$delivery['id']; ?>").load('<?php echo ConfigPainel('base_url').$delivery['path']."/wa/index.php?peso=".$total_peso."&valorcarrinho=".$total_carrinho; ?>&id='+cep);
                                                  
                                                 D<?php echo $delivery['id']; ?> = (z) =>{
                                                    document.getElementById("vl_frete").value =  z;
                                                    const a = document.getElementById("<?php echo $delivery['nome']; ?>").value;	
                                                    const v = parseFloat(eval(desconto)).toFixed(2);
                                                    const b = z - v + <?php echo $total_carrinho; ?>;
                                                    const c = b.toFixed(2).toString().replace(".",",");																					 
                                                    document.getElementById("f_valor").innerHTML = "<?php echo $config['moeda']?> "+a;
                                                    document.getElementById("valor_geral").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                    document.getElementById("total").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                    document.getElementById("valor").value = b;
                                                    document.getElementById("d_valor").innerHTML = "<?php echo $config['moeda']?> "+v.toString().replace(".",",");
                                                    document.getElementById("tipo_entrega").value = "<?php echo $delivery['titulo']; ?>";
                                                }
                                                <?php }} if($retirada['entrega'] == "checked") { ?>
                                                $("#frete").load('<?php echo ConfigPainel('base_url')?>wa/ecommerce/checkout/preload/');
                                                $("#frete").load('<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>wa/ecommerce/apis/correios.php?destino='+cep+'&origem=<?php echo $read['cep']?>');
                                               
                                              Cfrete = (z) =>{
                                                  let desconto = sessionStorage.getItem('totalDesconto');
                                                document.getElementById("vl_frete").value = z.toFixed(2).toString().replace(",",".");
                                                const a = document.getElementById("normal").value;
                                                const v = parseFloat(eval(desconto)).toFixed(2);
                                                const b = z - v + <?php echo $total_carrinho; ?>;
                                                const c = b.toFixed(2).toString().replace(".",",");																					  
                                                document.getElementById("f_valor").innerHTML = "<?php echo $config['moeda']?> "+a;
                                                document.getElementById("valor_geral").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                document.getElementById("total").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                document.getElementById("valor").value = b;
                                                document.getElementById("d_valor").innerHTML = "<?php echo $config['moeda']?> "+v.toString().replace(".",",");
                                                document.getElementById("tipo_entrega").value = "PAC";
                                              };
                                              Cfrete1 = (z) =>{
                                                  let desconto = sessionStorage.getItem('totalDesconto');
                                                document.getElementById("vl_frete").value =  z.toFixed(2).toString().replace(",",".");
                                                const a = document.getElementById("expresso").value;	
                                                const v = parseFloat(eval(desconto)).toFixed(2);
                                                const b = parseFloat(z - v) + <?php echo $total_carrinho; ?>;
                                                const c = b.toFixed(2).toString().replace(".",",");																					 
                                                document.getElementById("f_valor").innerHTML = "<?php echo $config['moeda']?> "+a;
                                                document.getElementById("valor_geral").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                document.getElementById("total").innerHTML = "<?php echo $config['moeda']?> "+ c;
                                                document.getElementById("valor").value = b;
                                                document.getElementById("d_valor").innerHTML = "<?php echo $config['moeda']?> "+v.toString().replace(".",",");
                                                document.getElementById("tipo_entrega").value = "Sedex";
                                              }
                                          <?php } ?>
                                            }
                                            $("#cepdestino").change(function(){
                                                 new main_math()
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
                                  	<?php 
									if(!empty($gateways)){ 
									  foreach($gateways as $keyp => $plugin){                                         
										if(strpos($plugin['nome'], 'transparente')!==false){ ?>
										<li class="wc_payment_method payment_method_traferencia">
                                        	<input onclick="<?php echo $plugin['nome']; ?>('../../../<?php echo $plugin['path']?>/wa/')" data-toggle="modal" data-target="#<?php echo $plugin['nome']; ?>" id="payment_method_<?php echo $plugin['nome']; ?>1" type="radio" required class="input-radio" name="payment_method" value="cartão">
                                        	<label for="payment_method_<?php echo $plugin['nome']; ?>1" style="cursor:pointer">
                                         		Pagar com Cartão
                                        	</label>                                                                                
                                    	</li>
										<li class="wc_payment_method payment_method_traferencia">
                                        	<input value="pix" onclick="<?php echo $plugin['nome']; ?>('../../../<?php echo $plugin['path']?>/wa/')" data-toggle="modal" data-target="#<?php echo $plugin['nome']; ?>" id="payment_method_<?php echo $plugin['nome']; ?>2" type="radio" required class="input-radio" name="payment_method" >
                                        	<label for="payment_method_<?php echo $plugin['nome']; ?>2" style="cursor:pointer">
                                         		Pagar com Pix
                                        	</label>                                                                                
                                    	</li>	
										<li class="wc_payment_method payment_method_traferencia">
                                        	<input value="boleto" onclick="<?php echo $plugin['nome']; ?>('../../../<?php echo $plugin['path']?>/wa/')" data-toggle="modal" data-target="#<?php echo $plugin['nome']; ?>" id="payment_method_<?php echo $plugin['nome']; ?>3" type="radio" required class="input-radio" name="payment_method"  >
                                        	<label for="payment_method_<?php echo $plugin['nome']; ?>3" style="cursor:pointer">
                                         		Pagar com Boleto
                                        	</label>                                                                                
                                    	</li>										
                                    	<?php }else {?>
											<li class="wc_payment_method payment_method_traferencia">
                                        		<input id="payment_method_<?php echo $plugin['nome']; ?>" type="radio" required class="input-radio" name="payment_method" value="<?php echo $plugin['titulo']; ?>" onclick="compose('../../../'<?php echo $plugin['path'] ?>'/wa/index.php')">
                                        		<label for="payment_method_<?php echo $plugin['nome']; ?>" style="cursor:pointer">
                                         			Pagar com <?php if(!empty($plugin['img'])) { ?>
                                          			<img style="width:auto; height:23px;" src="<?php echo RemoveHttpS(ConfigPainel('base_url')). $plugin['img']; } ?>" />
                                        		</label>                                                                                
                                    		</li>
										<?php }}}  ?>
                                    <script>
                                    compose = (a) => {
                                    document.getElementById('composer').value=a;                                      
                                     if(document.getElementById('mptdyn')!= undefined) return document.getElementById('mpt-form').innerHTML=''
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
                                    <?php endif ?>
                                   <script>
                                    $('#fcheckout').submit(function(e) {                                   
                                             e.preventDefault(); 
                                          	if(document.getElementById('payment_method_deposito') != void(0) && document.getElementById('payment_method_deposito').checked){                                           
                                              	resolveAfter2Seconds().then((res)=>{
                                            	sessionStorage.setItem("vfrete", document.getElementById("f_valor").innerHTML);
                                            	sessionStorage.setItem("frete", document.getElementById("tipo_entrega").value);
    	                                        sessionStorage.setItem("ttl", document.getElementById("total").innerHTML);
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
                                              })
                                            }else if(document.getElementById('mptdyn')== undefined){                                         
                                              sessionStorage.clear()
                                              validateMyForm()
                                            }
                                              document.getElementById('finalizar').innerHTML = "<i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i>";
                                      });
                                    </script>
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
									<input  type="hidden" name="v_desconto" id="v_desconto" value="0.00">
									<input required type="hidden" name="tipo_entrega" id="tipo_entrega" value="">
									<input required type="hidden" name="vl_frete" id="vl_frete" value="">
									<input type="hidden" name="criar" id="criar" value="não">
									<input type="hidden" name="pagina_cliente"  value="<?php  echo $config['pagina_cliente']; ?>">
									<?php if($deposito['status'] != "checked" && $pagseguro['status'] != "checked"  && empty($gateways) ): else: ?>
									<center id="finalizar"><input type="submit" id="cartCheckout"  value="Finalizar compra" ></center>
									<?php endif ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
                          <?php 
                              if(!empty($gateways)){ 
                                foreach($gateways as $keyp => $plugin){                                         
                                  if(strpos($plugin['nome'], 'transparente')!==false){ 
                                  require_once("../../../".$plugin['path']."/wa/index.php");
                                  } 
                                }
                              }                          
                          ?>
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
			function person(a){
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
          
     <?php 
        if(is_array($enderecos)){
            foreach($enderecos as $endereco_key => $endereco){
                if($endereco->padrao == true){?>                  
                        document.getElementById('billing_state').value ='<?=$endereco->estado?>'
                        document.getElementById('billing_first_name').value ='<?=$usuario['nome']?>'
                        document.getElementById('billing_last_name').value ='<?=$usuario['sobrenome']?>'
                        document.getElementById('billing_email').value ='<?=$usuario['email']?>'
                        document.getElementById('billing_phone').value ='<?=$usuario['telefone']?>'
                        document.getElementById('billing_neighborhood').value ='<?=$endereco->bairro?>'
                        document.getElementById('billing_city').value ='<?=$endereco->cidade?>'
                        document.getElementById('billing_number').value ='<?=$endereco->numero?>'
                        document.getElementById('cepdestino').value = '<?=$endereco->cep?>'
						const inputValue2 = document.querySelector("#cepdestino");
						let zipCode2 =inputValue2.value						
						if(zipCode2.length === 8) {
							inputValue2.value = `${zipCode2.substr(0,5)}-${zipCode2.substr(5,9)}`;				
						}
                        document.getElementById('billing_address_1').value ='<?=$endereco->rua?>'
                        document.getElementById('billing_persontype').value ='<?=$usuario['pessoa']?>'
                        document.getElementById('billing_cpf').value = '<?=$usuario['id_pessoa']?>'
                        new person('<?=$usuario['pessoa']?>')
                        new main_math()
                        function validateMyForm(){
							document.getElementById('fcheckout').submit()
						}
						async function resolveAfter2Seconds(){
							return true;
						};
					
					<?php }
				}
			}else{ ?>
                
                function resolveAfter2Seconds() {
                  return new Promise(resolve => {
                    setTimeout(() => {
                      resolve(
                          Swal.fire({
                                    title: 'Você deseja que criemos uma conta automática para otimizar suas futuras compras, ou ainda prefere terminar como visitante?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Criar conta',
                                    cancelButtonText: 'Continuar com visitante ',
                                    confirmButtonColor: '<?php echo $config['carrinho_cor_btn_finalizar']; ?>',
                                    cancelButtonColor: '<?php echo $config['carrinho_cor_btn_finalizar']; ?>',
                                    reverseButtons: true
                                }).then((result) => {
                                  if (result.isConfirmed) {
                                   document.getElementById('criar').value = 'sim'
                                  }
                                   return result.isConfirmed
                           })
                          );
                    }, 1);
                  });
                }
                async function validateMyForm() {
                    var x = await resolveAfter2Seconds();
                    document.getElementById('fcheckout').submit()
                    return x
                  
                }
    
        <?php }?>
		const inputValue = document.querySelector("#cepdestino");
			let zipCode = "";
			inputValue.addEventListener("keyup", () => {
			zipCode = inputValue.value;			
			if(zipCode.length === 8) {
				inputValue.value = `${zipCode.substr(0,5)}-${zipCode.substr(5,9)}`;				
			}
		});
      </script>
