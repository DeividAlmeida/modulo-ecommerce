<?php 
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');

$id = base64_decode($_GET['Z']);
$read = DBRead('ecommerce_vendas','*',"WHERE id = '{$id}'")[0];

$reading = DBRead('ecommerce_config_entrega','*',"WHERE id = '1'")[0]; 
$data = new DateTime();
$data->format('d/m/Y H:i:s');
$data = new DateTime($read['data']);
$p = json_decode($read['produto'], true);
?>
<!DOCTYPE html>
<html lang=”pt-br”>
    <head>
    <meta charset=”UTF-8”>
    <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>assets/css/app.css">
    </head>
    <body>
        <div class="card">
            <div class="card-header text-left" style="background-color:#000133">
                <p class="">
                    <h5 style=" font-size:15px; color:#fff; margin-left:60%; ">Telefone: <?php echo $reading['telefone']; ?></h5>
                    <h5 style=" font-size:15px; color:#fff; margin-left:60%; ">Email: <?php echo $reading['email']; ?></h5>
                </p>
            </div>

            <div class="card-body">
                <div class="contaner-fluid">
                    <div class="row justify-content-md-center">
                        <div class="card col-sm-3" style="padding:0px;margin-right:3%;">
                            <div class="card-header" style="background-color:#fff; color: #86939e; font-size:13px">
                                SEUS DADOS
                            </div>
                            <div class="card-body" style="color: #86939e">
                                <b>Comprador: </b><?php echo $read['nome']; ?> <br>
                                <b><?php if($read['tipo_pessoa'] == 2){echo "CNPJ";}else{echo "CPF";}  ?>: </b> <?php echo $read['id_pessoa']; ?><br>
                                <b>Telefone: </b><?php echo $read['telefone']; ?> <br>
                                <b>Email: </b><?php echo $read['email']; ?>  <br>
                            </div>
                        </div> 
                        <div class="card col-sm-3" style="padding:0px; margin-right:3%;">
                            <div class="card-header white" style="background-color:#fff; color: #86939e; font-size:13px">
                                DETALHES DO SEU PEDIDO #<?php echo $read['id']; ?>
                            </div>
                            <div class="card-body" style="color: #86939e">
                                <b>Data do Pedido: </b><?php echo $data->format('d/m/Y H:i:s');?><br>
                                <b>Forma de Pagamento: </b><?php echo $read['tipo_pagamento']; ?><br>
                                <b>Valor da Compra: </b><?php echo "R$ ".number_format($read['valor'], 2, ",", ".");?>
                            </div>
                        </div>
                        <div class="card col-sm-3" style="padding:0px; ">
                            <div class="card-header white" style="background-color:#fff; color: #86939e; font-size:13px">
                                SUA COMPRA
                            </div>
                            
                            <div class="card-body" style="color: #86939e">
                                <table style="width:100%">
                            <?php foreach($p as $pd):                            
                                $zx = $pd['id_pdt'];
                                $r = DBRead('ecommerce','*',"WHERE id = '{$zx}'")[0];
                                $fotos   = DBRead('ecommerce_prod_imagens','*', "WHERE id_produto = {$zx}");
                                $termo   = DBRead('ecommerce_prod_termos','*', "WHERE id_produto = {$zx}")[0];
                                $termos =  array_unique($termo);
                                $capa   = DBRead('ecommerce','*', "WHERE id = {$zx}")[0];
                                if(is_array($fotos)){
                                    foreach($fotos as $foto){
                                        if($foto['id'] == $capa['id_imagem_capa']){
                                            $foto_capa = $foto;
                                        }
                                    }
                                }
                                ?>
                                    <tr style="font-size:12px;">
                                        <td><img src="<?php echo RemoveHttpS(ConfigPainel('base_url'))."wa/ecommerce/uploads/".$foto['uniq']; ?>" height="50"/></td>
                                        <td ><b>Produto: </b> <?php echo $capa['nome'] ?><br><?php foreach($termos as $att){ 
                                        $atributo   = DBRead('ecommerce_atributos','*', "WHERE id = {$att}")[0];
                                        echo "<b>".$atributo['nome']." </b>";
                                        }  ?>
                                        :  <br><b>Quantidade: </b> <?php echo $pd['qtd']; ?></td>
                                        <td><?php echo "R$ ".number_format($pd['un_valor'], 2, ",", ".");?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </table>
                            </div>
                        </div>
                        <div class="card col-sm-3" style="padding:0px; margin-right:3%; margin-top:2%;">
                            <div class="card-header white" style="background-color:#fff; color: #86939e; font-size:13px">
                                CÓDIGO DE RASTREIO
                            </div>
                            
                            <div class="card-body" style="color: #86939e">
                                <p><b>Código: </b><?php echo $read['rastreamento']; ?></p>
                                <a style="text-decoration:none" class="btn btn-primary btn-xs" href="https://linketrack.com/track?utm_source=link&codigo=<?php echo $read['rastreamento']; ?>" target="_blank">Rastrear Pedidos</a>
                            </div>
                        </div>
                        <div class="card col-sm-3" style="padding:0px;margin-top:2%;">
                            <div class="card-header white" style="background-color:#fff; color: #86939e; font-size:13px">
                                STATUS DO PEDIDO
                            </div>
                            
                            <div class="card-body" style="color: #86939e">
                                <span id="bar" > </span>
                            </div>
                        </div>
                    </div>     
                </div>
            </div>   
        </div>
        <script>
            window.onload = function() {
                const pagamento_pendente = 'Pagamento Pendente';
                const processando = 'Processando';
                const aguardando = 'Aguardando';
                const pedido_enviado = 'Pedido Enviado';
                const concluido = 'Concluido';
                document.getElementById('bar').innerHTML = "<p style='background-color:#<?php echo $read['cor_status']; ?>; '>" + <?php echo $read['status']; ?> + "</p>";
            };
    </script>
    </body>
<html>