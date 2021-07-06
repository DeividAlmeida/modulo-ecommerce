<?php 
if (isset($_GET['editarCliente'])) {
    $senha =  md5(post('senha'));
    $compatibilidade = DBRead("ecommerce_usuario","*","WHERE id = '{$_POST['id']}'")[0];
    if($compatibilidade['senha'] == $_POST['senha']){$senha = $compatibilidade['senha'];}
    $data = array(
            'nome'          => post('nome'),
             'sobrenome'          => post('sobrenome'),
            'telefone'      => post('telefone'),
            'email'         =>post('email'),
            'endereco'         =>$_POST['endereco'],
            'senha'         =>$senha
        );
  
        $query  = DBUpdate('ecommerce_usuario', $data, "id = {$_POST['id']}");  
            if ($query != 0) {
                Redireciona('?Clientes&sucesso');
            } else {
                Redireciona('?Clientes&erro');
            }
}
if (isset($_GET['deletarCliente'])) {
    $id     = $_POST;
    foreach($_POST['id'] as $no => $post){
        $query  = DBDelete('ecommerce_usuario',"id = '{$post}'");
    }
}
?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>



  <form id="clientes" method="POST">
  <?php $query = DBRead('ecommerce_usuario', '*'); ?>
    <div class="card">
        <div class="card-header  white"> 
        <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'pedidos', 'deletar')) { ?>
        <button id="showSelectedRows" class="btn btn-primary" type="submit"><i class="fa fa-trash"></i> Excluir em Massa</button>
        <?php } ?>
        </div>
        <div class="card-body">
                <div>
                    <table class="table  table-striped BootstrapTable" id="BootstrapTable"    data-checkbox-header="true"  data-click-to-select="true"   data-id-field="id" data-select-item-name="id[]" data-maintain-meta-data="true"  data-show-refresh="true"  data-show-pagination-switch="true" data-detail-view="true"   data-detail-formatter="detailFormatter"  data-url="ecommerce/clientes/database.php" data-toggle="table" data-pagination="true" data-locale="pt-BR" data-cache="false" data-search="true" data-show-export="true" data-export-data-type="all" data-export-types="['csv', 'excel', 'pdf']" data-mobile-responsive="true" data-click-to-select="true" data-toolbar="#toolbar" data-show-columns="true" >
                       
      <thead >
    <tr >
        <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'pedidos', 'deletar')) { ?>
        <th data-field="state" data-checkbox="true"></th>
        <?php } ?>
        <th scope="col" data-field="id" data-sortable="true" > <span style="font-weight: bold; font-size:16px;">ID<span></th>
        <th scope="col" data-field="nome" data-sortable="true" > <span style="font-weight: bold; font-size:16px;">Nome<span></th>
        <th scope="col" data-field="email" data-sortable="true" ><span style="font-weight: bold; font-size:16px;">E-mail<span></th>
        <th scope="col" data-field="telefone" data-sortable="true" ><span style="font-weight: bold; font-size:16px;">Telefone<span></th>
        <?php if(checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'pedidos', 'editar')) {?>
        <th scope="col" data-field="<i class='fa fa-pencil'></i>" data-sortable="true" ><span style="font-weight: bold; font-size:16px;">Editar Informações<span></th>
        <?php } ?>
    </tr>
      </thead>
      
    </table>
    </div>
    </div>
    </form>

    <div class="modal fade"  id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div  class="modal-dialog  modal-lg" role="document">
            <div  class="modal-content">
                <div class="modal-content b-0">
                    <div class="modal-header r-0 bg-primary">
                        <h3 class="modal-title text-white text-white" id="exampleModalLabel">Edite Informações do Cliente</h3>
                        <a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
                    </div>
                    <form id="editarCliente" action="?editarCliente&Clientes" method="POST"> 
                        <div class="modal-body no-b" id="no-b">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nome: </label>
                                        <input id="nome" class="form-control" name="nome">
                                    </div>
                                    <div class="form-group">
                                        <label>Sobrenome: </label>
                                        <input id="sobrenome" class="form-control" name="sobrenome">
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail: </label>
                                        <input id="email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telefone: </label>
                                        <input id="telefone" class="form-control" name="telefone">
                                    </div>
                                    <div class="form-group">
                                        <label>Senha: </label>
                                        <input id="senha" class="form-control" name="senha">
                                        <small> <i class="icon icon-lock" aria-hidden="true"></i> Senha criptografada</small> 
                                    </div>
                                </div>
                                <input type="hidden" id="id" name="id">
                                <input type="hidden" id="endereco" name="endereco">
                            </div>
                            <br>
                            <hr>
                            <div class="input-group-append">
                                <button @click="add()" style="min-width: 2.5rem" class="btn btn-primary"   type="button">
                                    <strong>+</strong>
                                </button>
                            </div>
                            <div class="row" v-for="endereco, i of enderecos" style="margin-top:35px">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="button" @click="remove(i)" class="btn btn-danger btnRemove float-right" style="margin-left:5px"><i class="icon-trash"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Estado: </label>
                                        <select class="form-control" id="estado" v-model="endereco.estado">
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
                                    <div class="form-group">
                                        <label>Cidade: </label>
                                        <input id="cidade" class="form-control" name="cidade" v-model="endereco.cidade">
                                    </div>
                                    <div class="form-group">
                                        <label>Bairro: </label>
                                        <input id="bairro" class="form-control" name="bairro" v-model="endereco.bairro">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>CEP: </label>
                                        <input id="cep" class="form-control" name="cep" v-model="endereco.cep">
                                    </div>
                                    <div class="form-group">
                                        <label>Rua: </label>
                                        <input id="rua" class="form-control" name="rua" v-model="endereco.rua">
                                    </div>
                                    <div class="form-group">
                                        <label>Número: </label>
                                        <input id="numero" class="form-control" name="numero" v-model="endereco.numero">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="savet" class="btn btn-primary" type="submit">
                                <i class="icon icon-floppy-o"></i>Salvar Mudanças
                            </button>  
                        </div>
                    </form>
                </div>          
            </div>            
        </div>
    </div>
  </div>
</div>
<script>
    function find(i){
        fetch('ecommerce/clientes/database.php').then(a=> a.json()).then(dados =>{
            dados.find(a=>{
                if(a.id == i){
                    document.getElementById('nome').value = a.fristname
                    document.getElementById('sobrenome').value = a.lastname
                    document.getElementById('email').value = a.email
                    document.getElementById('telefone').value = a.telefone
                    document.getElementById('senha').value = a.senha
                    document.getElementById('id').value = a.id
                    vue.enderecos = JSON.parse(a.endereco)
                }
            })
        })
    }
    const vue = new Vue({
        el: '#editarCliente',
        data:{
           enderecos:[],
        },
        updated: function(){
            this.$nextTick(function(){
                document.getElementById('endereco').value = JSON.stringify(this.enderecos)
            })
        },
        methods: {
            add: function(){     
                this.enderecos.push({"estado":"","cidade":"","rua":"","bairro":"","numero":"","cep":"","padrao":false})
            },
            remove: function(index){
                this.enderecos.splice(index, 1)
            }, 
        }
    })
</script>
