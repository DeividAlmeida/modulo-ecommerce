<?php 
if(isset($_GET['statusmotoboy'])){
    $status =$_GET['statusmotoboy'];
    if($status == "true"){
      $callback = "checked";
    }else{ $callback = ""; }
    $query  = DBUpdate('ecommerce_plugins', array('status' => $callback), "nome = 'motoboy'");
  }

  if(isset($_GET['motoboy'])){
    $resources = array_combine(array_keys($_POST['descricao']), array_map(function ($descricao, $cep_inicial, $cep_final, $peso_inicial, $peso_final, $valor) {
        return compact('descricao', 'cep_inicial', 'cep_final', 'peso_inicial', 'peso_final', 'valor');
        },$_POST['descricao'], $_POST['cep_inicial'], $_POST['cep_final'], $_POST['peso_inicial'] , $_POST['peso_final'], $_POST['valor']));
        $_POST['all'] = json_encode($resources, JSON_FORCE_OBJECT);

  $query  = DBUpdate('ecommerce_motoboy', array( 'tudo'=> $_POST['all'],), "id = '1'");
  if ($query != 0) {
    Redireciona('?configEntrega&salvo');
  } else {
    Redireciona('?configEntrega&erro&VisualizarCategoria');
  }
}