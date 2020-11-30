<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
$desconto = 0.00;
$id = $_GET['id'];
$cupons  = DBRead('ecommerce_cupom','*',"WHERE codigo = '{$id}'")[0];
$produto = json_decode($cupons['produtos'],true);
$ex_produto = json_decode($cupons['ex_produtos'],true);
$categoria_compra = json_decode($cupons['categorias'],true);
$ex_categoria_compra = json_decode($cupons['categorias'],true);
$qtd = $_POST['quantidade'];
$quantidade = 0;
unset($_POST['quantidade']);
    foreach($_POST as $key => $value){
        $compra  = DBRead('ecommerce','*',"WHERE id = '{$key}'")[0];
        $categoria = DBRead('ecommerce_prod_categorias','*',"WHERE id_produto = '{$key}'")[0];
        $categoria_nome = DBRead('ecommerce_categorias','*',"WHERE id = '{$categoria['id_categoria']}'")[0];
        
        if(empty($produto) && !empty($ex_produto)){
            foreach($ex_produto as $fora){
                if($compra['nome'] != $fora['id']){
                    $desconto = $cupons['valor'];
                    $quantidade += $value;
                }
            }
        }
        else if(!empty($produto)){
            foreach($produto as $dentro){
                if($compra['nome'] == $dentro['id']){
                    $desconto = $cupons['valor']; 
                    $quantidade += $value;
                }    
            }
        }
        else if(empty($categoria_compra) && !empty($ex_categoria_compra)){
            foreach($ex_categoria_compra as $ca_fora){
                if($compra['nome'] != $ca_fora['id']){
                    $desconto = $cupons['valor'];
                    $quantidade += $value;
                }
            }
        }
        else if(!empty($categoria_compra)){
            foreach($categoria_compra as $cc){ 
                if($categoria_nome['nome'] == $cc['id']){
                    $desconto = $cupons['valor'];
                    $quantidade += $value;
                }
            }
        }
    }
    $resposta = array(
        "desconto" => $quantidade * $desconto,
        "acumular" => $cupons['uso']
    );
echo json_encode($resposta);    