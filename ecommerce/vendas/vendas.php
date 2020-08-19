    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">


  <form id="pedidos" method="POST">
  <?php $query = DBRead('ecommerce_vendas', '*');?>
    <div class="card">
        <div class="card-header  white"> 
     
        <button id="showSelectedRows" class="btn btn-primary" type="submit"><i class="fa fa-trash"></i> Excluir em Massa</button>
       
        </div>
        <div class="card-body p-0">
                <div>
                    <table class="table m-0 table-striped BootstrapTable" id="BootstrapTable"    data-checkbox-header="true"  data-click-to-select="true"   data-id-field="id" data-select-item-name="id[]" data-maintain-meta-data="true"  data-show-refresh="true"  data-show-pagination-switch="true" data-detail-view="true"   data-detail-formatter="detailFormatter"  data-url="ecommerce/vendas/database.php" data-toggle="table" data-pagination="true" data-locale="pt-BR" data-cache="false" data-search="true" data-show-export="true" data-export-data-type="all" data-export-types="['csv', 'excel', 'pdf']" data-mobile-responsive="true" data-click-to-select="true" data-toolbar="#toolbar" data-show-columns="true" >
                       
      <thead>
    <tr>
        <th data-field="state" data-checkbox="true"></th>
        <th scope="col" data-field="id" data-sortable="true">Id do Pedido</th>
        <th scope="col" data-field="Comprador" data-sortable="true">Comprador</th>
        <th scope="col" data-field="Valor da venda" data-sortable="true">Valor da Venda</th>
        <th scope="col" data-field="Data" data-sortable="true">Data</th>
        <th scope="col" data-field="<i class='fa fa-pencil'></i>" data-sortable="true">Editar Pedito</th>
        
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
          <button id="showSelectedRows" class="btn btn-primary" type="submit"><i class="icon icon-floppy-o"></i>Salvar Mudanças</button>        
        </form>
      </div>          
          </div>          
        </div>
    </div>
  </div>
</div>
<script>
$('#showSelectedRows').click(function(){
  setImmediate(function refreshTable() {$table.bootstrapTable('refresh', {silent: false});});
  }
});
</script>