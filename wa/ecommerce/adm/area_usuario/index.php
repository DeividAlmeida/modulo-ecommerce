<!DOCTYPE html>
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
    <body class="is-dropdn-click win no-loader" >
        <div class="page-content" id="main_area">
            <div class="holder mt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 aside aside--left">
                            <div class="list-group">
                                <a href="http://frontend.big-skins.com/goodwin-html-demo/account-history.html" class="list-group-item">Meus Pedidos</a> 
                                <a href="http://frontend.big-skins.com/goodwin-html-demo/account-addresses.html" class="list-group-item">Meu Endereço</a> 
                                <a href="http://frontend.big-skins.com/goodwin-html-demo/account-details.html" class="list-group-item active">Perfil</a> 
                                <a href="http://frontend.big-skins.com/goodwin-html-demo/account-details.html#" class="list-group-item">Sair</a>
                            </div>
                        </div>

                        <div class="col-md-9 aside">
                            <h2>Perfil</h2>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3>Informações Pessoais</h3>
                                            <p>
                                                <b>Nome:</b> Jenny<br>
                                                <b>Sobrenome:</b> Raider<br>
                                                <b>E-mail:</b> jennyraider@hotmail.com<br>
                                                <b>Telefone:</b> 876-432-4323
                                            </p>
                                            <div class="mt-2 clearfix">
                                                <a href="http://frontend.big-skins.com/goodwin-html-demo/account-details.html#" class="link-icn js-show-form" data-form="#updateDetails">
                                                <i class="icon-pencil"></i>Editar
                                            </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3 d-none" id="updateDetails">
                                <div class="card-body">
                                    <h3>Atualize os Detalhes de Sua Conta</h3>
                                    <div class="row mt-2">
                                        <div class="col-sm-6"><label class="text-uppercase">Nome:</label>
                                            <div class="form-group"><input type="text" class="form-control" placeholder="Jenny"></div>
                                        </div>
                                        <div class="col-sm-6"><label class="text-uppercase">Sobrenome:</label>
                                            <div class="form-group"><input type="text" class="form-control" placeholder="Raider"></div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-6"><label class="text-uppercase">E-mail:</label>
                                            <div class="form-group"><input type="email" class="form-control" placeholder="jennyraider@hotmail.com"></div>
                                        </div>
                                        <div class="col-sm-6"><label class="text-uppercase">Telefone:</label>
                                            <div class="form-group"><input type="text" class="form-control" placeholder="876-432-4323"></div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="reset" class="btn btn--alt js-close-form" data-form="#updateDetails">Cancelar</button> 
                                        <button type="submit" class="btn ml-1">Atualizar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 aside">
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

                        <div class="col-md-9 aside">
                            <h2>Meus Endereços</h2>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card">
                                            <div class="card-body">
                                                <h3>Endereço 1 (Padrão)</h3>
                                                <p>Thomas Nolan Kaszas<br>
                                                    5322 Otter Ln Middleberge<br>
                                                    FL 32068 Palm Bay FL 32907</p>
                                                <div class="mt-2 clearfix">
                                                    <a href="#" class="link-icn js-show-form" data-form="#updateAddress">
                                                    <i class="icon-pencil"></i>Editar
                                                </a> 
                                                <a href="#" class="link-icn ml-1 float-right">
                                                    <i class="icon-cross"></i>
                                                    Deletar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-2 mt-sm-0">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3>Endereço 2</h3>
                                            <p>Yuto Murase 42 1<br>
                                                Motohakone Hakonemaci Ashigarashimo<br>
                                                Gun Kanagawa 250 05 JAPAN
                                            </p>
                                            <div class="mt-2 clearfix">
                                                <a href="#" class="link-icn js-show-form" data-form="#updateAddress">
                                                    <i class="icon-pencil"></i>Editar
                                                </a> 
                                                <a href="#" class="link-icn ml-1 float-right">
                                                    <i class="icon-cross">                                                        
                                                    </i>Deletar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3 d-none" id="updateAddress">
                                <div class="card-body">
                                    <h3>Editar Endereço</h3>
                                    <label class="text-uppercase">Pais:</label>
                                    <div class="form-group select-wrapper">
                                        <select class="form-control">
                                            <option value="United States">United States</option>
                                            <option value="Canada">Canada</option>
                                            <option value="China">China</option>
                                            <option value="India">India</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Mexico">Mexico</option>
                                        </select>
                                    </div>
                                    <label class="text-uppercase">Estado:</label>
                                    <div class="form-group select-wrapper">
                                        <select class="form-control">
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="DC">District Of Columbia</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6"><label class="text-uppercase">Cidade:</label>
                                            <div class="form-group"><input type="text" class="form-control"></div>
                                        </div>
                                        <div class="col-sm-6"><label class="text-uppercase">CEP:</label>
                                            <div class="form-group"><input type="text" class="form-control"></div>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <input id="formCheckbox1" name="checkbox1" type="checkbox"> 
                                        <label for="formCheckbox1">Set address as default</label>
                                    </div>
                                    <div class="mt-2">
                                        <button type="reset" class="btn btn--alt js-close-form" data-form="#updateAddress">Cancel</button> 
                                        <button type="submit" class="btn ml-1">Add Address</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>                    
                </div>
            </div>
        </div>
    </body>
    <script>
        const vue = new Vue({
        el: '#main_area',
        data:{
            idx:'',
            //config:<?php #echo $config ?>,
            origin:'<?php echo ConfigPainel('base_url') ?>'
        },
        methods:{

        }
    })
    </script>
    <?php require_once('../../../../wa/'.$modulo .'/adm/login/src/script/wactrl.php') ?>   
<script src="src/script/main.js"></script>
</html>