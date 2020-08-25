<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<?php  $status = DBRead('ecommerce_config_entrega','*',"WHERE id = '1'")[0];?>
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
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Correios </td>
                   <td><input type="checkbox" <?php print_r($status['entrega']); ?> onchange="entrega(document.getElementById('entrega').checked)" id="entrega"  name="entrega" data-toggle="toggle" data-style="slow" data-on="<i class='icon icon-check-square-o'></i>Ativo" data-off="<i class='icon icon-minus-square'></i>Inativo" data-onstyle="success" data-offstyle="danger"></td>
                </tr>
                <tr>
                    <td>Retirada na loja </td> 
                    <td><input type="checkbox" <?php print_r($status['retirada']); ?> onchange="retirada(document.getElementById('retirada').checked)" id="retirada" name="retirada"  data-toggle="toggle" data-style="slow" data-on="<i class='icon icon-check-square-o'></i>Ativo" data-off="<i class='icon icon-minus-square'></i>Inativo" data-onstyle="success" data-offstyle="danger"></td>               
                </tr>
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
        </form>
      </div>          
          </div>          
        </div>
    </div>
  </div>
</div>
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
</script>]
