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
    'rastreamento'      => post('rastreamento'),
    'produto'           => $_POST['venda']
  );
  $query  = DBUpdate('ecommerce_vendas', $data, "id = {$id}");
}
if (isset($_GET['statusPedido'])) {
  $id     = get('statusPedido');
  $status = get('status');
  $data = array(
    'status'   => $status,
  );
  $query  = DBUpdate('ecommerce_vendas', $data, "id = {$id}");
  $read = DBRead('ecommerce_vendas','*',"WHERE id = '{$id}'")[0];
  $readm = DBRead('ecommerce_config_email','*',"WHERE id = '1'")[0];

  if ($query != 0) {
$remetente = $readm['remetente'];
$destinatario = $read['email'];
$nome = $readm['nome'];
$message = $readm[$status];
$assunto = $nome." : Pedido #".$id." ".$readm["t_".$status];
$headers = "MIME-Version: 1.1" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: '.$nome.'<'.$remetente.'>'. "\r\n";
$headers .= "Return-Path: $remetente\n"; 
$headers .= "Reply-To: $remetente\n"; 
$envio = mail($destinatario, $assunto,  $message, $headers, "-f$remetente");

}
}