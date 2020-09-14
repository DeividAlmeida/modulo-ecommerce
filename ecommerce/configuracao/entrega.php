<?php 
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');

$read = DBRead('ecommerce_config_entrega','*',"WHERE id = '1'")[0]; ?>

    <div class="card">
        <div class="card-header white">
        <strong>Configurar de Entrega do Produto</strong>
    </div>
    <div class="card-body">        
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label>Estado: </label>
                <select name="estado" class="form-control custom-select">
                    <option value="" disabled selected>Estado da sua loja física</option>
                    <option value="AC" <?php Selected($read['estado'], "AC"); ?>>Acre</option>
                    <option value="AL" <?php Selected($read['estado'], "AL"); ?>>Alagoas</option>
                    <option value="AP" <?php Selected($read['estado'], "AP"); ?>>Amapá</option>
                    <option value="AM" <?php Selected($read['estado'], "AM"); ?>>Amazonas</option>
                    <option value="BA" <?php Selected($read['estado'], "BA"); ?>>Bahia</option>
                    <option value="CE" <?php Selected($read['estado'], "CE"); ?>>Ceará</option>
                    <option value="DF" <?php Selected($read['estado'], "DF"); ?>>Distrito Federal</option>
                    <option value="ES" <?php Selected($read['estado'], "ES"); ?>>Espírito Santo</option>
                    <option value="GO" <?php Selected($read['estado'], "GO"); ?>>Goiás</option>
                    <option value="MA" <?php Selected($read['estado'], "MA"); ?>>Maranhão</option>
                    <option value="MT" <?php Selected($read['estado'], "MT"); ?>>Mato Grosso</option>
                    <option value="MS" <?php Selected($read['estado'], "MS"); ?>>Mato Grosso do Sul</option>
                    <option value="MG" <?php Selected($read['estado'], "MG"); ?>>Minas Gerais</option>
                    <option value="PA" <?php Selected($read['estado'], "PA"); ?>>Pará</option>
                    <option value="PB" <?php Selected($read['estado'], "PB"); ?>>Paraíba</option>
                    <option value="PR" <?php Selected($read['estado'], "PR"); ?>>Paraná</option>
                    <option value="PE" <?php Selected($read['estado'], "PE"); ?>>Pernambuco</option>
                    <option value="PI" <?php Selected($read['estado'], "PI"); ?>>Piauí</option>
                    <option value="RJ" <?php Selected($read['estado'], "RJ"); ?>>Rio de Janeiro</option>
                    <option value="RN" <?php Selected($read['estado'], "RN"); ?>>Rio Grande do Norte</option>
                    <option value="RS" <?php Selected($read['estado'], "RS"); ?>>Rio Grande do Sul</option>
                    <option value="RO" <?php Selected($read['estado'], "RO"); ?>>Rondônia</option>
                    <option value="RR" <?php Selected($read['estado'], "RR"); ?>>Roraima</option>
                    <option value="SC" <?php Selected($read['estado'], "SC"); ?>>Santa Catarina</option>
                    <option value="SP" <?php Selected($read['estado'], "SP"); ?>>São Paulo</option>
                    <option value="SE" <?php Selected($read['estado'], "SE"); ?>>Sergipe</option>
                    <option value="TO" <?php Selected($read['estado'], "TO"); ?>>Tocantins</option>
                </select>
            </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cidade">Cidade:</label>
                    <input type="text" name="cidade" class="form-control" placeholder="Cidade da sua loja física" value="<?php echo $read['cidade']; ?>">
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bairro">Bairro:</label>
                    <input type="text" name="bairro" class="form-control" placeholder="Bairro da sua loja física" value="<?php echo $read['bairro']; ?>">
                </div>
                <div class="form-group">
                    <label for="rua">Rua:</label>
                    <input type="text" name="rua" class="form-control" placeholder="Rua da sua loja física" value="<?php echo $read['rua']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="numero">Número:</label>
                    <input type="text" name="numero" class="form-control" placeholder="Número da sua loja física" value="<?php echo $read['numero']; ?>">
                </div>
                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" name="cep" class="form-control" placeholder="CEP de onde o produto será postado" value="<?php echo $read['cep']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telefone">Telefone de contato:</label>
                    <input required minlength="11" maxlength="11" type="num" name="telefone" class="form-control" placeholder="Telefone de contato da sua loja" value="<?php echo $read['telefone']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">E-mail de contato:</label>
                    <input type="text" name="email" class="form-control" placeholder="E-mail de contato da sua loja" value="<?php echo $read['email']; ?>">
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="complemento">Complemento:</label>
                    <textarea type="text" name="complemento" rows="5" class="md-textarea form-control" value="<?php echo $read['complemento']; ?>"><?php echo $read['complemento']; ?></textarea>
                </div>                
            </div>
        </div>

    </div>

<script>
$('#entregar').submit(function(e) {
    e.preventDefault();            
    var data = $(this).serializeArray();
    $.ajax({
        async:   false,
        data: data,
        type: "POST",
        cache: false,
        url: "ecommerce.php?editaEntrega",
        complete: function( data ){
            swal("Informações de contato Atualizadas!", "Informações de contato atualizadas com sucesso!", "success")
        }
    });
});
</script>
