<?php
 session_start();
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
require_once('../../../database/upload.class.php');
$cf = DBRead('ecommerce_config','*');
  $config = [];
  foreach ($cf as $key => $row) {
    $config[$row['id']] = $row['valor'];
  }
$token = md5(session_id());
$_POST['senha'] = md5($_POST['senha']);

if(isset($_GET['token']) && $_GET['token'] === $token) {
   
    /*if($_FILES['imagem']['name'] == null){
           $keep = DBRead('ead_usuario','*' ,"WHERE id = '{$id}'")[0];
           $path = $keep['imagem'];
        }else{
        $upload_folder = '../../../wa/ead/uploads/';
        $handle = new Upload($_FILES['imagem']);
        $handle->file_new_name_body = md5(uniqid(rand(), true));
        $handle->Process($upload_folder);
        $path = $handle->file_dst_name;
    }*/
    $email=$_POST['email'];
    $origin=$config['pagina_cliente'];
    unset($_POST['email']);
    unset($_POST['origin']);
    foreach($_POST as $chave => $vazio){
        $data[$chave] = $vazio;
    }
    $query = DBCreate('ecommerce_usuario', $data, true);
    if ($query != 0) {
        echo 1;
        $readm = DBRead('ecommerce_config_email','*',"WHERE id = '1'")[0];
        // Inclui o arquivo class.phpmailer.php localizado na mesma pasta do arquivo php 
        include "../../../controller/ecommerce/PHPMailer-master/PHPMailerAutoload.php";
        include "../../../controller/ecommerce/PHPMailer-master/class.phpmailer.php"; 
        
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
        //$mail->SMTPDebug = 2; 
        
        // Define o remetente 
        // Seu e-mail 
        $mail->From = $readm['remetente']; 
        
        // Seu nome 
        $mail->FromName = $readm['nome']; 
        
        // Define o(s) destinatário(s) 
        $mail->AddAddress($email, $_POST['nome']); 
        
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
        $mail->Subject = "E-mail de Confirmação"; 

        $info = "Olá, esse é um e-mail para validação de seu cadastro. Para validar a sua conta basta clicar <a href='".$origin."?X=".base64_encode($query)."&email=".$email."'>aqui</a>";
        
        // Corpo do email 
        $mail->Body = $info; 
        
        // Opcional: Anexos 
        // $mail->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf"); 
        
        // Envia o e-mail 
        $enviado = $mail->Send(); 
    } else {
        echo "Erro no Banco de Dados" ;
    }
    
}
