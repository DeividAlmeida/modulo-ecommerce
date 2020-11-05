<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<?php 
 $status = DBRead('ecommerce_config_entrega','*',"WHERE id = '1'")[0];
 $plugins =  DBRead('ecommerce_plugins','*', "WHERE tipo = 'delivery'");
 
 ?>
<style>
  .slow  .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }</style>
<div class="card  white table-responsive">
    <div class="card-header white d-flex justify-content-center">
        <a id="showSelectedRows" onclick="edit()" class="btn btn-primary" data-target='#Modal' data-toggle='modal'><i class="icon icon-floppy-o"></i>Editar</a>
    </div>
    <div class="card-body white">  
        <strong>Tipos de entrega</strong>
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
                    <td>Correios </td>
                   <td><input type="checkbox" <?php print_r($status['entrega']); ?> onchange="entrega(document.getElementById('entrega').checked)" id="entrega"  name="entrega" data-toggle="toggle" data-style="slow" data-on="<i class='icon icon-check-square-o'></i>Ativo" data-off="<i class='icon icon-minus-square'></i>Inativo" data-onstyle="success" data-offstyle="danger"></td>
                   <td></td>
                </tr>
                <tr>
                    <td>Retirada na loja </td> 
                    <td><input type="checkbox" <?php print_r($status['retirada']); ?> onchange="retirada(document.getElementById('retirada').checked)" id="retirada" name="retirada"  data-toggle="toggle" data-style="slow" data-on="<i class='icon icon-check-square-o'></i>Ativo" data-off="<i class='icon icon-minus-square'></i>Inativo" data-onstyle="success" data-offstyle="danger"></td>               
                    <td></td>
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
                    <h3 class="modal-title text-white text-white" id="exampleModalLabel">Edite as Informações de Entrega</h3>
                    <a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
                </div>
                <form id="entregar" method="POST"> 
                    <div class="modal-body no-b" id="no-b">
                    </div>
                    <div class="modal-footer">
                        <button  class="btn btn-primary" id="wait" type="submit"><i class="icon icon-floppy-o"></i>Salvar Mudanças</button>        
                    </div>
                </form>
            </div>          
        </div>          
    </div>
</div>
<span id="mod"></span>
<script>
retirada = (a) => {
	var xhttp = new XMLHttpRequest();  
    xhttp.open("GET", "ecommerce.php?statusRetirada="+a, true);
    xhttp.onload = () =>{swal("Status Atualizado!", "Status de retirada na loja atualizado com sucesso!", "success");}                                
    xhttp.send()
};

entrega = (a) => {
    var xhttp = new XMLHttpRequest();  
    xhttp.open("GET", "ecommerce.php?statusEntrega="+a, true);
    xhttp.onload = () =>{swal("Status Atualizado!", "Status de entrega pelos correios atualizado com sucesso!", "success");}                               
    xhttp.send()
};


function edit(){
    $("#no-b").load('<?php echo ConfigPainel('base_url'); ?>ecommerce/configuracao/entrega.php');
}

plugin = (a, b) => {
    var request = new XMLHttpRequest();
    request.open('get', 'ecommerce.php?status'+b+'='+a, true );
    request.onload = () => {swal("Status Atualizado!", "Status de pagamento atualizado com sucesso!", "success");}
    request.send()
};

edita_plugin = (a, b) => {
    const modal ="<div class='modal fade'  id='Modal"+b+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'><div  class='modal-dialog  modal-lg' role='document'><div  class='modal-content'><div class='modal-content b-0'><div class='modal-header r-0 bg-primary'><h3 class='modal-title text-white text-white' id='exampleModalLabel'>Edite as Informações de Entrega</h3><a href='#' data-dismiss='modal' aria-label='Close' class='paper-nav-toggle paper-nav-white active'><i></i></a></div> <div class='modal-body ' id='no-"+b+"'></div><div class='modal-footer'><button class='btn btn-primary' type='submit' onclick='post()'><i class='icon icon-floppy-o'></i>Salvar Mudanças</button></div> </div>  </div>    </div> </div>";
document.getElementById('mod').innerHTML = modal;
    $("#no-"+b).load(a);
}
</script>

