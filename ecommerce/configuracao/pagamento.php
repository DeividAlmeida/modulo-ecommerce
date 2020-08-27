<?php 
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
?>

    <div class="card">
        <div class="card-header white">
        <strong>Configurar Meio de Pagamento</strong>
    </div>
    <div class="card-body">        
        <?php if($_GET['tipo'] == 'pagseguro'): 
        $read = DBRead('ecommerce_config_pagseguro','*',"WHERE id = '1'")[0]; ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">E-mail do PagSeguro:</label>
                    <input type="text" name="email" class="form-control" placeholder="Coloque o e-mail de configuração do PagSeguro" value="<?php echo $read['email']; ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="token">Token do PagSeguro:</label>
                    <input type="text" name="token" class="form-control" placeholder="Coloque o token de configuração do PagSeguro" value="<?php echo $read['token']; ?>">
                </div>
            </div>
        </div>
        <script>
            $('#mpag').submit(function(e) {
                e.preventDefault();            
                var data = $(this).serializeArray();
                $.ajax({
                    async:   false,
                    data: data,
                    type: "POST",
                    cache: false,
                    url: "ecommerce.php?pagseguro",
                    complete: function( data ){
                        swal("Informações de pagamento Atualizadas!", "Informações de pagamento atualizadas com sucesso!", "success")
                    }
                });
            });
        </script>
        <?php endif ?>
        <?php if($_GET['tipo'] == "deposito"): 
        $read = DBRead('ecommerce_config_deposito','*',"WHERE id = '1'")[0]; ?>
        <script src="css_js/jquery.multifield.min.js"></script>
    <script>
            	
                $('#mdep').submit(function(e) {
                    e.preventDefault();            
                    var data = $(this).serializeArray();
                    $.ajax({
                        async:   false,
                        data: data,
                        type: "POST",
                        cache: false,
                        url: "ecommerce.php?deposito",
                        complete: function( data ){
                            swal("Informações de pagamento Atualizadas!", "Informações de pagamento atualizadas com sucesso!", "success")
                        }
                    });
                });

                $( document ).ready(function() {
                    $('#input_group').multifield({
                        section: '.groupItens',
                        btnAdd:'.btnAdd',
                        btnRemove:'.btnRemove',
                        locale:{
                        "multiField": {
                            "messages": {
                            "removeConfirmation": "Deseja realmente remover este campo?"
                            }
                        }
                        }
                    });
                    });
            </script>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" name="titulo" class="form-control"  value="<?php echo $read['titulo']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" name="descricao" class="form-control" value="<?php echo $read['descricao']; ?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="instucoes">Instruções:</label>
                    <textarea type="text" name="instucoes" rows="3" class="md-textarea form-control" value="<?php echo $read['instucoes']; ?>"><?php echo $read['instucoes']; ?></textarea>
                </div>
            </div>
            <hr>
        </div>
        <div id="input_group">              
            <div class="col-md-12">                
                <div class="form-group">
                    <label for="detalhes">Detalhes da Conta:</label>
                </div>
            </div>
            <div class="col-md-12"><button type="button" class="btn btn-primary btnAdd" style="margin-bottom: 15px;"><i class="icons icon-plus"></i></button></div>
            <?php $dtls = json_decode($read['detalhes'], true); if(is_array($dtls)): foreach($dtls as $key => $dtl): ?>
            <div class="groupItens">                
                <div class="row" > 
                    <div class=" col-md-6">                
                        <div class="form-group">
                            <label for="nome">Nome da Conta:</label>
                            <input type="text" name="nome[]" class="form-control"  value="<?php print_r($dtl['nome']); ?>">
                        </div>
                    </div>            
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="conta">Número da Conta:</label>
                            <input type="text" name="conta[]" class="form-control"  value="<?php print_r($dtl['conta']);?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="banco">Banco:</label>
                            <input type="text" name="banco[]" class="form-control"  value="<?php print_r($dtl['banco']); ?>">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="agencia">Agência:</label>
                            <input type="text" name="agencia[]" class="form-control"  value="<?php print_r($dtl['agencia']);?>">
                        </div>
                    </div>
                    <div class="col-md-2 ">
                        <div class="form-group">
                            <label ></label>
                            <a type="submit"  class="form-control btn btn-danger btnRemove"><i class="icon-trash"></i></a>
                        </div>
                    </div>                   
                </div>
            </div>
            <?php endforeach;  else : ?>
            <div class="groupItens">                
                <div class="row" > 
                    <div class=" col-md-6">                
                        <div class="form-group">
                            <label for="nome">Nome da Conta:</label>
                            <input type="text" name="nome[]" class="form-control">
                        </div>
                    </div>            
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="conta">Número da Conta:</label>
                            <input type="text" name="conta[]" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="banco">Banco:</label>
                            <input type="text" name="banco[]" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="agencia">Agência:</label>
                            <input type="text" name="agencia[]" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2 ">
                        <div class="form-group">
                            <label ></label>
                            <a type="submit"  class="form-control btn btn-danger btnRemove"><i class="icon-trash"></i></a>
                        </div>
                    </div>                    
                </div>
            </div>
            
            <?php endif ?>
        </div>
        <?php endif ?>
    </div>
    