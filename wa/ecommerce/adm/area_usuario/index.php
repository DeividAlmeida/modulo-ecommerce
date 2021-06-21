<!DOCTYPE html>
<?php
header('Access-Control-Allow-Origin: *');
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
$valida = DBRead('ecommerce_usuario','*',"WHERE id = '{$id}' AND  senha = '{$senha}' ")[0];
$user = json_encode(DBRead('ecommerce_usuario','id, nome, sobrenome, telefone, cpf, email, endereco ',"WHERE id = '{$id}' AND  senha = '{$senha}' ")[0]);
 if($senha!= null && $valida['senha'] == $senha){
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
        
</head>
    <body  class="is-dropdn-click win no-loader" >
        <div class="page-content" id="main_area">
            <div class="holder mt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 aside aside--left">
                            <div class="list-group">
                                <a href="javascript:void(0)" @click="idx = 'pedidos'; status = ''" :class="idx == 'pedidos'?'list-group-item active':'list-group-item'">Meus Pedidos</a> 
                                <a href="javascript:void(0)" @click="idx = 'endereco'; status = ''" :class="idx == 'endereco'?'list-group-item active':'list-group-item'">Meu Endereço</a> 
                                <a href="javascript:void(0)" @click="idx = 'perfil'; status = ''" :class="idx == 'perfil'?'list-group-item active':'list-group-item'">Perfil</a> 
                                <a onclick="window.location.href =vue.origin+'wa/ecommerce/apis/logout.php?token=<?php echo md5(session_id()) ?>'" class="list-group-item">Sair</a>
                            </div>
                        </div>
                        <div class="col-md-9 aside" v-if="idx == null">
                            <h2>Seja Bem Vindo {{info.nome}} !</h2>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                                    

                        <div class="col-md-9 aside" v-if="idx == 'perfil'">                        
                            <div class="row" >
                                <h2>Perfil</h2>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3>Informações Pessoais</h3>
                                            <p>
                                                <b>Nome:</b> {{info.nome}}<br>
                                                <b>Sobrenome:</b> {{info.sobrenome}}<br>
                                                <b>E-mail:</b> {{info.email}}<br>
                                                <b>Telefone:</b> {{info.telefone}}
                                            </p>
                                            <div class="mt-2 clearfix">
                                                <a href="javascript:void(0)" @click="status = 'editar'" class="link-icn js-show-form" >
                                                <i class="icon-pencil"></i>Editar
                                            </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div :class="status != 'editar'?'card mt-3 d-none':'card mt-3'" id="updateDetails">
                                <div class="card-body">
                                    <h3>Atualize os Detalhes de Sua Conta</h3>
                                    <div class="row mt-2">
                                        <div class="col-sm-6">
                                        <label class="text-uppercase">Nome:</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="nome" v-model="info.nome" :placeholder="info.nome">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="text-uppercase">Sobrenome:</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="sobrenome" v-model="info.sobrenome" :placeholder="info.sobrenome">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-6">
                                            <label class="text-uppercase">E-mail:</label>
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" v-model="info.email" :placeholder="info.email">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="text-uppercase">Telefone:</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="telefone" v-model="info.telefone" :placeholder="info.telefone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 clearfix">
                                        <button type="reset" @click="idx = 'perfil'; status = ''" class="btn btn--alt js-close-form" data-form="#updateDetails">Cancelar</button> 
                                        <button type="bottom" @click="atualiza()" class="btn ml-1">Atualizar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 aside" v-if="idx == 'pedidos'">
                            <h2>Histórico de Pedidos</h2>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-order-history">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Número do Pedido</th>
                                            <th scope="col">Data do Pedido</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Preço Total </th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><b>175525</b> <a href="cart.html" class="ml-1">Ver Detalhes</a></td>
                                            <td>01.02.2017</td>
                                            <td>Shipped</td>
                                            <td><span class="color">$1252.00</span></td>
                                            <td><a href="#" class="btn">Comprar Novamente</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><b>189067</b> <a href="cart.html" class="ml-1">Ver Detalhes</a></td>
                                            <td>12.02.2017</td>
                                            <td>Shipped</td>
                                            <td><span class="color">$367.00</span></td>
                                            <td><a href="#" class="btn">Comprar Novamente</a></td>
                                        </tr>                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right mt-2"><a href="#" class="btn btn--alt">Limpar Histórico</a></div>
                        </div>

                        <div class="col-md-9 aside" v-if="idx == 'endereco'">
                            <h2>Meus Endereços</h2>
                            <div class="row">
                                <div class="col-sm-6" v-for="endereco, i of info.endereco">                                
                                    <div class="card">
                                        <div class="card-body">
                                            <h3>Endereço {{endereco.padrao ? i+1+' (Padrão)': i+1}} </h3>
                                            <p>{{endereco.cidade+' - '+endereco.estado}}<br>
                                                {{endereco.rua+' - '+endereco.numero+' - '+ endereco.bairro}}<br>
                                                {{endereco.cep}}</p>
                                            <div class="mt-2 clearfix">
                                                <a href="javascript: void(0)" @click="status = 'editar'; id=i" class="link-icn js-show-form" data-form="#updateAddress">
                                                    <i class="icon-pencil"></i>Editar
                                                </a> 
                                                <a href="javascript: void(0)" @click="remove(i)" class="link-icn ml-1 float-right">
                                                    <i class="icon-cross"></i>
                                                    Deletar
                                                </a>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>                                
                            </div>
                            <div class="card mt-3" v-if="status == 'editar'" id="updateAddress">
                                <div class="card-body">
                                    <h3>Editar Endereço</h3>
                                    <label class="text-uppercase">Pais:</label>
                                    <div class="form-group ">
                                        <select class="form-control">
                                            <option selected hidden>Brasil</option>                                            
                                        </select>
                                    </div>
                                    <label class="text-uppercase">Estado:</label>
                                    <div class="form-group select-wrapper">
                                        <select class="form-control" id="estado" v-model="info.endereco[id].estado">
                                            <option value=""selected hidden>Estado</option>
                                            <option value="AC" >Acre</option>
                                            <option value="AL" >Alagoas</option>
                                            <option value="AP" >Amapá</option>
                                            <option value="AM" >Amazonas</option>
                                            <option value="BA" >Bahia</option>
                                            <option value="CE" >Ceará</option>
                                            <option value="DF" >Distrito Federal</option>
                                            <option value="ES" >Espírito Santo</option>
                                            <option value="GO" >Goiás</option>
                                            <option value="MA" >Maranhão</option>
                                            <option value="MT" >Mato Grosso</option>
                                            <option value="MS" >Mato Grosso do Sul</option>
                                            <option value="MG" >Minas Gerais</option>
                                            <option value="PA" >Pará</option>
                                            <option value="PB" >Paraíba</option>
                                            <option value="PR" >Paraná</option>
                                            <option value="PE" >Pernambuco</option>
                                            <option value="PI" >Piauí</option>
                                            <option value="RJ" >Rio de Janeiro</option>
                                            <option value="RN" >Rio Grande do Norte</option>
                                            <option value="RS" >Rio Grande do Sul</option>
                                            <option value="RO" >Rondônia</option>
                                            <option value="RR" >Roraima</option>
                                            <option value="SC" >Santa Catarina</option>
                                            <option value="SP" >São Paulo</option>
                                            <option value="SE" >Sergipe</option>
                                            <option value="TO" >Tocantins</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6"><label class="text-uppercase">Cidade:</label>
                                            <div class="form-group"><input v-model="info.endereco[id].cidade" type="text" class="form-control" id="cidade"></div>
                                        </div>
                                        <div class="col-sm-6"><label class="text-uppercase">Rua:</label>
                                            <div class="form-group"><input v-model="info.endereco[id].rua" type="text" class="form-control" id="rua"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6"><label class="text-uppercase">Bairro:</label>
                                            <div class="form-group"><input v-model="info.endereco[id].bairro" type="text" class="form-control" id="bairro"></div>
                                        </div>
                                        <div class="col-sm-6"><label class="text-uppercase">Número:</label>
                                            <div class="form-group"><input v-model="info.endereco[id].numero" type="text" class="form-control" id="numero"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6"><label class="text-uppercase">CEP:</label>
                                            <div class="form-group"><input v-model="info.endereco[id].cep" type="text" class="form-control" id="cep"></div>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <input v-if="info.endereco[id].padrao" checked id="formCheckbox1" name="checkbox1" type="checkbox"> 
                                        <input v-else id="formCheckbox1" name="checkbox1" type="checkbox"> 
                                        <label for="formCheckbox1">Endereço de entrega</label>
                                    </div>
                                    <div class="mt-2">
                                        <button type="button" @click="status = ''"  class="btn btn--alt js-close-form" data-form="#updateAddress">Cancelar</button> 
                                        <button type="button" :id="id" onclick="salvar(this.id)"  class="btn ml-1">Salvar </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3" v-if="status == 'adicionar'" id="updateAddress">
                                <div class="card-body">
                                    <h3>Editar Endereço</h3>
                                    <label class="text-uppercase">Pais:</label>
                                    <div class="form-group ">
                                        <select class="form-control">
                                            <option selected hidden>Brasil</option>                                            
                                        </select>
                                    </div>
                                    <label class="text-uppercase">Estado:</label>
                                    <div class="form-group select-wrapper">
                                        <select class="form-control" id="estado">
                                            <option value="" hidden selected>Estado</option>
                                            <option value="AC" >Acre</option>
                                            <option value="AL" >Alagoas</option>
                                            <option value="AP" >Amapá</option>
                                            <option value="AM" >Amazonas</option>
                                            <option value="BA" >Bahia</option>
                                            <option value="CE" >Ceará</option>
                                            <option value="DF" >Distrito Federal</option>
                                            <option value="ES" >Espírito Santo</option>
                                            <option value="GO" >Goiás</option>
                                            <option value="MA" >Maranhão</option>
                                            <option value="MT" >Mato Grosso</option>
                                            <option value="MS" >Mato Grosso do Sul</option>
                                            <option value="MG" >Minas Gerais</option>
                                            <option value="PA" >Pará</option>
                                            <option value="PB" >Paraíba</option>
                                            <option value="PR" >Paraná</option>
                                            <option value="PE" >Pernambuco</option>
                                            <option value="PI" >Piauí</option>
                                            <option value="RJ" >Rio de Janeiro</option>
                                            <option value="RN" >Rio Grande do Norte</option>
                                            <option value="RS" >Rio Grande do Sul</option>
                                            <option value="RO" >Rondônia</option>
                                            <option value="RR" >Roraima</option>
                                            <option value="SC" >Santa Catarina</option>
                                            <option value="SP" >São Paulo</option>
                                            <option value="SE" >Sergipe</option>
                                            <option value="TO" >Tocantins</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6"><label class="text-uppercase">Cidade:</label>
                                            <div class="form-group"><input type="text" class="form-control" id="cidade"></div>
                                        </div>
                                        <div class="col-sm-6"><label class="text-uppercase">Rua:</label>
                                            <div class="form-group"><input type="text" class="form-control" id="rua"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6"><label class="text-uppercase">Bairro:</label>
                                            <div class="form-group"><input type="text" class="form-control" id="bairro"></div>
                                        </div>
                                        <div class="col-sm-6"><label class="text-uppercase">Número:</label>
                                            <div class="form-group"><input type="text" class="form-control" id="numero"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6"><label class="text-uppercase">CEP:</label>
                                            <div class="form-group"><input type="text" class="form-control" id="cep"></div>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <input  id="formCheckbox1" name="checkbox1" type="checkbox"> 
                                        <label for="formCheckbox1">Endereço de entrega</label>
                                    </div>
                                    <div class="mt-2">
                                        <button type="button" @click="status = ''" class="btn btn--alt js-close-form" data-form="#updateAddress">Cancelar</button> 
                                        <button type="button" @click="add()" class="btn ml-1">Salvar </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2" style="padding:1rem 1rem">
                                <button type="button" @click="status = 'adicionar'" v-if="status != 'adicionar'"  class="btn ml-1">Adicionar endereço</button>
                            </div>
                        </div>

                    </div>                    
                </div>
            </div>
        </div>
    </body>
    <script>
    let form = new FormData()
    const sessao = '?token=<?php echo md5(session_id()) ?>&'
        const vue = new Vue({
        el: '#main_area',
        data:{
            idx:null,
            id:null,
            info: <?php echo $user  ?>,
            status:'',
            //config:<?php #echo $config ?>,
            origin:'<?php echo  'https://www.localhost/Wa.Control/'; #ConfigPainel('base_url') ?>'
        },
        updated: function(){
            this.$nextTick(function(){
                window.parent.location.assign('javascript: new height('+document.getElementsByClassName("container")[0].scrollHeight+')')                
            }) 
        },
        methods:{
            add: function(){                
                let a = document.getElementById('estado').value
                let b = document.getElementById('cidade').value
                let c = document.getElementById('rua').value
                let d = document.getElementById('bairro').value
                let e = document.getElementById('numero').value
                let f = document.getElementById('cep').value
                this.info.endereco.push({ estado:a, cidade:b,  rua:c, bairro:d, numero:e, cep:f, padrao: false}) 
                new salvar(this.info.endereco.length -1 )
            },
            remove: function(i){
                //window.parent.location.assign('javascript:swal({  title: "Are you sure?",  text: "Once deleted, you will not be able to recover this imaginary file!",  icon: "warning",  buttons: true,  dangerMode: true,}).then((willDelete) => {  if (willDelete) {    swal("Poof! Your imaginary file has been deleted!", {      icon: "success",    });  } else {    swal("Your imaginary file is safe!");  }});')                
                window.parent.location.assign('javascript:swal("Tem certeza!!", "Deseja realmente deletar esse endereço ?", "warning",{buttons: true}).then((isConfirm)=>{if(isConfirm){document.getElementById("Eframe").src = "javascript:vue.info.endereco.splice('+i+', 1);new deletar()"}})')
            },
            atualiza: function(){
                for(let i= 0; i< document.querySelectorAll('input').length; i++){
                    form.append(document.querySelectorAll('input')[i].name, document.querySelectorAll('input')[i].value)
                }
                
                fetch(vue.origin+'wa/ecommerce/apis/perfil.php'+sessao,{
                    method:'POST',
                    body: form
                }).then(a=>a.text()).then(a=>{
                    a == 1?
                    window.parent.location.assign('javascript:swal("Salvo!!", "Informações pessoais salvas com sucesso", "success")'):
                    window.parent.location.assign('javascript:swal("ERRO!", "'+d+'", "error")'); 
                })
                
            }
        }
    })
    
    if(!Array.isArray(vue.info.endereco) && typeof(vue.info.endereco) != "string"){
        vue.info.endereco = []
    }else{
        vue.info.endereco = JSON.parse(vue.info.endereco)   
    }
    function salvar(i){
        if(document.getElementById("formCheckbox1").checked){          
            vue.info.endereco.filter((a,b)=>{
                
                if(b !=i){
                    a.padrao = false
                }else{
                    a.padrao = true
                    
                }
            })
        }
        form.append('endereco',JSON.stringify(vue.info.endereco))
        fetch(vue.origin+'wa/ecommerce/apis/endereco.php'+sessao,{
                method:'post',
                body: form
            }).then(d => d.text()).then(d=>{
                if(d == 1){
                    window.parent.location.assign('javascript:swal("Salvo!", "Alterações salvas com sucesso", "success")')
                }else{
                    window.parent.location.assign('javascript:swal("ERRO!", "'+d+'", "error")'); 
                }
            }) 
            vue.status = '' 
    }
    function deletar(){        
        form.append('endereco',JSON.stringify(vue.info.endereco))
        fetch(vue.origin+'wa/ecommerce/apis/endereco.php'+sessao,{
                method:'post',
                body: form
            }).then(d => d.text()).then(d=>{
                if(d == 1){
                    window.parent.location.assign('javascript:swal("Salvo!", "Alterações salvas com sucesso", "success")')
                }else{
                    window.parent.location.assign('javascript:swal("ERRO!", "'+d+'", "error")'); 
                }
            }) 
            vue.status = '' 
    }
    
    </script>
    <?php require_once('../../../../wa/'.$modulo .'/adm/login/src/script/wactrl.php') ?>   
<script src="src/script/main.js"></script>
</html>
<?php }else{ header('location:'.ConfigPainel('base_url').'wa/ecommerce/adm/login/index.php'); } ?>