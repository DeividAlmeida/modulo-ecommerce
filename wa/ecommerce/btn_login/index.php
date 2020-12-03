<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=utf-8');
require_once(dirname(__FILE__).'/../../../includes/funcoes.php');
require_once(dirname(__FILE__).'/../../../database/config.database.php');
require_once(dirname(__FILE__).'/../../../database/config.php');


$query = DBRead('ecommerce_config','*');

$config = [];
foreach ($query as $key => $row) {
  $config[$row['id']] = $row['valor'];
}
?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="fa fa-user fa-fw"></i> User</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
    <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
  </a>
  <ul class="dropdown-menu">
    <li><a href="#"><i class="fa fa-gift" aria-hidden="true"></i> Pedidos</a></li>
    <li><a href="#"><i class="fa fa-cog"></i> Alterar Perfil</a></li>
    <li><a href="#"><i class="fa fa-phone"></i> Fale Conosco</a></li>
    <li class="divider"></li>
    <li><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Sair</a></li>
  </ul>
</div>