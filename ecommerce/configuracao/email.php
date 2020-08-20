<?php $query = DBRead('ecommerce_config_email','*',"WHERE id = '1'")[0]; ?>
<form id="emails" method="post" >
    <div class="card">
        <div class="card-header white">
        <strong>Configurar E-mail de Notificação</strong>
    </div>
    <div class="card-body">        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome">Nome da Loja:</label>
                    <input type="text" name="nome" class="form-control" value="<?php echo $query['nome']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="remetente">E-mail da Loja:</label>
                    <input type="text" name="remetente" class="form-control" value="<?php echo $query['remetente']; ?>">
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="t_pagamento_pendente">Título  Pagamento Pendente:</label>
                    <input type="text" name="t_pagamento_pendente" class="form-control" value="<?php echo $query['t_pagamento_pendente']; ?>">
                </div>
                <div class="form-group">
                    <label for="pagamento_pendente">Mensagem Pagamento Pendente:</label>
                    <textarea type="text" name="pagamento_pendente" rows="5" class="md-textarea form-control" value="<?php echo $query['pagamento_pendente']; ?>"><?php echo $query['pagamento_pendente']; ?></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="t_processando">Título  Processando:</label>
                    <input type="text" name="t_processando" class="form-control" value="<?php echo $query['t_processando']; ?>">
                </div>
                <div class="form-group">
                    <label for="processando">Mensagem Processando:</label>
                    <textarea type="text" name="processando" rows="5" class="md-textarea form-control" value="<?php echo $query['processando']; ?>"><?php echo $query['processando']; ?></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="t_aguardando">Título  Aguardando:</label>
                    <input type="text" name="t_aguardando" class="form-control" value="<?php echo $query['t_aguardando']; ?>">
                </div>
                <div class="form-group">
                    <label for="aguardando">Mensagem Aguardando:</label>
                    <textarea type="text" name="aguardando" rows="5" class="md-textarea form-control" value="<?php echo $query['aguardando']; ?>"><?php echo $query['aguardando']; ?></textarea>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="t_pedido_enviado">Título  Pedido Enviado:</label>
                    <input type="text" name="t_pedido_enviado" class="form-control" value="<?php echo $query['t_pedido_enviado']; ?>">
                </div>
                <div class="form-group">
                    <label for="pedido_enviado">Mensagem Pedido Enviado:</label>
                    <textarea type="text" name="pedido_enviado" rows="5" class="md-textarea form-control" value="<?php echo $query['pedido_enviado']; ?>"><?php echo $query['pedido_enviado']; ?></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="t_concluido">Título Concluído:</label>
                    <input type="text" name="t_concluido" class="form-control" value="<?php echo $query['t_concluido']; ?>">
                </div>
                <div class="form-group">
                    <label for="concluido">Mensagem Concluído:</label>
                    <textarea type="text" name="concluido" rows="5" class="md-textarea form-control" value="<?php echo $query['concluido']; ?>"><?php echo $query['concluido']; ?></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="t_cancelado">Título  Cancelado:</label>
                    <input type="text" name="t_cancelado" class="form-control" value="<?php echo $query['t_cancelado']; ?>">
                </div>
                <div class="form-group">
                    <label for="cancelado">Mensagem Cancelado:</label>
                    <textarea type="text" name="cancelado" rows="5" class="md-textarea form-control" value="<?php echo $query['cancelado']; ?>"><?php echo $query['cancelado']; ?></textarea>
                </div>
            </div>
        </div><br>
        <div class="row d-flex justify-content-center">
            <div class="col-md-4">
            <div class="form-group">
                    <label for="t_reembolsado">Título  Reembolsado:</label>
                    <input type="text" name="t_reembolsado" class="form-control" value="<?php echo $query['t_reembolsado']; ?>">
                </div>
                <div class="form-group">
                    <label for="reembolsado">Mensagem Reembolsado:</label>
                    <textarea type="text" name="reembolsado" rows="5" class="md-textarea form-control" value="<?php echo $query['reembolsado']; ?>"><?php echo $query['reembolsado']; ?></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer white">
            <button class="btn btn-primary float-right" type="submit">Atualizar</button>
        </div>   
    </div>
</form>
<script>

  </script>