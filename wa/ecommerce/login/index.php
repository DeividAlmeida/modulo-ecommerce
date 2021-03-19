
<?php
#header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
    #INICIO
$modulo = 'ecommerce';
$atual = $modulo.'_usuarios';
$id = $_GET['id'];
    #FIM
$conf = $modulo.'_config';
#$config =  json_encode(DBRead($conf,'*')[0]);

?>
<html lang="pt-BR">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>wa/<?php echo $modulo ?>/login/src/style/main.css">
        <?php require_once('../../../wa/'.$modulo .'/login/src/style/wactrl.php') ?>
        <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue-swal@1/dist/vue-swal.min.js"></script>
</head>
<body class="is-dropdn-click win no-loader">
    <div class="body-preloader">
        <div class="loader-wrap">
            <div class="dots">
                <div class="dot one"></div>
                <div class="dot two"></div>
                <div class="dot three"></div>
            </div>
        </div>
    </div>
    
    <div class="page-content" id="main_ecommerce">
        <div class="holder mt-0">
            <div class="container">
                
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-sm-6 col-md-4">
                        <div id="loginForm">
                            <h2 class="text-center">ENTRAR</h2>
                            <div class="form-wrapper">
                                <p>{{idx == 'login'?'Se você tem uma conta conosco, faça o login.':'Insira seu e-mail de recuperação'}}</p>
                                <form >
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="E-mail">
                                    </div>
                                    <div v-if="idx == 'login'" class="form-group">
                                        <input type="password" class="form-control" placeholder="Senha">
                                    </div>
                                    <p class="text-uppercase" @click="a=>idx=='login'?idx ='reset':idx='login'">
                                        <a href="return:false" class="js-toggle-forms">{{idx == 'login'?'ESQUECEU SUA SENHA?':'VOLTAR'}}</a>
                                    </p>
                                    <div class="clearfix" v-if="idx == 'login'">
                                        <input id="checkbox1" name="checkbox1" type="checkbox" > 
                                        <label for="checkbox1">LEMBRE DE MIM</label>
                                    </div>
                                    <button type="button" class="btn">{{idx == 'login'?'Entrar':'Enviar'}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mt-3 mt-sm-0">
                        <h2 class="text-center">REGISTRO</h2>
                        <div class="form-wrapper">
                            <p>Ao criar uma conta em nossa loja, você poderá passar pelo processo de finalização de compra mais rápido, armazenar vários endereços de remessa, visualizar e rastrear seus pedidos em sua conta e muito mais.</p>
                            <a href="return:false" class="btn">Crie a sua conta aqui</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    const vue = new Vue({
        el: '#main_<?php echo $modulo ?>',
        data:{
            idx:'login',
            //config:<?php echo $config ?>,
            origin:'<?php echo ConfigPainel('base_url') ?>'
        },
        methods:{

        }
    })
</script> 
<?php require_once('../../../wa/'.$modulo .'/login/src/script/wactrl.php') ?>   
<script src="src/script/main.js"></script>
</body>
</html>