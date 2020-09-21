<?php // Excluir Pedido
if (isset($_GET['deletarPedidos'])) {
  $id     = $_POST;
  foreach($_POST['id'] as $no => $post){
  $query  = DBDelete('ecommerce_vendas',"id = '{$post}'");
}
}
if (isset($_GET['editarPedido'])) {
  $id     = post('id');
  $resources = array_combine(array_keys($_POST['produto']), array_map(function ($qtd, $produto, $un_valor, $id_pdt) {
  return compact('qtd', 'produto', 'un_valor', 'id_pdt');
  },$_POST['qtd'], $_POST['produto'], $_POST['un_valor'], $_POST['id_pdt']));
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
  $cor = get('cor');
  $data = array(
    'status'   => $status,
    'cor_status'   => $cor
  );
  $query  = DBUpdate('ecommerce_vendas', $data, "id = {$id}");
  $read = DBRead('ecommerce_vendas','*',"WHERE id = '{$id}'")[0];
  $readm = DBRead('ecommerce_config_email','*',"WHERE id = '1'")[0];
  $link = "<p> Você poderá acompanhar o status do seu pedido no seguinte link ".ConfigPainel('base_url')."wa/ecommerce/status_pedido/index.php?Z=".base64_encode($id)."</p>";
 
  if ($query != 0) {




// Inclui o arquivo class.phpmailer.php localizado na mesma pasta do arquivo php 
include "PHPMailer-master/PHPMailerAutoload.php";
include "PHPMailer-master/class.phpmailer.php"; 
 
// Inicia a classe PHPMailer 
$mail = new PHPMailer(); 
 
// Método de envio 
$mail->IsSMTP(); 
 
// Enviar por SMTP 
$mail->Host = $readm['email_servidor'] ; 
 
// Você pode alterar este parametro para o endereço de SMTP do seu provedor 
$mail->Port = $readm['email_porta']; 
 
 
// Usar autenticação SMTP (obrigatório) 
$mail->SMTPAuth = true; 
 
// Usuário do servidor SMTP (endereço de email) 
// obs: Use a mesma senha da sua conta de email 
$mail->Username = $readm['email_usuario']; 
$mail->Password = $readm['email_senha'] ; 
 
// Configurações de compatibilidade para autenticação em TLS 
$mail->SMTPOptions = array( $readm['email_protocolo_seguranca'] => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) ); 
 
// Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro. 
 $mail->SMTPDebug = 2; 
 
// Define o remetente 
// Seu e-mail 
$mail->From = $readm['remetente']; 
 
// Seu nome 
$mail->FromName = $readm['nome']; 
 
// Define o(s) destinatário(s) 
$mail->AddAddress($read['email'], $read['nome']); 
 
// Opcional: mais de um destinatário
// $mail->AddAddress('fernando@email.com'); 
 
// Opcionais: CC e BCC
// $mail->AddCC('joana@provedor.com', 'Joana'); 
// $mail->AddBCC('roberto@gmail.com', 'Roberto'); 
 
// Definir se o e-mail é em formato HTML ou texto plano 
// Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
$mail->IsHTML(true); 
 
// Charset (opcional) 
$mail->CharSet = 'UTF-8'; 
 
// Assunto da mensagem 
$mail->Subject = $readm['nome']." : Pedido #".$id." ".$readm["t_".$status]; 
 
// Corpo do email 
$mail->Body = $readm[$status].$link; 
 
// Opcional: Anexos 
// $mail->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf"); 
 
// Envia o e-mail 
$enviado = $mail->Send(); 


 

}
}