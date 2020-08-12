<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
$query = DBRead('ecommerce_config','*');

$fg = ConfigPainel('base_url');
//Necessário testar em dominio com SSL
define("URL", $fg."wa/ecommerce/checkout/");

$sandbox = true;
if ($sandbox) {
    //Credenciais do SandBox
    define("EMAIL_PAGSEGURO", "mr.davi@bol.com.br");
    define("TOKEN_PAGSEGURO", "62AFBB5AD62049D395AE6489FC65CBCC");
    define("URL_PAGSEGURO", "https://ws.sandbox.pagseguro.uol.com.br/v2/");
    define("SCRIPT_PAGSEGURO", "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
    define("EMAIL_LOJA", "");
    define("MOEDA_PAGAMENTO", "BRL");
    define("URL_NOTIFICACAO", "");
} else {
    //Credenciais do PagSeguro
    define("EMAIL_PAGSEGURO", "Seu e-mail do PagSeguro");
    define("TOKEN_PAGSEGURO", "Seu token no PagSeguro");
    define("URL_PAGSEGURO", "https://ws.pagseguro.uol.com.br/v2/");
    define("SCRIPT_PAGSEGURO", "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
    define("EMAIL_LOJA", "E-mail de suporte pós venda");
    define("MOEDA_PAGAMENTO", "BRL");
    define("URL_NOTIFICACAO", "https://sualoja.com.br/notifica.html");
}