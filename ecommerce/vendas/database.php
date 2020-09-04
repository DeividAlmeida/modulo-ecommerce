<?php 
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
$query = DBRead('ecommerce_vendas', '*');
$last = end($query);
$bay = json_decode($last['produto'], true);
array_pop($query);
?>

[
    <?php foreach($query as $vhs => $mima):
    
    $id = $mima['id'];    
    $pdts = json_decode($mima['produto'], true);
    $data = new DateTime();
    $data->format('d/m/Y H:i:s');
    $data = new DateTime($mima['data']);
    foreach($pdts as $key => $pdt) {$pdt['un_valor'] += number_format(floatval(str_replace(",", ".", $pdt['un_valor'])) * floatval(str_replace(",", ".", $pdt['qtd'])), 2, ".", ",");  };
    ?>    
    {
        "id": <?php echo $id; ?>,
         "<div class='container-fluid'><div class='row'><div class='col-md-4'><span class='d-none'>":"</spna>",                        
        "Comprador": "<?php echo $mima['nome'];?>",
        "<?php if($mima['tipo_pessoa'] == 2){echo "CNPJ";}else{echo "CPF";} echo'":'.'"'.$mima['id_pessoa'].'",'; ?>
        "Telefone": " <?php echo $mima['telefone'];?>",
        "Email": " <?php echo $mima['email']."</div> <div class='col-md-4'>"; ?>",
        "Data do Pedido": " <?php echo $data->format('d/m/Y H:i:s');?>",
        "Forma de Pagamento": " <?php echo $mima['tipo_pagamento'];?>",
        "Valor da venda": "<?php echo "R$ ".number_format($mima['valor'], 2, ",", ".");?>",
        "Valor liquido da venda": "<?php echo "R$ ".number_format($pdt['un_valor'], 2, ",", ".");?>",
        "Produto(s)": "<span><?php foreach($pdts as $pd) { echo "<br>". $pd['produto']."Quantidade: ".$pd['qtd']."<br>";   } echo "</span></div> <div class='col-md-4'>"; ?>",
        "Tipo de Entrega": "<?php echo $mima['tipo_entrega'];?>",
        "Código de Rastreamento": "<?php echo $mima['rastreamento'];?>",
        "Valor do frete": " <?php if($mima['tipo_entrega'] == "Retirada na Loja") { echo "R$ 0,00"; }else{ echo  "R$ ".number_format(abs(floatval(str_replace(",", ".", $mima['valor'])) - floatval(str_replace(",", ".", $pdt['un_valor']))), 2, ",", ".");  } ?>",
        "Estado": "<?php echo $mima['estado'];?>",
        "Cidade": "<?php echo $mima['cidade'];?>",
        "Bairro": "<?php echo $mima['bairro'];?>",
        "Cep": "<?php echo $mima['cep'];?>",       
        "Rua": "<?php echo $mima['rua'];?>",
        "Número": "<?php echo $mima['numero'];?>",
        "Complemento": "<?php echo $mima['complemento']."</div></div></div>";?>",
        "Observação": "<hr> <?php echo $mima['nota'];?>",
        "<span class='d-none'>":"<span class='d-none'>",
        "Status do Pedido": "<select name='tipo_pessoa' onchange='status(<?php echo $id ?>)' id='status<?php echo $id ?>' class='form-control custom-select'><option  disabled selected>Altere o status do pedido</option><option style='background-color:#faf7d8' value='pagamento_pendente' <?php Selected($mima['status'], 'pagamento_pendente'); ?>>Pagamento Pendente</option><option style='background-color:#e4f9d8' value='processando' <?php Selected($mima['status'], 'processando'); ?>>Processando</option><option style='background-color:#caf9f4' value='aguardando' <?php Selected($mima['status'], 'aguardando'); ?>>Aguardando</option><option style='background-color:#d5e3fa' value='pedido_enviado' <?php Selected($mima['status'], 'pedido_enviado'); ?>>Pedido Enviado</option><option style='background-color:#b4bff8' value='concluido' <?php Selected($mima['status'], 'concluido'); ?>>Concluido</option><option style='background-color:#ffb7b7' value='cancelado' <?php Selected($mima['status'], 'cancelado'); ?>>Cancelado</option><option style='background-color:#ffcfb6' value='reembolsado' <?php Selected($mima['status'], 'reembolsado'); ?>>Reembolsado</option></select>",
        "<i class='fa fa-pencil'></i>":"<center><a style='cursor:pointer' data-target='#Modal' data-toggle='modal' onclick='showDetails(<?php echo $id; ?>)'><i class='text-center text-primary icon icon-pencil' aria-hidden='true'></i></a></center>",
        "state":""         
    },<?php endforeach ?>
  
    {

        "id": <?php print_r($last['id']); ?>,
        "<div class='container-fluid'><div class='row'><div class='col-md-4'><span class='d-none'>":"",                   
        "Comprador": "<?php echo $last['nome'];?>",
        "<?php if($last['tipo_pessoa'] == 2){echo "CNPJ";}else{echo "CPF";} print_r('":'.'"'.$last['id_pessoa'].'",'); ?>
        "Telefone": "<?php print_r( $last['telefone']);?>",
        "Email": "<?php print_r($last['email']."</div> <div class='col-md-4'>"); ?>",
        "Data do Pedido": " <?php echo $data->format('d/m/Y H:i:s');?>",
        "Forma de Pagamento": "<?php print_r( $last['tipo_pagamento']);?>",
        "Valor da venda": "<?php print_r("R$ ".number_format($last['valor'], 2, ",", "."));?>",
        "Valor liquido da venda": "<?php print_r("R$ ".number_format($pdt['un_valor'], 2, ",", "."));?>",
        "Produto(s)": "<span><?php foreach($bay as $by) { echo "<br>". $by['produto']."Quantidade: ".$by['qtd']."<br>";   } echo "</span></div> <div class='col-md-4'>"; ?>",
        "Tipo de Entrega": "<?php print_r($last['tipo_entrega']);?>",
        "Código de Rastreamento": "<?php print_r($last['rastreamento']);?>",
        "Valor do frete": "<?php if($last['tipo_entrega'] == "Retirada na Loja") { echo "R$ 0,00"; }else{ echo  "R$ ".number_format(abs(floatval(str_replace(",", ".", $last['valor'])) - floatval(str_replace(",", ".", $pdt['un_valor']))), 2, ",", ".");  } ?>",
        "Estado": "<?php print_r($last['estado']);?>",
        "Cidade": "<?php print_r($last['cidade']);?>",
        "Bairro": "<?php print_r($last['bairro']);?>",
        "Cep": "<?php print_r($last['cep']);?>",       
        "Rua": "<?php print_r($last['rua']);?>",
        "Número": "<?php print_r($last['numero']);?>",
        "Complemento": "<?php print_r($last['complemento']."</div></div></div>");?> ",        
        "Observação": "<hr> <?php print_r($last['nota']);?>",
        "<span class='d-none'>":"<span class='d-none'>",
        "Status do Pedido": "<select name='tipo_pessoa' onchange='status(<?php print_r($last['id']); ?>)' id='status<?php print_r($last['id']); ?>' class='form-control custom-select'><option  disabled selected>Altere o status do pedido</option><option style='background-color:#faf7d8' value='pagamento_pendente' <?php Selected($last['status'], 'pagamento_pendente'); ?>>Pagamento Pendente</option><option style='background-color:#e4f9d8' value='processando' <?php Selected($last['status'], 'processando'); ?>>Processando</option><option style='background-color:#caf9f4' value='aguardando' <?php Selected($last['status'], 'aguardando'); ?>>Aguardando</option><option style='background-color:#d5e3fa' value='pedido_enviado' <?php Selected($last['status'], 'pedido_enviado'); ?>>Pedido Enviado</option><option style='background-color:#b4bff8' value='concluido' <?php Selected($last['status'], 'concluido'); ?>>Concluido</option><option style='background-color:#ffb7b7' value='cancelado' <?php Selected($last['status'], 'cancelado'); ?>>Cancelado</option><option style='background-color:#ffcfb6' value='reembolsado' <?php Selected($last['status'], 'reembolsado'); ?>>Reembolsado</option></select>",
        "<i class='fa fa-pencil'></i>":"<center><a style='cursor:pointer' data-target='#Modal' data-toggle='modal' onclick='showDetails(<?php print_r($last['id']); ?>)'><i class='text-center text-primary icon icon-pencil' aria-hidden='true'></i></a></center>",
        "state":"" 
        
    
    }
]
