<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">




  <form id="pedidos" method="POST">
  <?php $query = DBRead('ecommerce_vendas', '*'); ?>
    <div class="card">
        <div class="card-header  white"> 
        <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'pedidos', 'deletar')) { ?>
        <button id="showSelectedRows" class="btn btn-primary" type="submit"><i class="fa fa-trash"></i> Excluir em Massa</button>
        <?php } ?>
        </div>
        <div class="card-body">
                <div>
                    <table class="table  table-striped BootstrapTable" id="BootstrapTable"    data-checkbox-header="true"  data-click-to-select="true"   data-id-field="id" data-select-item-name="id[]" data-maintain-meta-data="true"  data-show-refresh="true"  data-show-pagination-switch="true" data-detail-view="true"   data-detail-formatter="detailFormatter"  data-url="ecommerce/vendas/database.php" data-toggle="table" data-pagination="true" data-locale="pt-BR" data-cache="false" data-search="true" data-show-export="true" data-export-data-type="all" data-export-types="['csv', 'excel', 'pdf']" data-mobile-responsive="true" data-click-to-select="true" data-toolbar="#toolbar" data-show-columns="true" >
                       
      <thead >
    <tr >
        <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'pedidos', 'deletar')) { ?>
        <th data-field="state" data-checkbox="true"></th>
        <?php } ?>
        <th scope="col" data-field="<div class='card-header white' style='padding:0px'> DADOS DO PEDIDO ID" data-sortable="true" > <span style="font-weight: bold; font-size:16px;">Id do Pedido<span></th>
        <th scope="col" data-field="Comprador" data-sortable="true" > <span style="font-weight: bold; font-size:16px;">Comprador<span></th>
        <th scope="col" data-field="Valor da venda" data-sortable="true" ><span style="font-weight: bold; font-size:16px;">Valor da Venda<span></th>
        <th scope="col" data-field="Data do Pedido" data-sortable="true" ><span style="font-weight: bold; font-size:16px;">Data do Pedido<span></th>
        <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'pedidos', 'notificar')) { ?>
        <th scope="col" data-field="Status do Pedido" data-sortable="true"><span style="font-weight: bold; font-size:16px;">Status do Pedido<span></th>
        <?php } ?>
        <?php if(checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'pedidos', 'editar')) {?>
        <th scope="col" data-field="<i class='fa fa-pencil'></i>" data-sortable="true" ><span style="font-weight: bold; font-size:16px;">Editar Pedito<span></th>
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
            <h3 class="modal-title text-white text-white" id="exampleModalLabel">Edite o Pedido</h3>
            <a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
          </div>
          <form id="editarPedido" method="POST"> 
          <div class="modal-body no-b" id="no-b">

          </div>
          <div class="modal-footer">
          <button id="savet" class="btn btn-primary" type="submit"><i class="icon icon-floppy-o"></i>Salvar Mudanças</button>        
        </form>
      </div>          
          </div>          
        </div>
    </div>
  </div>
</div>
