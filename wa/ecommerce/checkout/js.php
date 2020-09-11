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
      $('#fcheckout').submit(function(e) {
          if(document.getElementById('payment_method_deposito').checked){
              e.preventDefault();            
              var adata = $(this).serializeArray();
              $.ajax({
                data: adata,
                type:    "POST",
                cache:   false,
                url:     UrlPainel+'wa/ecommerce/checkout/PagSeguro.php',
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
      
      <?php if($retirada['retirada'] == "checked") { ?>
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
          });
      </script>
      <?php } ?>
      
      <script>                                          

              $(document).ready(function(){
                $("#cepdestino").change(function(){
                const cep = document.getElementById('cepdestino').value;
                $("#frete").load('<?php echo ConfigPainel('base_url')?>wa/ecommerce/checkout/preload/');
                $("#frete").load('https://nameless-atoll-10880.herokuapp.com/'+cep+'<?php echo "/".$config['cep_origem']."/".$total_peso."/".$total_comprimento."/".$total_altura."/".$total_largura; ?>');
                });
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
              };                                              
            });

                                                                                </script>