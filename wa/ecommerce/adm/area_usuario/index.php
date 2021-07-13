<?php 
session_start();
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
if(isset($_SESSION['E-Wacontrol'])){
    $id = $_SESSION['E-Wacontrol'][0];
    $senha = $_SESSION['E-Wacontrol'][1];
}
else if(isset($_COOKIE['E-Wacontroltoken'])){
    $id =  $_COOKIE['E-Wacontrolid'];
    $senha =  $_COOKIE['E-Wacontroltoken'];
}
$valida = DBRead('ecommerce_usuario','*',"WHERE id = '{$id}' AND  senha = '{$senha}' ")[0];
$user = json_encode(DBRead('ecommerce_usuario','id, nome, sobrenome, pessoa, id_pessoa, telefone, email, endereco ',"WHERE id = '{$id}' AND  senha = '{$senha}' ")[0]);
 if($senha!= null && $valida['senha'] == $senha){
$um = '1';
$pedidos = json_encode(DBRead('ecommerce_vendas','*',"WHERE id_cliente = '{$id}' AND view NOT LIKE '%{$um}%'"));
$query = DBRead('ecommerce_config','*');

$config = [];
foreach ($query as $key => $row) {
  $config[$row['id']] = $row['valor'];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>wa/<?php echo $modulo ?>/adm/src/style/main.css">
        <?php require_once('../../../../wa/'.$modulo .'/adm/area_usuario/src/style/wactrl.php') ?>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        .senha-box{
            display:flex
        }
        </style>
</head>
    <body  class="is-dropdn-click win no-loader" >
        <div class="page-content" id="main_area">
            <div class="holder mt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 aside aside--left">
                            <div class="list-group">
                                <a href="javascript:void(0)" @click="idx = 'pedidos'; status = ''" :class="idx == 'pedidos' || idx == null?'list-group-item active':'list-group-item'">Meus Pedidos</a> 
                                <a href="javascript:void(0)" @click="idx = 'endereco'; status = ''" :class="idx == 'endereco'?'list-group-item active':'list-group-item'">Meu Endereço</a> 
                                <a href="javascript:void(0)" @click="idx = 'perfil'; status = ''" :class="idx == 'perfil'?'list-group-item active':'list-group-item'">Perfil</a> 
                                <a onclick="window.location.href =vue.origin+'wa/ecommerce/apis/logout.php?token=<?php echo md5(session_id()) ?>'" class="list-group-item">Sair</a>
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
                                                <b>{{info.pessoa == '1'? 'CPF': 'CNPJ'}}:</b> {{info.id_pessoa}}<br>
                                                <b>E-mail:</b> {{info.email}}<br>
                                                <b>Telefone:</b> {{info.telefone}}
                                            </p>
                                            <div class="mt-2 clearfix">
                                                <a href="javascript:void(0)" @click="status = 'editar'" class="ativo link-icn js-show-form" >
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
                                            <label class="text-uppercase">Pessoa:</label>
                                             <div class="form-group select-wrapper">
                                                <select class="form-control" id="pessoa" name="pessoa" v-model="info.pessoa">
                                                    <option value="1">Pessoa Física</option>
													<option value="2">Pessoa Jurídica</option>
                                                </select>
                                             </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="text-uppercase">CPF / CNPJ:</label>
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="id_pessoa" v-model="info.id_pessoa" :placeholder="info.id_pessoa">
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
                                <div class="card-body">
                                    <h3>Alterar Senha</h3>
                                    <div class="row mt-2">
                                        <div class="col-sm-6">
                                        <label class="text-uppercase">Senha Atual:</label>
                                            <div class="form-group senha-box">
                                                <input id="senha4" type="password" name="senha_atual" class="form-control senha" placeholder="Senha Atual">
                                                <a  style="position: relative;right: 9%;width: 0px;padding-top: 2%;" href="javascript:void(0)" @click="ver(4)"><i id="eye4" class="ativo fa fa-eye-slash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-6">
                                        <label class="text-uppercase">Nova Senha:</label>
                                            <div class="form-group senha-box">
                                                <input id="senha5" type="password" name="nova_senha" class="form-control senha" placeholder="Nova Senha">
                                                <a  style="position: relative;right: 9%;width: 0px;padding-top: 2%;" href="javascript:void(0)" @click="ver(5)"><i id="eye5" class="ativo fa fa-eye-slash"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="text-uppercase">Confirmar Senha:</label>
                                            <div class="form-group senha-box">
                                                <input id="senha6" type="password" class="form-control senha" placeholder="Confirmar Senha">
                                                <a  style="position: relative;right: 9%;width: 0px;padding-top: 2%;" href="javascript:void(0)" @click="ver(6)"><i id="eye6" class="ativo fa fa-eye-slash"></i></a>
                                            </div>
                                        </div>
                                        <div class="mt-2 clearfix">
                                            <button type="reset" @click="idx = 'perfil'; status = ''" class="btn btn--alt js-close-form" data-form="#updateDetails">Cancelar</button> 
                                            <button type="bottom" onclick="alterar()" class="btn ml-1">Atualizar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 aside" v-if="idx == 'pedidos' || idx == null">
                            <h2>Histórico de Pedidos</h2>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-order-history">
                                    <thead>
                                        <tr>
                                            <th scope="col"  class="esconder">#</th>
                                            <th scope="col" >Número do Pedido</th>
                                            <th scope="col"  class="esconder">Data do Pedido</th>
                                            <th scope="col"  class="esconder">Status</th>
                                            <th scope="col">Preço Total </th>
                                            <th scope="col">Ações </th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="pedido, p of pedidos">
                                        <tr >
                                            <td  class="esconder">{{p+1}}</td>
                                            <td><b>#{{pedido.id}}</b></td>
                                            <td  class="esconder">{{(new Date(pedido.data)).toISOString().match(/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}/)[0].split('-').reverse().join('/')}}</td>
                                            <td  class="esconder">{{pedido.status.replace('_',' ')}}</td>
                                            <td><span class="color">R$ {{pedido.valor.replace('.',',')+ " de "+qtd[p]+" produto(s)"}}</span></td>
                                            <td><button @click="detalhes(p)" type="button" :id="'btn'+p"  class="btn">VISUALIZAR</button></td>
                                        </tr>
                                        <tr style="display:none" :id="p">
                                            <td colspan="6" style="text-align: center">
                                                <h2>Detalhes do Pedido</h2><hr>
                                                <div  class="row">
                                                    <div class="col-md-6">
                                                        <b>PRODUTO</b>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <b>TOTAL</b>
                                                    </div>
                                                </div><hr>
                                                <div  class="row" v-for="produto, pp of pedido.produto">
                                                    <div class="col-md-6">
                                                        <span v-if="produto.produto_pg" v-html="produto.produto_pg"></span>
                                                        <span v-else v-html="produto.produto"></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        R$ {{(parseInt(produto.qtd)*parseFloat(produto.un_valor)).toFixed(2).replace('.',',')}}
                                                    </div>
                                                </div><hr>
                                                <div  class="row">
                                                    <div class="col-md-6">
                                                        <b>SUBTOTAL</b>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <b>R$ {{pedido.valor.replace('.',',')}}</b>
                                                    </div>
                                                </div><hr>
                                                <div  class="row">
                                                    <div class="col-md-6">
                                                        <b>MÉTODO DE PAGAMENTO</b>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <b>{{pedido.tipo_pagamento}}</b>
                                                    </div>
                                                </div><hr>
                                                <div  class="row">
                                                    <div class="col-md-6">
                                                        <b>TOTAL</b>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <b> R$ {{(parseFloat(pedido.valor)+parseFloat(pedido.vl_frete)).toFixed(2).replace('.',',')}}</b>
                                                    </div>
                                                </div><hr>
                                                <div  class="row ">
                                                    <div class="col-md-6">
                                                        <b>ENDEREÇO DE FATURAMENTO</b>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul style=" text-align: left;list-style-type: none;padding-left: 40%;">
                                                           <li>{{pedido.nome}}</li> 
                                                            <li>{{pedido.tipo_pessoa == '1'? 'CPF': 'CNPJ'}} : {{pedido.id_pessoa}}</li> 
                                                           <li>{{pedido.rua}}</li> 
                                                           <li>{{pedido.cidade}}</li> 
                                                           <li>{{pedido.estado}}</li> 
                                                            <li>{{pedido.telefone}}</li><br>
                                                           <li>{{pedido.email}}</li> 
                                                        </ul>
                                                    </div>
                                                </div><hr>
                                                <div  class="row justify-content-center">
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="input-group">
                                                            <div type="text" class="form-control" style="height:50%"><b>Cód. de rastreamento</b><br>{{pedido.rastreamento}}</div>
                                                            <button @click="copy(p)"  type="button"  class="btn input-group-text">
                                                                <i class="fa fa-files-o"></i>
                                                            <b :id="'copiado'+p" style="color:white">Copiar</b></button>
                                                        </div>
                                                    </div>
                                                    <input style=" position: absolute; top: -1000000000000px;" :id="'copy'+p" type="text" :value="pedido.rastreamento">
                                                </div><hr>
                                                <div  class="row justify-content-md-center">
                                                    <div class="col-12">
                                                        <div class="horizontal-timeline flex-row">
                                                            
                                                            <div v-if="statusp[p]!=0" :class="statusp[p]>=2? 'step completed':'step current'">
                                                                <div class="marker"></div>
                                                                Pagamento<br/>Aprovado
                                                            </div>
                                                            <div v-else class="step">
                                                                <div class="marker"></div>
                                                                Pagamento<br/>Aprovado
                                                            </div>
                                                            
                                                            <div v-if="statusp[p]<=1 " class="step">
                                                                <div class="marker"></div>
                                                                Enviado ao<br/>Transportador
                                                            </div>
                                                            <div v-else :class="statusp[p]>=3? 'step completed':'step current'">
                                                                <div class="marker"></div>
                                                                Enviado ao<br/>Transportador
                                                            </div>
                                                            
                                                            <div  :class="statusp[p]>2? 'step completed':'step'">
                                                                <div class="marker"></div>
                                                                Produto em<br/>Transporte 
                                                            </div>
                                                            <div v-if="statusp[p]>2" :class="statusp[p]==4? 'step completed':'step current'">
                                                                <div class="marker"></div>
                                                                Pedido<br/>Entregue
                                                            </div>
                                                            <div v-else class="step">
                                                                <div class="marker"></div>
                                                                Pedido<br/>Entregue
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" v-if="!pedidos" style="text-align: center">Não exitem pedidos no seu histórico...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-if="pedidos" class="text-right mt-2"><a onclick="limpar()" href="javascript:void(0)" class="btn btn--alt">Limpar Histórico</a></div>
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
                                                <a href="javascript: void(0)" @click="status = 'editar'; id=i" class="ativo link-icn js-show-form" data-form="#updateAddress">
                                                    <i class="icon-pencil"></i>Editar
                                                </a> 
                                                <a href="javascript: void(0)" @click="remove(i)" class="ativo link-icn ml-1 float-right">
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
            pedidos: <?php echo $pedidos  ?>,
            status:'',
            qtd:[],
            statusp:[],
            //config:<?php #echo $config ?>,
            origin:'<?php echo  ConfigPainel('base_url'); ?>'
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
            ver: function(n){
                let senha = document.getElementById('senha'+n)
                if(senha.type == 'password'){
                    senha.type = 'text'
                    document.getElementById('eye'+n).setAttribute('class','ativo fa fa-eye')
                }else{
                    senha.type = 'password'
                    document.getElementById('eye'+n).setAttribute('class','ativo fa fa-eye-slash')
                }
            },
            remove: function(i){
                window.parent.location.assign('javascript:swal("Tem certeza!!", "Deseja realmente deletar esse endereço ?", "warning",{buttons: true}).then((isConfirm)=>{if(isConfirm){document.getElementById("Eframe").src = "javascript:vue.info.endereco.splice('+i+', 1);new salvar()"}})')
            },
            atualiza: function(){
                 form.append(document.querySelectorAll('select')[0].name, document.querySelectorAll('select')[0].value)
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
                
            },
            detalhes: function(d){
                let row = document.getElementById(d)
                let btn = document.getElementById('btn'+d)
                if(row.style.display=="none"){
                   row.style.display = "" 
                   btn.innerText = 'VOLTAR'
                }else{
                    row.style.display = "none" 
                     btn.innerText = 'VISUALIZAR'
                }
                window.parent.location.assign('javascript: new height('+document.getElementsByClassName("container")[0].scrollHeight+')')
            },
             copy: function(i){
                var copyText = document.getElementById('copy'+i);
                document.getElementById('copiado'+i).innerText = 'copiado'
                  copyText.select();
                  copyText.setSelectionRange(0, 99999)
                  document.execCommand("copy");
            }
            
        }
    })
    
    if(!Array.isArray(vue.info.endereco) && typeof(vue.info.endereco) != "string"){
        vue.info.endereco = []
    }else{
        vue.info.endereco = JSON.parse(vue.info.endereco)   
    }
    
    function salvar(i){
        if(document.getElementById("formCheckbox1") != null  && document.getElementById("formCheckbox1").checked){          
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
    limpar = () =>{
        window.parent.location.assign('javascript:swal("Tem certeza!!", "Deseja realmente deletar esses pedidos do seu histórico ?", "warning",{buttons: true}).then((isConfirm)=>{if(isConfirm){fetch("'+vue.origin+'wa/ecommerce/apis/limpar.php'+sessao+'").then(a=>a.text()).then(a=>{if(a == 1){ swal("Deletado!!", "Histórico de pedidos deletados com sucesso", "success");document.getElementById("Eframe").src= "javascript:vue.pedidos = false"}else{ swal("ERRO!", a, "error")} }) }})')
    }
    for(let i = 0 ; i<vue.pedidos.length; i++){
        let soma  = 0
        vue.pedidos[i].produto = JSON.parse(vue.pedidos[i].produto);
        let cancelado = 0
        let reembolsado = 0
        let pagamento_pendente = 1
        let processando = 2
        let aguardando = 2
        let pedido_enviado = 3
        let concluido = 4
        Object.values(vue.pedidos[i].produto).find(a =>{
            
            soma +=parseInt(a.qtd)
            
        })
        if(vue.pedidos[i].status){
            vue.statusp.push(eval(vue.pedidos[i].status))
        }else{
            vue.statusp.push(0)
        }
        vue.qtd.push(soma)
    }
    function alterar(){
        let senha = document.getElementsByClassName('senha')
        let a  = senha[1].value.match(/[0-9]/)
        let b  = senha[1].value.match(/[A-Z]/)
        let c = senha[1].value.length > 5
        if(!a || !b || !c){
                window.parent.location.assign('javascript:swal({title:"Senha muito fraca!",html:true, text:"Critérios mínimos: \n 1° Uma letra maiúscula \n 2° Um número \n 3° mais de 5 dígitos.", icon:"error"})');
        }else if(senha[1].value != senha[2].value){
                window.parent.location.assign('javascript:swal("ERRO","Senha incorreta","error")')
        }else{
            for(let i = 0; i < 2; i++){
                form.append(senha[i].name, senha[i].value)
            }
            fetch(vue.origin+'wa/ecommerce/apis/senha.php'+sessao,{
                method:"post",
                body:form
            }).then(a => a.text()).then(data=>{
                if(data == 1){
                    window.parent.location.assign('javascript:swal("Salvo!", "Senha alterada com sucesso", "success")')
                   
                }else{
                    window.parent.location.assign('javascript: swal("ERRO","'+data+'","error")')}
            })
        }
    }
    
    </script>
    <?php require_once('../../../../wa/'.$modulo .'/adm/login/src/script/wactrl.php') ?>   
<script src="src/script/main.js"></script>
</html>
<?php }else{ header('location:'.ConfigPainel('base_url').'wa/ecommerce/adm/login/index.php'); } ?>