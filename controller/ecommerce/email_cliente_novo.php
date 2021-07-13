<?php
 $readm = DBRead('ecommerce_config_email','*',"WHERE id = '1'")[0];
 $retirada = DBRead('ecommerce_config_entrega','*',"WHERE id = '1'")[0]; 
$deposito = DBRead('ecommerce_config_deposito','*',"WHERE id = '1'")[0]; 
// Inclui o arquivo class.phpmailer.php localizado na mesma pasta do arquivo php 
$mailrs = new PHPMailer(); 
 
// Método de envio 
$mailrs->IsSMTP(); 
 
// Enviar por SMTP 
$mailrs->Host = $readm['email_servidor'] ; 
 
// Você pode alterar este parametro para o endereço de SMTP do seu provedor 
$mailrs->Port = $readm['email_porta']; 
 
 
// Usar autenticação SMTP (obrigatório) 
$mailrs->SMTPAuth = true; 
 
// Usuário do servidor SMTP (endereço de email) 
// obs: Use a mesma senha da sua conta de email 
$mailrs->Username = $readm['email_usuario']; 
$mailrs->Password = $readm['email_senha'] ; 
 
// Configurações de compatibilidade para autenticação em TLS 
$mailrs->SMTPOptions = array( $readm['email_protocolo_seguranca'] => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) ); 
 
// Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro. 
//$mailrs->SMTPDebug = 2; 
 
// Define o remetente 
// Seu e-mail 
$mailrs->From = $readm['remetente']; 
 
// Seu nome 
$mailrs->FromName = $readm['nome']; 
 
// Define o(s) destinatário(s) 
$mailrs->AddAddress(post('billing_email'), $nome); 
 
// Opcional: mais de um destinatário
// $mailrs->AddAddress('fernando@email.com'); 
 
// Opcionais: CC e BCC
// $mailrs->AddCC('joana@provedor.com', 'Joana'); 
// $mailrs->AddBCC('roberto@gmail.com', 'Roberto'); 
 
// Definir se o e-mail é em formato HTML ou texto plano 
// Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
$mailrs->IsHTML(true); 
 
// Charset (opcional) 
$mailrs->CharSet = 'UTF-8'; 
 
// Assunto da mensagem 
$mailrs->Subject = "E-mail de Confirmação"; 

$info = "Olá, ".$nome.", muito obrigado por criar uma conta em nossa loja.<br>
Esse é um e-mail de confirmação de cadastro. Segue seus dados de acesso:<br><br>

Login: ".post('billing_email')."<br>
Senha: ".$senha."<br><br>

(Sua senha pode ser alterada a qualquer momento em sua área de cliente).<br><br>

Para acessar sua área do cliente onde você terá acesso a seus pedidos, endereços, perfil e muito mais, basta clicar no link abaixo e usar os dados de acesso fornecidos acima.<br>
<a href=".$_POST['pagina_cliente'].">".$_POST['pagina_cliente']."</a>

";
 

     
$mailrs->Body = $info;

$enviado = $mailrs->Send(); 
