<?php 
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
$query = DBRead('ecommerce_vendas', '*');?>

[
    <?php foreach($query as $vhs => $mima):
    $id = $mima['id'];    
    $pdts = json_decode($mima['produto'], true);
    foreach($pdts as $pdt) {$pdt['un_valor'] += number_format(floatval(str_replace(",", ".", $pdt['un_valor'])) * floatval(str_replace(",", ".", $pdt['qtd'])), 2, ".", ",");  };
    ?>    
    {
        "Id da venda": "<?php echo $id;?> <div class='container-fluid'><div class='row'><div class='col-md-4'>",        
        "Comprador": "<?php echo $mima['nome'];?>",
        "<?php if($mima['tipo_pessoa'] == 1){echo "CNPJ";}else{echo "CPF";} echo'":'.'"'.$mima['id_pessoa'].'",'; ?>
        "Telefone": " <?php echo $mima['telefone'];?>",
        "Email": " <?php echo $mima['email']."</div> <div class='col-md-4'>"; ?>",
        "Valor da venda": "<?php echo "R$ ".number_format($mima['valor'], 2, ",", ".");?>",
        "Valor liquido da venda": "<?php echo "R$ ".number_format($pdt['un_valor'], 2, ",", ".");?>",
        "Produto": "<span><?php foreach($pdts as $pd) { echo "<br>". $pd['produto'];   } echo "</span></div> <div class='col-md-4'>"; ?>",
        "Tipo de Entrega": " <?php echo $mima['tipo_entrega'];?>",
        "Valor do frete": " <?php echo  "R$ ".number_format(floatval(str_replace(",", ".", $mima['valor'])) - floatval(str_replace(",", ".", $pdt['un_valor'])), 2, ",", ".");  ?>",
        "Estado": " <?php echo $mima['estado'];?>",
        "Cidade": " <?php echo $mima['cidade'];?>",
        "Bairro": " <?php echo $mima['bairro'];?>",
        "Cep": " <?php echo $mima['cep'];?>",       
        "Rua": " <?php echo $mima['rua'];?>",
        "Número": " <?php echo $mima['numero'];?>",
        "Complemento": " <?php echo $mima['complemento']."</div></div></div>";?>"

        
    },<?php endforeach ?>
  
    {}
]