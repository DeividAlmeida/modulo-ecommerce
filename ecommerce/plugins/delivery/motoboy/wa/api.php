<?php 
header('Access-Control-Allow-Origin: *');
require_once('../../../../../includes/funcoes.php');
require_once('../../../../../database/config.database.php');
require_once('../../../../../database/config.php');
$reading =  DBRead('ecommerce_motoboy','*', "WHERE id = '1'")[0];
echo '{';
$json = json_decode($reading['tudo'], true); if(is_array($json)){ foreach($json as $key => $value){

    for ($n=$value['cep_inicial']*1; $n<= $value['cep_final']; $n++) {
     echo 
     '"id_'.$n.'": { "descricao":"'.$value['descricao'].'","min":"'.$value['peso_inicial'].'","max":"'.$value['peso_final'].'","valor":"'.$value['valor'].'"},'
     ;
    }





}}
echo '"fim":"N/A"}';