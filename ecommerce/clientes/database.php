<?php 
error_reporting(0);
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
$data = DBRead('ecommerce_usuario', '*', 'ORDER BY id DESC');
echo json_encode($data);