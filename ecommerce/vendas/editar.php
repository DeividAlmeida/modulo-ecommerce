<?php
  require_once('../../includes/funcoes.php');
  require_once('../../database/config.database.php');
  require_once('../../database/config.php');
  $id = $_GET['id'];
  $read = DBRead('ecommerce_vendas','*',"WHERE id = '{$id}'");
  print_r("<h4>Pedido Nº ".$read[0]['id']."</h4>")[0];
?>
<div class="card-body">
    <div class="row">
        <div class="col-md-12"> 
            <div class="form-group">
                <label>Código de Rastreamento: </label>
                <input class="form-control" type="text" name="rastreamento"  value="<?php echo $read[0]['rastreamento'];?>">
            </div>
        </div>
    </div>  
<hr>
    <div class="row">
        <input type="hidden" name="id" value="<?php print_r($read[0]['id']); ?>">
        <div class="col-md-6">
            <div class="form-group">
                <label>Comprador: </label>
                <input class="form-control" type="text" name="nome"  value="<?php echo $read[0]['nome'];?>">
            </div>                
            <div class="form-group">
                <label>Tipo de Pessoa: </label>
                <select name="tipo_pessoa" required class="form-control custom-select">
                    <option value="1" <?php Selected($read[0]['tipo_pessoa'], "1"); ?>>CPF</option>
                    <option value="2" <?php Selected($read[0]['tipo_pessoa'], "2"); ?>>CNPJ</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nº do Documento: </label>
                <input class="form-control" type="text" name="id_pessoa" required value="<?php echo $read[0]['id_pessoa'];?>">
            </div> 
            <div class="form-group">
                <label>Telefone: </label>
                <input class="form-control" type="telefone" name="telefone" required value="<?php echo $read[0]['telefone'];?>">
            </div>
            <div class="form-group">
                <label>Email: </label>
                <input class="form-control" type="email" name="email" required value="<?php echo $read[0]['email'];?>">
            </div> 
            <div class="form-group">
                <label>Observação:</label>
                <textarea class="md-textarea form-control" rows="8"  name="nota"  value="<?php echo $read[0]['nota']; ?>"><?php echo $read[0]['nota']; ?></textarea>
            </div>     
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Tipo de Entrega:</label>
                <select required name="tipo_entrega" class="form-control custom-select">
                    <option value="PAC" <?php Selected($read[0]['tipo_entrega'], "PAC"); ?>>PAC</option>
                    <option value="SEDEX" <?php Selected($read[0]['tipo_entrega'], "SEDEX"); ?>>SEDEX</option>
                </select>
            </div>                
            <div class="form-group">
                <label>Estado: </label>
                <select required name="estado" class="form-control custom-select">
                    <option value="AC" <?php Selected($read[0]['estado'], "AC"); ?>>Acre</option>
                    <option value="AL" <?php Selected($read[0]['estado'], "AL"); ?>>Alagoas</option>
                    <option value="AP" <?php Selected($read[0]['estado'], "AP"); ?>>Amapá</option>
                    <option value="AM" <?php Selected($read[0]['estado'], "AM"); ?>>Amazonas</option>
                    <option value="BA" <?php Selected($read[0]['estado'], "BA"); ?>>Bahia</option>
                    <option value="CE" <?php Selected($read[0]['estado'], "CE"); ?>>Ceará</option>
                    <option value="DF" <?php Selected($read[0]['estado'], "DF"); ?>>Distrito Federal</option>
                    <option value="ES" <?php Selected($read[0]['estado'], "ES"); ?>>Espírito Santo</option>
                    <option value="GO" <?php Selected($read[0]['estado'], "GO"); ?>>Goiás</option>
                    <option value="MA" <?php Selected($read[0]['estado'], "MA"); ?>>Maranhão</option>
                    <option value="MT" <?php Selected($read[0]['estado'], "MT"); ?>>Mato Grosso</option>
                    <option value="MS" <?php Selected($read[0]['estado'], "MS"); ?>>Mato Grosso do Sul</option>
                    <option value="MG" <?php Selected($read[0]['estado'], "MG"); ?>>Minas Gerais</option>
                    <option value="PA" <?php Selected($read[0]['estado'], "PA"); ?>>Pará</option>
                    <option value="PB" <?php Selected($read[0]['estado'], "PB"); ?>>Paraíba</option>
                    <option value="PR" <?php Selected($read[0]['estado'], "PR"); ?>>Paraná</option>
                    <option value="PE" <?php Selected($read[0]['estado'], "PE"); ?>>Pernambuco</option>
                    <option value="PI" <?php Selected($read[0]['estado'], "PI"); ?>>Piauí</option>
                    <option value="RJ" <?php Selected($read[0]['estado'], "RJ"); ?>>Rio de Janeiro</option>
                    <option value="RN" <?php Selected($read[0]['estado'], "RN"); ?>>Rio Grande do Norte</option>
                    <option value="RS" <?php Selected($read[0]['estado'], "RS"); ?>>Rio Grande do Sul</option>
                    <option value="RO" <?php Selected($read[0]['estado'], "RO"); ?>>Rondônia</option>
                    <option value="RR" <?php Selected($read[0]['estado'], "RR"); ?>>Roraima</option>
                    <option value="SC" <?php Selected($read[0]['estado'], "SC"); ?>>Santa Catarina</option>
                    <option value="SP" <?php Selected($read[0]['estado'], "SP"); ?>>São Paulo</option>
                    <option value="SE" <?php Selected($read[0]['estado'], "SE"); ?>>Sergipe</option>
                    <option value="TO" <?php Selected($read[0]['estado'], "TO"); ?>>Tocantins</option>
                </select>
            </div>
            <div class="form-group">
                <label>Cidade: </label>
                <input class="form-control" type="text" name="cidade" required value="<?php echo $read[0]['cidade'];?>">
            </div> 
            <div class="form-group">
                <label>Bairro: </label>
                <input class="form-control" type="nome" name="bairro" required value="<?php echo $read[0]['bairro'];?>">
            </div>
            <div class="form-group">
                <label>Cep: </label>
                <input class="form-control" type="text" name="cep" required value="<?php echo $read[0]['cep'];?>">
            </div>
            <div class="form-group">
                <label>Rua: </label>
                <input class="form-control" type="text" name="rua" required value="<?php echo $read[0]['rua'];?>">
            </div>
            <div class="form-group">
                <label>Número: </label>
                <input class="form-control" type="text" name="numero" required value="<?php echo $read[0]['numero'];?>">
            </div>
            <div class="form-group">
                <label>Complemento: </label>
                <input class="form-control" type="text" name="complemento" value="<?php echo $read[0]['complemento'];?>">
            </div>      
        </div>
    </div>
    <hr>
    <div class="form-group">
            <label>Valor da Venda: <i class="icon icon-question-circle tooltips" data-tooltip="Valor do(s) produto(s) com o frete." ></i></label>
            <input class="form-control" type="num" name="valor" required value="<?php echo number_format($read[0]['valor'], 2);?>">
        </div>
    <div class="row">            
        <?php $pdts = json_decode($read[0]['produto'], true); foreach($pdts as $key => $pdt): ?>
        <div class="col-md-<?php echo 12/count($pdts); ?>">                
            <div class="form-group">
                <label>Produto:</label>
                <textarea class="md-textarea form-control" rows="3"  name="produto[]" required value="<?php print_r($pdt['produto']); ?>"><?php print_r($pdt['produto']); ?></textarea>
            </div>
            <div class="form-group">
                <label>Quantidade: </label>
                <input class="form-control"  type="number" name="qtd[]" required value="<?php print_r($pdt['qtd']); ?>">
            </div>
            <div class="form-group">
                <label>Valor Unitário: </label>
                <input class="form-control" type="num" name="un_valor[]" required value="<?php print_r($pdt['un_valor']); ?>">
            </div>
            <div class="form-group">
                <label>Id do Produto: </label>
                <input class="form-control" type="num" name="id_pdt[]" required value="<?php print_r($pdt['id_pdt']); ?>">
            </div>
        </div>
            <?php endforeach ?>            
</div>
    
  <script>
$('#editarPedido').submit(function(e) {
    e.preventDefault();
    var data = $(this).serializeArray();
    console.log(data);
    $.ajax({
        async:   false,
        data: data,
        type: "POST",
        cache: false,
        url: "ecommerce.php?editarPedido", 
        beforeSend: function(data){
					swal({
					title: 'Aguarde!',
					text: 'Estamos salvando as informações do pedido.\nNão recarregue a página até a mensagem de sucesso.',
					icon: "info",
					html: true,
					showConfirmButton: true
				});
				},
        complete: function( data ){
            swal("Pedido Atualizado!", "Pedido atualizado com sucesso!", "success");                              
        setImmediate(function refreshTable() {$('#BootstrapTable').bootstrapTable('refresh', {silent: false});});
        }
                                      
    });            
}); 

  </script>
  