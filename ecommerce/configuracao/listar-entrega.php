<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<?php  $status = DBRead('ecommerce_config_entrega','*',"WHERE id = '1'")[0];?>
<style>
  .slow  .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }</style>
<div class="card  white table-responsive">
    <div class="card-header white d-flex justify-content-center">
        <a id="showSelectedRows" class="btn btn-primary" href="?editarEntrega" type="submit"><i class="icon icon-floppy-o"></i>Editar</a>
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
</script>