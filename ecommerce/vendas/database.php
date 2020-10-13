<?php 
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
$query = DBRead('ecommerce_vendas', '*', 'ORDER BY id DESC');
if(!empty($query)){$last = end($query);};
$bay = json_decode($last['produto'], true);
if(!empty($bay)){foreach($bay as $keyl => $pdtl){$pdtl['un_valor'] += number_format(floatval(str_replace(",", ".", $pdtl['un_valor'])) * floatval(str_replace(",", ".", $pdtl['qtd'])), 2, ".", ",");  }};

$datal = new DateTime();
$datal->format('d/m/Y H:i:s');
$datal = new DateTime($last['data']);
if(!empty($query)){ array_pop($query); };
?>
[
    <?php if(!empty($query)){ foreach($query as $vhs => $mima):
    
    $id = $mima['id'];   
    $pdts = json_decode($mima['produto'], true);
    $data = new DateTime();
    $data->format('d/m/Y H:i:s');
    $data = new DateTime($mima['data']);

    if(is_array($pdts)){foreach($pdts as $key => $pdt) {$pdt['un_valor'] += number_format(floatval(str_replace(",", ".", $pdt['un_valor'])) * floatval(str_replace(",", ".", $pdt['qtd'])), 2, ".", ",");  }};
     ?>    
    {
         "<div class='container-fluid'><div class='row'><div class='col-3 card white' style='display: inline; margin-right:15px; flex: 2; font-size: 12px;'><span class='d-none'>":"",                        
         "<div class='card-header white' style='padding:0px'> DADOS DO CLIENTE</div><span class='d-none'>": "</span>",
        "Comprador": "<?php echo $mima['nome'];?>",
        <?php if($mima['id_pessoa'] == 'N/A'){}else{?> "<?php if($mima['tipo_pessoa'] == 2){echo "CNPJ";}else{echo "CPF";} echo'":'.'"'.$mima['id_pessoa'].'",'; }?>
        "Telefone": " <?php echo $mima['telefone'];?>",
        "Email": " <?php echo $mima['email']."</div> <div class='col-3 card  white' style='display: inline; margin-right:15px; flex: 2;font-size: 12px;padding: 0 5px 0 5px '>"; ?>",
        "<div class='card-header white' style='padding:0px'> DADOS DO PEDIDO ID": "<?php echo $id; ?></div>",
        "Data do Pedido": " <?php echo $data->format('d/m/Y H:i:s');?>",
        "Forma de Pagamento": " <?php echo $mima['tipo_pagamento'];?>",
        "Valor da venda": "<?php echo "R$ ".number_format($mima['valor'], 2, ",", ".");?><div class='d-none'>",
        "":"</div><span class='btn-primary btn-xs' style='padding: 0;font-size: 13px;  display: inline;'>",
        "Valor liquido da venda": "<?php $alberto = $mima['valor']-$mima['vl_frete'];  echo "R$ ".number_format($alberto, 2, ",", ".");?></span>",
        "Produto(s)": "<span><?php if(is_array($pdts)){foreach($pdts as $pd) { $vhs = $pd['id_pdt']; $fotos   = DBRead('ecommerce_prod_imagens','*', "WHERE id_produto = {$vhs}"); $capa   = DBRead('ecommerce','*', "WHERE id = {$vhs}")[0]; if(is_array($fotos)){foreach($fotos as $foto){if($foto['id'] == $capa['id_imagem_capa']){ $foto_capa = $foto;}}} echo "<br><table ><tr style='font-size:9px;padding:0px;letter-spacing: 0px;'><td style='padding:0px;background-color:#fff;border-color: #fff;'><img src=". RemoveHttpS(ConfigPainel('base_url'))."wa/ecommerce/uploads/".$foto['uniq'] ." height='50'/></td><td style='padding:0px;background-color:#fff;border-color: #fff;'>". $pd['produto']."Quantidade: ".$pd['qtd']."</td><td style='background-color:#fff;border-color: #fff;'>R$ ".number_format($pd['un_valor'], 2, ",", ".")."</td></tr></table><hr>";   }} ?>",
        "</span></div> <div class='col-3 card  white' style='display: inline; margin-right:15px; flex: 2;font-size: 12px;'><br><div class='card-header white' style='padding:0px'> DADOS DA ENTREGA</div><span class='d-none'>": "</span>",
        "Tipo de Entrega": "<?php echo $mima['tipo_entrega'];?>",
        "Código de Rastreamento": "<?php echo $mima['rastreamento'];?>",
        "Valor do frete": " <?php  echo "R$ ".number_format($mima['vl_frete'], 2, ",", "."); ?>",
        <?php if($mima['id_pessoa'] == 'N/A'){}else{ ?>"Estado": "<?php echo $mima['estado']; ?>", <?php }?>
        "Cidade": "<?php echo $mima['cidade'];?>",
        <?php if($mima['id_pessoa'] == 'N/A'){}else{ ?>"Bairro": "<?php echo $mima['bairro'];?>", <?php }?>
        "Código Postal": "<?php echo $mima['cep'];?>",       
        "Rua": "<?php echo $mima['rua'];?>",
        "Número": "<?php echo $mima['numero'];?>",
        "Complemento": "<?php echo $mima['complemento']. "</div> <div class='col-3 card  white' style='display: inline;  flex: 2;'>"; ?> ",  
        "<div class='card-header white' style='padding:0px'>OBSERVAÇÃO</div><span class='d-none'>": "</span><?php echo $mima['nota']."</div></div></div>"; ?>",
        "<span class='d-none'>":"<span class='d-none'>",
        "id": "<?php echo $id; ?>",
        "Status do Pedido": "<select style='background-color:#<?php echo $mima['cor_status']; ?>'  name='tipo_pessoa' onchange='status(<?php echo $id ?>)' id='status<?php echo $id ?>' class='form-control custom-select'><option  disabled selected>Altere o status do pedido</option><option style='background-color:#faf7d8' cor='faf7d8' value='pagamento_pendente' <?php Selected($mima['status'], 'pagamento_pendente'); ?>>Pagamento Pendente</option><option cor='e4f9d8' style='background-color:#e4f9d8' value='processando' <?php Selected($mima['status'], 'processando'); ?>>Processando</option><option  cor='caf9f4' style='background-color:#caf9f4' value='aguardando' <?php Selected($mima['status'], 'aguardando'); ?>>Aguardando</option><option cor='d5e3fa' style='background-color:#d5e3fa' value='pedido_enviado' <?php Selected($mima['status'], 'pedido_enviado'); ?>>Pedido Enviado</option><option cor='b4bff8' vstyle='background-color:#b4bff8' value='concluido' <?php Selected($mima['status'], 'concluido'); ?>>Concluido</option><option cor='ffb7b7' style='background-color:#ffb7b7' value='cancelado' <?php Selected($mima['status'], 'cancelado'); ?>>Cancelado</option><option cor='ffcfb6' style='background-color:#ffcfb6' value='reembolsado' <?php Selected($mima['status'], 'reembolsado'); ?>>Reembolsado</option></select>",
        "<i class='fa fa-pencil'></i>":"<center><a style='cursor:pointer' data-target='#Modal' data-toggle='modal' onclick='showDetails(<?php echo $id; ?>)'><i class='text-center text-primary icon icon-pencil' aria-hidden='true'></i></a></center>",
        "state":""         
    },<?php endforeach; } if(!empty($last)){ ?>
  
    {

        "<div class='container-fluid'><div class='row'><div class='col-3 card white' style='display: inline; margin-right:15px; flex: 2; font-size: 12px;'><span class='d-none'>":"",                   
        "<div class='card-header white' style='padding:0px'> DADOS DO CLIENTE</div><span class='d-none'>": "</span>",
        "Comprador": "<?php echo $last['nome'];?>",
        <?php if($last['id_pessoa'] == 'N/A'){}else{?> "<?php if($last['tipo_pessoa'] == 2){echo "CNPJ";}else{echo "CPF";} print_r('":'.'"'.$last['id_pessoa'].'",'); } ?>
        "Telefone": "<?php print_r( $last['telefone']);?>",
        "Email": "<?php print_r($last['email']."</div> <div class='col-3 card  white' style='display: inline; margin-right:15px; flex: 2;font-size: 12px; padding: 0 5px 0 5px'>"); ?>",
        "<div class='card-header white' style='padding:0px'> DADOS DO PEDIDO ID": "<?php print_r($last['id']);?></div>",
        "Data do Pedido": " <?php print_r($datal->format('d/m/Y H:i:s'));?>",
        "Forma de Pagamento": "<?php print_r( $last['tipo_pagamento']);?>",
        "Valor da venda": "<?php print_r("R$ ".number_format($last['valor'], 2, ",", "."));?> <div class='d-none'>",
        "":"</div><span class='btn-primary btn-xs' style='padding: 0;font-size: 13px;  display: inline;'>",
        "Valor liquido da venda": "<?php $albertol = $last['valor']- $last['vl_frete'];  echo "R$ ".number_format($albertol, 2, ",", ".");?></span>",
        "Produto(s)": "<span><?php if(!empty($bay)){ foreach($bay as $by) {$vh = $by['id_pdt']; $imgs   = DBRead('ecommerce_prod_imagens','*', "WHERE id_produto = {$vh}"); $cap   = DBRead('ecommerce','*', "WHERE id = {$vh}")[0]; if(is_array($imgs)){foreach($imgs as $img){if($img['id'] == $cap['id_imagem_capa']){ $foto_capa = $img;}}} echo "<br><table ><tr style='font-size:9px;padding:0px;letter-spacing: 0px;'><td style='padding:0px;background-color:#fff;border-color: #fff;'><img src=". RemoveHttpS(ConfigPainel('base_url'))."wa/ecommerce/uploads/".$img['uniq'] ." height='50'/></td><td style='padding:0px;background-color:#fff;border-color: #fff;'>". $by['produto']."Quantidade: ".$by['qtd']."</td><td style='background-color:#fff;border-color: #fff;'>R$ ".number_format($by['un_valor'], 2, ",", ".")."</td></tr></table><hr>";}} ?>",        
        "</span></div> <div class='col-3 card  white' style='display: inline; margin-right:15px; flex: 2;font-size: 12px;'><br><div class='card-header white' style='padding:0px'> DADOS DA ENTREGA</div><span class='d-none'>": "</span>",
        "Tipo de Entrega": "<?php print_r($last['tipo_entrega']);?>",
        "Código de Rastreamento": "<?php print_r($last['rastreamento']);?>",
        "Valor do frete": "<?php print_r("R$ ".number_format($last['vl_frete'], 2, ",", ".")); ?>",
        <?php if($last['id_pessoa'] == 'N/A'){}else{?>"Estado": "<?php print_r($last['estado']);?>", <?php }?>
        "Cidade": "<?php print_r($last['cidade']);?>",
        <?php if($last['id_pessoa'] == 'N/A'){}else{?>"Bairro": "<?php print_r($last['bairro']);?>", <?php }?>
        "Código Postal": "<?php print_r($last['cep']);?>",       
        "Rua": "<?php print_r($last['rua']);?>",
        "Número": "<?php print_r($last['numero']);?>",
        "Complemento": "<?php print_r($last['complemento']. "</div> <div class='col-3 card  white' style='display: inline;  flex: 2;'>");?> ",        
        "<div class='card-header white' style='padding:0px'>OBSERVAÇÃO</div><span class='d-none'>": "</span><?php print_r($last['nota']."</div></div></div>")?>;",
        "<span class='d-none'>":"<span class='d-none'>",
        "id": "<?php print_r($last['id']);?>",
        "Status do Pedido": "<select style='background-color:#<?php print_r($last['cor_status']); ?>' name='tipo_pessoa' onchange='status(<?php print_r($last['id']); ?>)' id='status<?php print_r($last['id']); ?>' class='form-control custom-select'><option  disabled selected>Altere o status do pedido</option><option cor='faf7d8' style='background-color:#faf7d8' value='pagamento_pendente' <?php Selected($last['status'], 'pagamento_pendente'); ?>>Pagamento Pendente</option><option  cor='e4f9d8' style='background-color:#e4f9d8' value='processando' <?php Selected($last['status'], 'processando'); ?>>Processando</option><option cor='caf9f4' style='background-color:#caf9f4' value='aguardando' <?php Selected($last['status'], 'aguardando'); ?>>Aguardando</option><option cor='d5e3fa' style='background-color:#d5e3fa' value='pedido_enviado' <?php Selected($last['status'], 'pedido_enviado'); ?>>Pedido Enviado</option><option cor='b4bff8' style='background-color:#b4bff8' value='concluido' <?php Selected($last['status'], 'concluido'); ?>>Concluido</option><option cor='ffb7b7' style='background-color:#ffb7b7' value='cancelado' <?php Selected($last['status'], 'cancelado'); ?>>Cancelado</option><option cor='ffcfb6' style='background-color:#ffcfb6' value='reembolsado' <?php Selected($last['status'], 'reembolsado'); ?>>Reembolsado</option></select>",
        "<i class='fa fa-pencil'></i>":"<center><a style='cursor:pointer' data-target='#Modal' data-toggle='modal' onclick='showDetails(<?php print_r($last['id']); ?>)'><i class='text-center text-primary icon icon-pencil' aria-hidden='true'></i></a></center>",
        "state":"" 

    }
    <?php } ?>
]
