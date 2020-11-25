<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
$id = $_GET['id'];
$cupons  = DBRead('ecommerce_cupom','*',"WHERE codigo = '{$id}'")[0];
$produto = json_decode($cupons['produtos'],true);
$categoria_compra = json_decode($cupons['categorias'],true);
    foreach($_POST as $key => $value){
        $compra  = DBRead('ecommerce','*',"WHERE id = '{$value}'")[0];
        $categoria = DBRead('ecommerce_prod_categorias','*',"WHERE id_produto = '{$value}'")[0];
        $categoria_nome = DBRead('ecommerce_categorias','*',"WHERE id = '{$categoria['id_categoria']}'")[0];
        
        foreach($produto as $dentro){
            if($compra['nome'] == $dentro['id']){
               
               $desconto = $cupons['valor']; 
            } 
            else 
                foreach($categoria_compra as $cc){ 
                    if($categoria_nome['nome'] == $cc['id']){
                        
                        $desconto = $cupons['valor'];
                    }
                    
                }
        
        }
        
    }

echo $desconto;