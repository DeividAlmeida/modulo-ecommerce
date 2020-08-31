<?php
require_once('functions.php');
require_once('../../../controller/class.phpmailer/PHPMailerAutoload.php');

if(isset($_GET['UpdateQtd'])){
  $id     = get('id');
  $qtd    = get('qtd');
  CarrinhoUpdate($id, $qtd);
  exit();
}

if(isset($_GET['AddItem'])){
  $id = get('AddItem');
  $qtd = get('qtd');
  CarrinhoAddQtd($id, $qtd);
  exit();
}

if(isset($_GET['RemItem'])){
  $id = get('RemItem');
  CarrinhoRemItem($id, 1);
  exit();
}


if(isset($_GET['EnviarEmail'])){
  if(!empty($_SESSION["cart"])){
    $form_nome  = post('nome');
    $form_email = post('email');
    $form_telefone  = post('telefone');
    $form_whatsapp = post('whatsapp');
    $form_observacoes = post('observacoes');

    // Pegando informações da configuração
    $query = DBRead('ecommerce_config','*');

    $config = [];
    foreach ($query as $key => $row) {
      $config[$row['id']] = $row['valor'];
    }

    // Configurando PHP Mailer
    $mail = new PHPMailer();
    $mail->isSMTP(true);
    $mail->IsHTML(true);
		$mail->CharSet 			= "UTF-8";
		$mail->SMTPSecure 	= $config["email_protocolo_seguranca"];
		$mail->Host 				= $config["email_servidor"];
		$mail->Username 		= $config["email_usuario"];
		$mail->Password 		= $config["email_senha"];
		$mail->Port 				= "{$config['email_porta']}";
		$mail->From 				= $config["email_disparo"];
		$mail->FromName 		= ConfigPainel('site_nome');

    if(strstr( $config["email_recebimento"], ';')){
			$email = explode(';',  $config["email_recebimento"]);
			foreach($email as $key => $value) {
				$mail->AddAddress($value);
			}
		} else {
			$mail->AddAddress($config["email_recebimento"]);
		}

    $html_produto = "";

    foreach($_SESSION["cart"] as $id => $qtd ){
      $query   = DBRead('ecommerce', '*', "WHERE id = $id");
      $produto = $query[0];
      $html_produto .= "<p>".$produto['codigo']." - <b>{$produto['nome']}</b> ({$qtd}) - ".$config['moeda'].' '.number_format(number_format($produto['preco'],2,",","."), 2, ',', '.')." - Subtotal: ".number_format($produto['preco']*$qtd, 2, ',', '.')."</p>";
    }

    if(!empty($form_email)){
			$mail->addReplyTo($form_email, $form_nome);
		}

    $email_cor_bg           = $config['email_cor_bg'];
    $email_cor_header_bg    = $config['email_cor_header_bg'];
    $email_cor_header_texto = $config['email_cor_header_texto'];

    $mail->Subject = "Solicitação de Orçamento para ".$form_nome;
		$mail->Body = "<div id='m_-7598057918015146334m_-2331253013811829785wrapper' dir='ltr' style='background-color:$email_cor_bg;margin:0;padding:70px 0 70px 0;width:100%'>
		  <table border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'>
		    <tbody>
		      <tr>
		        <td align='center' valign='top'>
		          <div id='m_-7598057918015146334m_-2331253013811829785template_header_image'></div>
		          <table border='0' cellpadding='0' cellspacing='0' width='600' id='m_-7598057918015146334m_-2331253013811829785template_container' style='background-color:#ffffff;border:1px solid #dedede;border-radius:3px!important'>
		            <tbody>
		              <tr>
		                <td align='center' valign='top'>
		                  <table border='0' cellpadding='0' cellspacing='0' width='600' id='m_-7598057918015146334m_-2331253013811829785template_header' style='background-color:$email_cor_header_bg;border-radius:3px 3px 0 0!important;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif'>
		                    <tbody>
		                      <tr>
		                        <td id='m_-7598057918015146334m_-2331253013811829785header_wrapper' style='padding:36px 48px;display:block'>
		                          <h1 style='color:$email_cor_header_texto;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left'>{$mail->Subject}</h1>
		                        </td>
		                      </tr>
		                    </tbody>
		                  </table>
		                </td>
		              </tr>

		              <tr>
		                <td align='center' valign='top'>
		                  <table border='0' cellpadding='0' cellspacing='0' width='600' id='m_-7598057918015146334m_-2331253013811829785template_body'>
		                    <tbody>
		                      <tr>
		                        <td valign='top' id='m_-7598057918015146334m_-2331253013811829785body_content' style='background-color:#ffffff'>
		                          <table border='0' cellpadding='20' cellspacing='0' width='100%'>
		                            <tbody>
		                              <tr>
		                                <td valign='top' style='padding:48px'>
		                                  <div id='m_-7598057918015146334m_-2331253013811829785body_content_inner' style='color:#636363;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left'>
		                                    <p style='margin:0 0 16px'></p>
                                        <p>Nome: $form_nome</p>
                                        <p>Telefone: $form_telefone</p>
                                        <p>Whatsapp: $form_whatsapp</p>
                                        <p>Email: $form_email</p>
                                        <p>Observação: $form_observacoes</p>
                                        <p>Itens:</p>
		                                    $html_produto
		                                  </div>
		                                </td>
		                              </tr>
		                            </tbody>
		                          </table>
		                        </td>
		                      </tr>
		                    </tbody>
		                  </table>
		                </td>
		              </tr>
		            </tbody>
		          </table>
		        </td>
		      </tr>
		    </tbody>
		  </table>
		</div>";

    if($mail->Send()){
      http_response_code(200);
    }
    else{
      http_response_code(500);
      echo $mail->ErrorInfo;
    }
  }
  else{
    http_response_code(404);
  }
  exit();
}
