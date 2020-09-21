<?php 
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');

$id = base64_decode($_GET['Z']);
$read = DBRead('ecommerce_vendas','*',"WHERE id = '{$id}'")[0];
$readed = DBRead('ecommerce_config_link','*',"WHERE id = '1'")[0]; 
$reading = DBRead('ecommerce_config_entrega','*',"WHERE id = '1'")[0]; 
$data = new DateTime();
$data->format('d/m/Y H:i:s');
$data = new DateTime($read['data']);
$p = json_decode($read['produto'], true);
?>
<!DOCTYPE html>
<html lang='pt-br'>
    <head>
        <meta charset=”UTF-8”>
        <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>assets/css/app.css">
        <title>Acompanhamento do pedido id: <?php echo $read['id']; ?> </title>
    </head>
    <body>
        <div class="card" style="height:100%;">
            <div class="card-header text-left" style="background-color:<?php echo $readed['cabecalho'];?>">
            <table style="width:100%">
                <tr>
                    <td>
                    <?php if(empty($readed['logo'])){ ?>
                            <img id="learn" src=""  />
                        <?php }else{ ?>
                            <img  style="position:relative;" id="learn" src="../../../wa/ecommerce/uploads/<?php echo $readed['logo']; ?>"  />
                        <?php } ?>
                    </td>
                    <td>
                        <p class="">
                            <h5 style=" font-size:15px; color:<?php echo $readed['texto'];?>; margin-left:30%; ">Telefone: <span id="numchange"></span></h5>
                            <h5 style=" font-size:15px; color:<?php echo $readed['texto'];?>; margin-left:30%; ">Email: <?php echo $reading['email']; ?></h5>
                        </p>
                    </td>
                </tr>
            </table>
            </div>

            <div class="card-body" style=" padding-left: 10%; padding-right: 10%;">
                <div class="contaner-fluid">
                    <div class="row justify-content-lg-center">
                        <div class="card col-lg-3" style="padding:0px;margin-right:3%;margin-top:2%">
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
                        <div class="card col-lg-3" style="padding:0px; margin-right:3%;margin-top:2%;">
                            <div class="card-header white" style="background-color:#fff; color: #86939e; font-size:13px">
                                DETALHES DO SEU PEDIDO #<?php echo $read['id']; ?>
                            </div>
                            <div class="card-body" style="color: #86939e">
                                <b>Data do Pedido: </b><?php echo $data->format('d/m/Y H:i:s');?><br>
                                <b>Forma de Pagamento: </b><?php echo $read['tipo_pagamento']; ?><br>
                                <b>Valor da Compra: </b><?php echo "R$ ".number_format($read['valor'], 2, ",", ".");?>
                            </div>
                        </div>
                        <div class="card col-lg-3" style="padding:0px;margin-top:2%; ">
                            <div class="card-header white" style="background-color:#fff; color: #86939e; font-size:13px">
                                SUA COMPRA
                            </div>
                            <div class="card-body" style="color: #86939e;padding:10px;">
                                <table style="width:100%">
                            <?php foreach($p as $pd):                            
                                $zx = $pd['id_pdt'];
                                $r = DBRead('ecommerce','id',"WHERE id = '{$zx}'")[0];                         
                                $fotos   = DBRead('ecommerce_prod_imagens','*', "WHERE id_produto = {$zx}");
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
                                        <td><img src="<?php echo RemoveHttpS(ConfigPainel('base_url'))."wa/ecommerce/uploads/".$foto['uniq']; ?>" height="auto" width="70"/></td>
                                        <td style="padding-left:10px;" >Produto: <?php echo $capa['nome'] ?>
                                        <?php $vai = str_replace($capa['nome'] , "", $pd['produto']); echo $vai; ?>
                                        Quantidade: <?php echo $pd['qtd']; ?><hr></td>
                                        <td><?php echo "R$ ".number_format($pd['un_valor'], 2, ",", ".");?></td>
                                    </tr> 
                                    <?php endforeach ?>
                                </table>
                            </div>
                        </div>
                        <div class="card col-lg-3" style="padding:0px; margin-right:3%; margin-top:2%;">
                            <div class="card-header white" style="background-color:#fff; color: #86939e; font-size:13px">
                                CÓDIGO DE RASTREIO
                            </div>
                            
                            <div class="card-body" style="color: #86939e">
                                <p><b>Código: </b><?php echo $read['rastreamento']; ?></p>
                                <a style="text-decoration:none" class="btn btn-primary btn-xs" href="https://linketrack.com/track?utm_source=link&codigo=<?php echo $read['rastreamento']; ?>" target="_blank">Rastrear Pedidos</a>
                            </div>
                        </div>
                        <div class="card col-lg-3" style="padding:0px;margin-top:2%;">
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
            <div class="card-footer white" style="border-color:#fff"></div> 
        </div>
        <span id="asd"></span>
        <script>
            window.onload = function() {
                const pagamento_pendente = 'Pagamento Pendente';
                const processando = 'Processando';
                const aguardando = 'Aguardando';
                const pedido_enviado = 'Pedido Enviado';
                const concluido = 'Concluido';
                const cancelado = 'Cancelado';
                const reembolsado = 'Reembolsado';
                <?php if(empty($read['cor_status'])){ ?>
                document.getElementById('bar').innerHTML = "<p style='background-color:#e4f9d8'>Processando</p>";<?php } else{ ?>
                const a = document.getElementById('bar').innerHTML = "<p style='background-color:#<?php echo $read['cor_status']; ?>; '>" + <?php echo $read['status']; ?> + "</p>";<?php } ?>
                const produto<?php echo $pd['id_pdt']; ?> =  "<?php echo $pd['produto']; ?>";
                const out<?php echo $pd['id_pdt']; ?> = "<?php echo $capa['nome'] ?>";
                const clear<?php echo $pd['id_pdt']; ?> = produto<?php echo $pd['id_pdt']; ?>.replace("<?php echo $capa['nome'] ?>", "");
// Formato do telefone
                var BRNumber = "<?php echo $reading['telefone']; ?>".match(/(\d{2})(\d{1})(\d{4})(\d{4})/);
                BRNumber = "(" + BRNumber[1] + ") " + BRNumber[2] + " " + BRNumber[3]+ "-" + BRNumber[4];
                document.getElementById("numchange").innerHTML = BRNumber;
                                       
            };
    </script>
    </body>
<html>