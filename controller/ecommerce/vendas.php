<?php // Excluir Pedido
if (isset($_GET['deletarPedidos'])) {
  $id     = $_POST;
  foreach($_POST['id'] as $no => $post){
  $query  = DBDelete('ecommerce_vendas',"id = '{$post}'");
}
}
if (isset($_GET['editarPedido'])) {
  $id     = post('id');
  $resources = array_combine(array_keys($_POST['produto']), array_map(function ($qtd, $produto, $un_valor) {
  return compact('qtd', 'produto', 'un_valor');
  },$_POST['qtd'], $_POST['produto'], $_POST['un_valor']));
  $_POST['venda'] = json_encode($resources, JSON_FORCE_OBJECT);

  $data = array(
    'nome'              => post('nome'),
    'tipo_pessoa'       => post('tipo_pessoa'),
    'id_pessoa'          => post('id_pessoa'),
    'telefone'          => post('telefone'),
    'email'             => post('email'),
    'nota'              => post('nota'),
    'tipo_entrega'      => post('tipo_entrega'),
    'estado'            => post('estado'),
    'cidade'            => post('cidade'),
    'bairro'            => post('bairro'),
    'cep'               => post('cep'),
    'rua'               => post('rua'),
    'numero'            => post('numero'),
    'complemento'       => post('complemento'),
    'valor'             => post('valor'),
    'produto'           =>$_POST['venda']
  );
  $query  = DBUpdate('ecommerce_vendas', $data, "id = {$id}");
}