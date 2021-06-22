
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
session_start();
if(isset($_SESSION['E-Wacontrol'])){
    $id = $_SESSION['E-Wacontrol'][0];
    $senha = $_SESSION['E-Wacontrol'][1];
}
else if(isset($_COOKIE['E-Wacontroltoken'])){
    $id =  $_COOKIE['E-Wacontrolid'];
    $senha =  $_COOKIE['E-Wacontroltoken'];
}
if(!empty($senha)){$valida = DBRead('ecommerce_usuario','*',"WHERE id = '{$id}' AND  senha = '{$senha}' ")[0];}
if(!empty($valida)){header('Location: https://www.localhost/Wa.Control/wa/ecommerce/adm/area_usuario/index.php');}
#if(!empty($valida)){header('Location:'.ConfigPainel('base_url').'wa/ecommerce/adm/area_usuario/index.php');}
?>
<html lang="pt-BR">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
        <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>wa/<?php echo $modulo ?>/adm/src/style/main.css">
        <?php require_once('../../../../wa/'.$modulo .'/adm/login/src/style/wactrl.php') ?>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue-swal@1/dist/vue-swal.min.js"></script>
        <style>
        .senha-box{
            display:flex
        }
        </style>
</head>
<body class="is-dropdn-click win no-loader">
       
    <div class="page-content" id="main_ecommerce">
        <div class="holder mt-0">
            <div class="container">
                
            </div>
        </div>
        <div class="holder mt-0" id="height">
            <div  class="container-fluid">
                <div v-if="idx=='login'" class="row justify-content-around">
                    <div class="col-sm-6 col-md-4">
                        <div id="loginForm">
                            <h2 class="text-center">ENTRAR</h2>
                            <div class="form-wrapper">
                                <p>{{idx == 'login'?'Se você tem uma conta conosco, faça o login.':idx == 'altera'?'Insira sua nova senha':'Insira seu e-mail de recuperação'}}</p>
                                
                                <div class="form-group">
                                    <input :type="idx == 'altera'? 'password':'email'" class="form-control" :placeholder="idx == 'altera'? 'Senha':'E-mail'">
                                </div>
                                <div v-if="idx == 'login'||idx == 'altera'" class="form-group senha-box">
                                    <input id="senha1" type="password" class="form-control" :placeholder="idx == 'altera'? 'Confirme a Senha':'Senha'">
                                    <a v-if="idx != 'altera'" style="position: relative;right: 9%;width: 0px;padding-top: 3.5%;" href="javascript:void(0)" @click="ver(1)"><i id="eye1" class="far fa-eye-slash"></i></a>
                                </div>
                                <p class="text-uppercase" @click="a=>idx=='login'?idx ='reset':idx='login'">
                                    <a href="return:false" class="js-toggle-forms">{{idx == 'login'?'ESQUECEU SUA SENHA?':'VOLTAR'}}</a>
                                </p>
                                <div class="clearfix" v-if="idx == 'login'">
                                    <input id="checkbox1" name="checkbox1" type="checkbox" > 
                                    <label for="checkbox1">LEMBRE DE MIM</label>
                                </div>
                                <button type="button" class="btn autentica">{{idx == 'login'?'Entrar':idx == 'altera'?'Salvar':'Enviar'}}</button>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mt-3 mt-sm-0">
                        <h2 class="text-center">REGISTRO</h2>
                        <div class="form-wrapper">
                            <p>Ao criar uma conta em nossa loja, você poderá passar pelo processo de finalização de compra mais rápido, armazenar vários endereços de remessa, visualizar e rastrear seus pedidos em sua conta e muito mais.</p>
                            <a href="javascript:void(0)"  @click="idx = 'registro'" class="btn">Crie a sua conta aqui</a>
                        </div>
                    </div>
                </div>                     
                <div v-if="idx=='registro'" class="row justify-content-center">
                    <div class="col-sm-10 col-md-12">
                        <h2 class="text-center">Criar Conta</h2>
                        <div class="form-wrapper">
                            <form action="#" >
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input id="required" name="nome" type="text" class="form-control" placeholder="Nome">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input id="required" name="sobrenome" type="text" class="form-control" placeholder="Sobrenome">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input id="required" name="email" type="text" class="form-control" placeholder="E-mail">
                                </div>
                                <div class="form-group">
                                    <input id="senha2" name="senha" type="password" class="form-control senha" placeholder="Senha">
                                    <a style="position: relative;left: 100%;width: 0px;bottom: 27px;margin-left:-25px" href="javascript:void(0)" @click="ver(2)">
                                    <i style="position:absolute" id="eye2" class="far fa-eye-slash"></i></a>
                                </div>
                                
                                <div class="form-group">
                                    <input id="senha3" type="password" class="form-control senha" placeholder="Confirmar Senha">
                                    <a  style="position: relative;left: 100%;width: 0px;bottom: 27px;margin-left:-25px" href="javascript:void(0)" @click="ver(3)">
                                    <i id="eye3" class="far fa-eye-slash"></i></a>
                                </div>
                                <!--<div class="clearfix"><input id="checkbox1" name="checkbox1" type="checkbox" checked="checked"> <label for="checkbox1">By registering your details you agree to our Terms and Conditions and privacy and cookie policy</label></div>-->
                                <button type="reset" @click="idx='login'" class="btn btn--alt js-close-form" data-form="#updateDetails">Cancelar</button>                             
                                <button class="btn ml-1" type="button" @click="registrar()">Salvar</button>
                            </form>
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
            origin:'<?php echo 'https://www.localhost/Wa.Control/'; #RemoveHttpS(ConfigPainel('base_url')) ?>'
        },
                
        methods:{
            ver: function(n){
                let senha = document.getElementById('senha'+n)
                if(senha.type == 'password'){
                    senha.type = 'text'
                    document.getElementById('eye'+n).setAttribute('class','far fa-eye')
                }else{
                    senha.type = 'password'
                    document.getElementById('eye'+n).setAttribute('class','far fa-eye-slash')
                }
            },
            registrar: function(){
                let senha = document.getElementsByClassName('senha')
                let a  = senha[0].value.match(/[0-9]/)
                let b  = senha[0].value.match(/[A-Z]/)
                let c = senha[0].value.length > 5
                let ipt =  document.querySelectorAll('input')
                let erro = false
                for(let indice = 0; indice < 4; indice++){
                    if(ipt[indice].value ==''){
                        erro = true                        
                        break
                    }else{
                        form.append(ipt[indice].name,ipt[indice].value)
                    }
                }
                if(!a || !b || !c){
                    window.parent.location.assign('javascript:swal({title:"Senha muito fraca!",html:true, text:"Critérios mínimos: \n 1° Uma letra maiúscula \n 2° Um número \n 3° mais de 5 dígitos.", icon:"error"})');
                }else if(senha[0].value != senha[1].value){
                    window.parent.location.assign('javascript:swal("ERRO","Senha incorreta","error")')
                }else if(erro){
                    window.parent.location.assign('javascript:swal("ERRO!", "Por favor preencha todos os campos", "error")'); 
                }else{                    
                    fetch(vue.origin+'wa/ecommerce/apis/cadastrar.php'+sessao,{
                        method:'post',
                        body: form
                    }).then(d => d.text()).then(d=>{
                        if(d == 1){
                            alert(10)
                            //window.parent.location.assign('javascript:swal("E-mail Enviado!", "E-mail de recuperação enviado com sucesso", "success").then((isConfirm)=>{if(isConfirm){document.location.reload(true);}})')
                        }else{
                            window.parent.location.assign('javascript:swal("ERRO!", "'+d+'", "error")'); 
                        }
                    })  
                }
            }
        }
    })
    let url = window.parent.location.href
    let reset = window.parent.location.search.replace('?Z=', "")
    if(reset){
        vue.idx = 'altera'
    }
    var form = new FormData();
    const sessao = '?token=<?php echo md5(session_id()) ?>&'
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
                    window.location.href = vue.origin+'wa/ecommerce/adm/area_usuario/'                    
                }else{                                       
                    window.parent.location.assign('javascript:swal("ERRO!","'+a+'", "error")'); 
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
                    window.parent.location.assign('javascript:swal("E-mail Enviado!", "E-mail de recuperação enviado com sucesso", "success").then((isConfirm)=>{if(isConfirm){document.location.reload(true);}})')
                }else{
                    window.parent.location.assign('javascript:swal("ERRO!", "'+d+'", "error")'); 
                }
            })    
        }else{
            let senha = document.querySelectorAll('input[type="password"]')
            let a  = senha[0].value.match(/[0-9]/)
            let b  = senha[0].value.match(/[A-Z]/)
            let c = senha[0].value.length > 5
            if(!a || !b || !c){
                window.parent.location.assign('javascript:swal({title:"Senha muito fraca!",html:true, text:"Critérios mínimos: \n 1° Uma letra maiúscula \n 2° Um número \n 3° mais de 5 dígitos.", icon:"error"})');
            }else if(senha[0].value != senha[1].value){
                window.parent.location.assign('javascript:swal("ERRO","Senha incorreta","error")')
            }else{
            form.append('senha',senha[0].value)
            form.append('Z',reset) 
            fetch(vue.origin+'wa/ecommerce/apis/altera.php',{
                method:"post",
                body:form
            }).then(a => a.text()).then(data=>{
                if(data == 1){
                    window.parent.location.assign('javascript:swal("Salvo!", "Senha alterada com sucesso", "success")')
                    senha[0].value = " "; vue.idx ="login";
                }else{
                    window.parent.location.assign('javascript: swal("ERRO","'+data+'","error")')}
            })
            }
        }
    })
   
</script> 
<?php require_once('../../../../wa/'.$modulo .'/adm/login/src/script/wactrl.php') ?>   
<script src="src/script/main.js"></script>
</body>
</html>