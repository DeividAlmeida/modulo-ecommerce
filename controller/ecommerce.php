<?php
if(!$_SESSION['node']['id']){ die(); exit(); }

if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'])) { Redireciona('./index.php'); }

$modulo = str_replace(['/'], [''], $_SERVER['SCRIPT_NAME']);
$queryAction = DBRead("modulos","*","WHERE url = '{$modulo}'");
if (is_array($queryAction) && empty($queryAction[0]['action'])) {
    $data = array(
        'acao' => '{"listagem":["adicionar","editar","deletar"],"categoria":["adicionar","editar","deletar"],"produto":["adicionar","editar","deletar"],"codigo":["acessar"],"configuracao":["acessar"]}',
    );
    DBUpdate("modulos", $data, "url = '{$modulo}'");
}

require_once('database/upload.class.php');
require_once('ecommerce/matriz_produto/index.php');
require_once('ecommerce/categorias.php');
require_once('ecommerce/marcas.php');
require_once('ecommerce/atributos.php');
require_once('ecommerce/termos.php');
require_once('ecommerce/c_configuracao.php');
require_once('ecommerce/listagens.php');
require_once('ecommerce/produtos.php');
require_once('ecommerce/slider.php');
require_once('ecommerce/vendas.php');

$plugins = DBRead('ecommerce_plugins','*');
if(!empty($plugins)){
    foreach($plugins as $key => $plugin){
        require_once('ecommerce/'.$plugin['nome'].'.php');
    }
}
