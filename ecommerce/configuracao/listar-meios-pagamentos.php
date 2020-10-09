<?php
  
$statusp = DBRead('ecommerce_config_pagseguro','*',"WHERE id = '1'")[0];
$statusd = DBRead('ecommerce_config_deposito','*',"WHERE id = '1'")[0];
$plugins =  DBRead('ecommerce_plugins','*', "WHERE tipo = 'gateways'");
?>
<style>
  .slow  .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }</style>
<div class="card  white table-responsive">
    <div class="card-header white ">
    <strong>Meios de Pagamento</strong>
    </div>
    <div class="card-body white">  
        
        <table class="table table-hover table-striped">
            <thead style="font-weight: bold;">
                <tr >
                    <th style="font-weight: bold; font-size:16px;" scope="col">Tipo</th>
                    <th style="font-weight: bold; font-size:18px;" scope="col">Status</th>
                    <th style="font-weight: bold; font-size:18px;" scope="col"><center>Editar</center></th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                   <td>PagSeguro </td>
                   <td><input type="checkbox" <?php print_r($statusp['status']); ?> onchange="pagseguro(document.getElementById('pagseguro').checked)" id="pagseguro"  name="entrega" data-toggle="toggle" data-style="slow" data-on="<i class='icon icon-check-square-o'></i>Ativo" data-off="<i class='icon icon-minus-square'></i>Inativo" data-onstyle="success" data-offstyle="danger"></td>
                   <td><i class='fa fa-pencil'></i><center><a style='cursor:pointer' data-target='#Modal' data-toggle='modal' onclick="editp('pagseguro')"><i class='text-center text-primary icon icon-pencil' aria-hidden='true'></i></a></center></td>
                </tr>
                <tr>
                    <td>Depósito em conta </td> 
                    <td><input type="checkbox" <?php print_r($statusd['status']); ?> onchange="deposito(document.getElementById('deposito').checked)" id="deposito" name="deposito"  data-toggle="toggle" data-style="slow" data-on="<i class='icon icon-check-square-o'></i>Ativo" data-off="<i class='icon icon-minus-square'></i>Inativo" data-onstyle="success" data-offstyle="danger"></td>               
                    <td><i class='fa fa-pencil'></i><center><a style='cursor:pointer' data-target='#Modal2' data-toggle='modal' onclick="editd('deposito')"><i class='text-center text-primary icon icon-pencil' aria-hidden='true'></i></a></center></td>
                </tr>
                <?php if(!empty($plugins)){ foreach($plugins as $keyp => $plugin){ ?>
                  <tr>
                    <td><?php echo $plugin['titulo'] ?> </td>
                    <td><input type="checkbox" <?php print_r($plugin['status']); ?> onchange="plugin(document.getElementById('<?php print_r($plugin['nome']); ?>').checked, '<?php echo $plugin['nome']; ?>')" id="<?php echo $plugin['nome']; ?>" name="<?php echo $plugin['nome']; ?>"  data-toggle="toggle" data-style="slow" data-on="<i class='icon icon-check-square-o'></i>Ativo" data-off="<i class='icon icon-minus-square'></i>Inativo" data-onstyle="success" data-offstyle="danger"></td>               
                    <td><i class='fa fa-pencil'></i><center><a style='cursor:pointer' data-target="#Modal<?php echo $plugin['nome'];?>" data-toggle='modal' onclick="edita_plugin('<?php echo ConfigPainel('base_url').$plugin['path'].'/index.php'; ?>', '<?php echo $plugin['nome']?>')"><i class='text-center text-primary icon icon-pencil' aria-hidden='true'></i></a></center></td>
                </tr>
                <?php } }?>
            </tbody>        
        </table>
    </div>
</div>

<div class="modal fade"  id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div  class="modal-dialog  modal-lg" role="document">
        <div  class="modal-content">
            <div class="modal-content b-0">
                <div class="modal-header r-0 bg-primary">
                    <h3 class="modal-title text-white text-white" id="exampleModalLabel">Edite as Informações de Pagamento</h3>
                    <a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
                </div>
                <form id="mpag" method="POST" onsubmit="return false"> 
                    <div class="modal-body no-b" id="no-b">

                    </div>
                    <div class="modal-footer">
                        <button  class="btn btn-primary" id="btn_plugin" type="submit"><i class="icon icon-floppy-o"></i>Salvar Mudanças</button> 
                    </div>       
                </form>
            </div>          
        </div>          
    </div>
</div>
<span id="mod"></span>
</div>
</div>
</div>

<div class="modal fade"  id="Modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div  class="modal-dialog  modal-lg" role="document">
        <div  class="modal-content">
            <div class="modal-content b-0">
                <div class="modal-header r-0 bg-primary">
                <h3 class="modal-title text-white text-white" id="exampleModalLabel">Edite as Informações de Pagamento</h3>
                <a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
            </div>
            <form id="mdep" method="POST"> 
                <div class="modal-body no-c" id="no-c">
                </div>
                <div class="modal-footer">
                        <button  class="btn btn-primary" type="submit"><i class="icon icon-floppy-o"></i>Salvar Mudanças</button> 
                </div>       
            </form>
        </div>          
    </div>          
</div>

<script>
pagseguro = (a) => {
	var xhttp = new XMLHttpRequest();  
    xhttp.open("GET", "ecommerce.php?statusPagseguro="+a, true);
    xhttp.onload = () =>{swal("Status Atualizado!", "Status de pagamento com sucesso!", "success");}                                
    xhttp.send()
};

deposito = (a) => {
    var xhttp = new XMLHttpRequest();  
    xhttp.open("GET", "ecommerce.php?statusDeposito="+a, true);
    xhttp.onload = () =>{swal("Status Atualizado!", "Status de pagamento atualizado com sucesso!", "success");}                               
    xhttp.send()
};

plugin = (a, b) => {
    var request = new XMLHttpRequest();
    request.open('get', 'ecommerce.php?status'+b+'='+a, true );
    request.onload = () => {swal("Status Atualizado!", "Status de pagamento atualizado com sucesso!", "success");}
    request.send()
};

editp = (a) =>{
    $("#no-b").load('<?php echo ConfigPainel('base_url'); ?>ecommerce/configuracao/pagamento.php?tipo='+a);
}

editd = (a) =>{
    $("#no-c").load('<?php echo ConfigPainel('base_url'); ?>ecommerce/configuracao/pagamento.php?tipo='+a);
}

edita_plugin = (a, b) => {
    const modal ="<div class='modal fade'  id='Modal"+b+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'><div  class='modal-dialog  modal-lg' role='document'><div  class='modal-content'><div class='modal-content b-0'><div class='modal-header r-0 bg-primary'><h3 class='modal-title text-white text-white' id='exampleModalLabel'>Edite as Informações de Pagamento</h3><a href='#' data-dismiss='modal' aria-label='Close' class='paper-nav-toggle paper-nav-white active'><i></i></a></div> <div class='modal-body ' id='no-"+b+"'></div> </div>  </div>    </div> </div>";
document.getElementById('mod').innerHTML = modal;
    $("#no-"+b).load(a);
}
</script>
