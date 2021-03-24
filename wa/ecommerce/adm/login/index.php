
<?php
#header('Access-Control-Allow-Origin: *');
require_once('../../../../includes/funcoes.php');
require_once('../../../../database/config.database.php');
require_once('../../../../database/config.php');
    #INICIO
$modulo = 'ecommerce';
$atual = $modulo.'_usuarios';
#$id = $_GET['id'];
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
        <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>wa/<?php echo $modulo ?>/adm/src/style/main.css">
        <?php require_once('../../../../wa/'.$modulo .'/adm/login/src/style/wactrl.php') ?>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue-swal@1/dist/vue-swal.min.js"></script>
</head>
<div class="is-dropdn-click win no-loader">
       
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
                                <p>{{idx == 'login'?'Se você tem uma conta conosco, faça o login.':idx == 'altera'?'Insira sua nova senha':'Insira seu e-mail de recuperação'}}</p>
                                <form >
                                    <div class="form-group">
                                        <input :type="idx == 'altera'? 'password':'email'" class="form-control" :placeholder="idx == 'altera'? 'Senha':'E-mail'">
                                    </div>
                                    <div v-if="idx == 'login'||idx == 'altera'" class="form-group">
                                        <input type="password" class="form-control" :placeholder="idx == 'altera'? 'Confirme a Senha':'Senha'">
                                    </div>
                                    <p class="text-uppercase" @click="a=>idx=='login'?idx ='reset':idx='login'">
                                        <a href="return:false" class="js-toggle-forms">{{idx == 'login'?'ESQUECEU SUA SENHA?':'VOLTAR'}}</a>
                                    </p>
                                    <div class="clearfix" v-if="idx == 'login'">
                                        <input id="checkbox1" name="checkbox1" type="checkbox" > 
                                        <label for="checkbox1">LEMBRE DE MIM</label>
                                    </div>
                                    <button type="button" class="btn autentica">{{idx == 'login'?'Entrar':idx == 'altera'?'Salvar':'Enviar'}}</button>
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
            //config:<?php #echo $config ?>,
            origin:'<?php echo ConfigPainel('base_url') ?>'
        },
        methods:{

        }
    })
    let url = window.parent.location.href
    let reset = window.parent.location.search.replace('?Z=', "")
    if(reset){
        vue.idx = 'altera'
    }
    var form = new FormData();
    document.getElementsByClassName('autentica')[0].addEventListener('click',a=>{
        if(a.target.innerText == 'ENTRAR'){
            fetch(vue.origin+'wa/ecommerce/apis/autentica.php',{
                method: 'POST',
                headers:{
                    'Authorization': 'Basic '+btoa(document.querySelectorAll('input[type="email"]')[0].value+':'+document.querySelectorAll('input[type="password"]')[0].value),
                    'Content-Type': 'application/json',
                },
                body: document.getElementById('checkbox1').checked 
            }).then(a=>a.text()).then(a=>{
                if(a == 1){
                    //window.location.href = origin+'wa/ead/dashboard/inicio/?status=curso&posicao=avancar'
                }else{
                    swal("ERRO!", a, "error"); 
                }
            })
        }else if(a.target.innerText == 'ENVIAR'){
            form.append('email',document.querySelectorAll('input[type="email"]')[0].value)
            form.append('origin',url)
            fetch(vue.origin+'wa/ecommerce/apis/recupera.php',{
                method:'post',
                body: form
            }).then(d => d.text()).then(d=>{
                if(d == 1){
                    swal("E-mail Enviado!", "E-mail de recuperação enviado com sucesso", "success").then((isConfirm)=>{if(isConfirm){document.location.reload(true);}})
                }else{
                    swal("ERRO!", d, "error"); 
                }
            })    
        }else{
            let senha = document.querySelectorAll('input[type="password"]')
            let a  = senha[0].value.match(/[0-9]/)
            let b  = senha[0].value.match(/[A-Z]/)
            let c = senha[0].value.length > 5
            if(!a || !b || !c){
                swal({title:"Senha muito fraca!",html:true, text:"Critérios mínimos: \n 1° Uma letra maiúscula \n 2° Um número \n 3° mais de 5 dígitos.", icon:"error"});
            }else if(senha[0].value != senha[1].value){
                swal("ERRO","Senha incorreta","error")
            }else{
            form.append('senha',senha[0].value)
            form.append('Z',reset) 
            fetch(vue.origin+'wa/ecommerce/apis/altera.php',{
                method:"post",
                body:form
            }).then(a => a.text()).then(data=>{
                if(data == 1){
                    swal("Salvo!", "Senha alterada com sucesso", "success").then((isConfirm)=>{if(isConfirm){senha[0].value = ''; vue.idx ='login';}})
                }else{
                    swal("ERRO",data,"error")}
            })
            }
        }
    })
    //parent.document.getElementsByClassName('container')[0].style.background='red'
</script> 
<?php require_once('../../../../wa/'.$modulo .'/adm/login/src/script/wactrl.php') ?>   
<script src="src/script/main.js"></script>
</div>
</html>