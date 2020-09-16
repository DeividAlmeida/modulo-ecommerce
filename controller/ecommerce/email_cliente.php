<?php
 $readm = DBRead('ecommerce_config_email','*',"WHERE id = '1'")[0];
 $retirada = DBRead('ecommerce_config_entrega','*',"WHERE id = '1'")[0]; 
$deposito = DBRead('ecommerce_config_deposito','*',"WHERE id = '1'")[0]; 
// Inclui o arquivo class.phpmailer.php localizado na mesma pasta do arquivo php 
$mailr = new PHPMailer(); 
 
// Método de envio 
$mailr->IsSMTP(); 
 
// Enviar por SMTP 
$mailr->Host = $readm['email_servidor'] ; 
 
// Você pode alterar este parametro para o endereço de SMTP do seu provedor 
$mailr->Port = $readm['email_porta']; 
 
 
// Usar autenticação SMTP (obrigatório) 
$mailr->SMTPAuth = true; 
 
// Usuário do servidor SMTP (endereço de email) 
// obs: Use a mesma senha da sua conta de email 
$mailr->Username = $readm['email_usuario']; 
$mailr->Password = $readm['email_senha'] ; 
 
// Configurações de compatibilidade para autenticação em TLS 
$mailr->SMTPOptions = array( $readm['email_protocolo_seguranca'] => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) ); 
 
// Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro. 
//$mailr->SMTPDebug = 2; 
 
// Define o remetente 
// Seu e-mail 
$mailr->From = $readm['remetente']; 
 
// Seu nome 
$mailr->FromName = $readm['nome']; 
 
// Define o(s) destinatário(s) 
$mailr->AddAddress(post('billing_email'), $nome); 
 
// Opcional: mais de um destinatário
// $mailr->AddAddress('fernando@email.com'); 
 
// Opcionais: CC e BCC
// $mailr->AddCC('joana@provedor.com', 'Joana'); 
// $mailr->AddBCC('roberto@gmail.com', 'Roberto'); 
 
// Definir se o e-mail é em formato HTML ou texto plano 
// Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
$mailr->IsHTML(true); 
 
// Charset (opcional) 
$mailr->CharSet = 'UTF-8'; 
 
// Assunto da mensagem 
$mailr->Subject = "Recebemos o seu pedido #".$query; 
 $apre = "Olá ". $nome.", vimos que você fez um novo pedido. Seu pedido está sendo processado e você receberá um email acada mudança de status do seu pedido. Segue abaixo informações úteis.<br>";
$dtls = json_decode($deposito['detalhes'], true); foreach( $dtls as $key => $dtl): $enviar .= 
"<p>". $dtl['banco'] ."</p> 
<table style='width:40%, border: 1px solid black'>
  <tr style='border: 1px solid black'>
    <th style='border: 1px solid black'>Nome da Conta</th>
    <th style='border: 1px solid black'>Conta:</th>
    <th style='border: 1px solid black'>Agéncia</th>
  </tr>
  <tr>
    <td style='border: 1px solid black'>".$dtl['nome']."</td>
    <td style='border: 1px solid black'>".$dtl['conta']."</td>
    <td style='border: 1px solid black'>".$dtl['agencia']."</td>
  </tr>
</table>"; 
 endforeach ;
// Opcional: Anexo?s 
// $mailr->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf"); 
 
// Envia o e-mail
// Corpo do email 

$instru = "<footer><p>" .$deposito['instucoes']. "</p></footer>";

$endr = "
    <p>Você encontrará nossa loja no seguinte endereço:<br>
    Estado: ". $retirada['estado']."<br>
    Cidade: ". $retirada['cidade']."<br>
    Bairro: ". $retirada['bairro']."<br>
    Rua: ". $retirada['rua']."<br>
    Número: ". $retirada['numero']."<br>
    CEP: ". $retirada['cep']."<br>
    Telefone: ". $retirada['telefone']."</p><br>";
    
$link = "<p> Para pedidos com retirada em nossa loja favor retirar no endereço abaixo: ".ConfigPainel('base_url')."wa/ecommerce/status_pedido/index.php?Z=".base64_encode($query)."</p>";
    
$mailr->Body = $apre.$endr.$link;

$enviado = $mailr->Send(); 
