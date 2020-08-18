<?php // Excluir Pedido
if (isset($_GET['deletarPedidos'])) {
  $id     = $_POST;
  foreach($_POST['id'] as $no => $post){
  $query  = DBDelete('ecommerce_vendas',"id = '{$post}'");
}

}