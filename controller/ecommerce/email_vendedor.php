<?php
 $readm = DBRead('ecommerce_config_email','*',"WHERE id = '1'")[0];
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
// $mail->SMTPDebug = 2; 
 
// Define o remetente 
// Seu e-mail 
$mail->From = $readm['remetente']; 
 
// Seu nome 
$mail->FromName = $readm['nome']; 
 
// Define o(s) destinatário(s) 
$mail->AddAddress($readm['remetente'], $readm['nome']); 
 
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
$mail->Subject = "Novo pedido #".$query; 


foreach( $read  as $k => $abs){ $npdts = json_decode($abs['produto'], true);foreach($npdts as $npdt){; $produto .= "

        <tr>
            <td style='border:solid #e5e5e5 1.0pt;padding:9.0pt 9.0pt 9.0pt 9.0pt;word-wrap:break-word'>
                <p class='MsoNormal'>
                    <span style='font-family:&quot;Helvetica&quot;,sans-serif;color:#636363'>". $npdt['produto']
                    ."</span>
                </p>
            </td>
            <td style='border:solid #e5e5e5 1.0pt;padding:9.0pt 9.0pt 9.0pt 9.0pt;word-wrap:break-word'>
                <p class='MsoNormal'>
                    <span style='font-family:&quot;Helvetica&quot;,sans-serif;color:#636363'>". $npdt['qtd']
                    ."</span>
                </p>
            </td>
            <td style='border:solid #e5e5e5 1.0pt;padding:9.0pt 9.0pt 9.0pt 9.0pt;word-wrap:break-word'>
                <p class='MsoNormal'>
                    <span style='font-family:&quot;Helvetica&quot;,sans-serif;color:#636363'>R$ ".
                   number_format(floatval(str_replace(",", ".", $npdt['un_valor'])), 2, ",", ".")
                    ."</span>
                </p>
            </td>
        </tr>
"; } };

$into = "

<table border='1' cellspacing='0' cellpadding='0' width='100%' style='width:100.0%;border:solid #e5e5e5 1.0pt'>
    <thead>
        <tr>
            <td style='border:solid #e5e5e5 1.0pt;padding:9.0pt 9.0pt 9.0pt 9.0pt'>
                <p class='MsoNormal'>
                    <b>
                        <span style='font-family:&quot;Helvetica&quot;,sans-serif;color:#636363'>Produto
                        </span>
                    </b>
                </p>
            </td>
            <td style='border:solid #e5e5e5 1.0pt;padding:9.0pt 9.0pt 9.0pt 9.0pt'>
                <p class='MsoNormal'>
                    <b>
                        <span style='font-family:&quot;Helvetica&quot;,sans-serif;color:#636363'>Quantidade
                        </span>
                    </b>
                </p>
            </td>
            <td style='border:solid #e5e5e5 1.0pt;padding:9.0pt 9.0pt 9.0pt 9.0pt'>
                <p class='MsoNormal'>
                    <b>
                        <span style='font-family:&quot;Helvetica&quot;,sans-serif;color:#636363'>Preço
                        </span>
                    </b>
                </p>
            </td>
        </tr>
    </thead>
    <tbody>".
    $produto
." <tr>
        <td style='border:solid #e5e5e5 1.0pt;padding:9.0pt 9.0pt 9.0pt 9.0pt;word-wrap:break-word'>
            <p class='MsoNormal'>
                <span style='font-family:&quot;Helvetica&quot;,sans-serif;color:#636363'>
                    <b>Tipo de Entrega</b>
                </span>
            </p>
        </td>
        <td style='border:solid #e5e5e5 1.0pt;padding:9.0pt 9.0pt 9.0pt 9.0pt;word-wrap:break-word'>
            <p class='MsoNormal'>
                <span style='font-family:&quot;Helvetica&quot;,sans-serif;color:#636363'>".
                     post('tipo_entrega')
                ."</span>
            </p>
        </td>
        <td style='border:solid #e5e5e5 1.0pt;padding:9.0pt 9.0pt 9.0pt 9.0pt;word-wrap:break-word'>
            <p class='MsoNormal'>
                <span style='font-family:&quot;Helvetica&quot;,sans-serif;color:#636363'>R$ ".
                   number_format(floatval(str_replace(",", ".", post('vl_frete'))), 2, ",", ".") 
                ."</span>
            </p>
        </td>
    </tr>
    <tr>
        <td colspan='2' style='border:solid #e5e5e5 1.0pt;padding:9.0pt 9.0pt 9.0pt 9.0pt;word-wrap:break-word'>
            <p class='MsoNormal'>
                <span style='font-family:&quot;Helvetica&quot;,sans-serif;color:#636363'>
                    <b>TOTAL</b>
                </span>
            </p>
        </td>
        <td style='border:solid #e5e5e5 1.0pt;padding:9.0pt 9.0pt 9.0pt 9.0pt;word-wrap:break-word'>
            <p class='MsoNormal'>
                <span style='font-family:&quot;Helvetica&quot;,sans-serif;color:#636363'>R$ ".
                    number_format(floatval(str_replace(",", ".", post('valor'))), 2, ",", ".")
                ."</span>
            </p>
        </td>
    </tr>
</tbody>
</table>

";
$info = "<div >
        <table style='width:40%, border: 1px solid black'>
            <tr style='border: 1px solid black'>
                <td style=''>
                    <h1 style=''>
                        <span style='font-family:&quot;Helvetica&quot;,sans-serif;font-weight:normal'>
                            Novo pedido: #".$query ."
                        </span>
                    </h1>
                </td>
            </tr>
            <tr style='border: 1px solid black'>
                <td>
                    <p style='margin-right:0cm;margin-bottom:12.0pt;margin-left:0cm;line-height:150%'>
                        <span style='font-size:10.5pt;line-height:150%;font-family:&quot;Helvetica&quot;,sans-serif;color:#636363'>Você recebeu o seguinte pedido de ".$nome.":</span>
                    </p>
                </td>
            </tr>"
            .$into.
        "</table>
        </div>
";
 
// Corpo do email 
$mail->Body = $info; 
 
// Opcional: Anexos 
// $mail->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf"); 
 
// Envia o e-mail 
$enviado = $mail->Send(); 
