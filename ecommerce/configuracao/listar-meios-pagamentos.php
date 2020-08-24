<?php
  
$statusp = DBRead('ecommerce_config_pagseguro','*',"WHERE id = '1'")[0];
$statusd = DBRead('ecommerce_config_deposito','*',"WHERE id = '1'")[0];
?>
<style>
  .slow  .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }</style>
<div class="card  white table-responsive">
    <div class="card-header white ">
    <strong>Tipos de entrega</strong>
    </div>
    <div class="card-body white">  
        
        <table class="table table-hover table-striped">
            <thead style="font-weight: bold;">
                <tr >
                    <th style="font-weight: bold; font-size:16px;" scope="col">Tipo</th>
                    <th style="font-weight: bold; font-size:18px;" scope="col">Status</th>
                    <th style="font-weight: bold; font-size:18px;" scope="col">Editar</th>
                    
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
          <form id="mpag" method="POST"> 
          <div class="modal-body no-b" id="no-b">

          </div>
          <div class="modal-footer">
          <button  class="btn btn-primary" type="submit"><i class="icon icon-floppy-o"></i>Salvar Mudanças</button>        
        </form>
      </div>          
          </div>          
        </div>
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
        </form>
      </div>          
          </div>          
        </div>
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

editp = (a) =>{
    $("#no-b").load('<?php echo ConfigPainel('base_url'); ?>ecommerce/configuracao/pagamento.php?tipo='+a);
}

editd = (a) =>{
    $("#no-c").load('<?php echo ConfigPainel('base_url'); ?>ecommerce/configuracao/pagamento.php?tipo='+a);
}
</script>
