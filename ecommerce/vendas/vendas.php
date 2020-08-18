<!doctype html>
<html lang="pt-br">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">
  </head>
  <body>

  <form id="pedidos" action="?deletarPedidos" method="POST">
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
        <th scope="col" data-field="id" data-sortable="true">Id da venda</th>
        <th scope="col" data-field="Comprador" data-sortable="true">Comprador</th>
        <th scope="col" data-field="Valor da venda" data-sortable="true">Valor da venda</th>
        <th scope="col" data-field="Data" data-sortable="true">Data</th>
    </tr>
      </thead>
      
    </table>
    </div>
    </div>
    </form>
    <script>
    
       
      function detailFormatter(index, row) { 
        var html = []
        $.each(row, function (key, value) {            
          html.push('<b>' + key + ':</b> ' + value + '<br>');          
        })        
        return html.join('');        
      }
           

        

        $('#pedidos').submit(function(e) {
            e.preventDefault();
            var $table = $('#BootstrapTable');
            var data = $(this).serializeArray();
            console.log(data);                      				
            swal({
                title: "Você tem certeza?",
                text: "Deseja realmente deletar o(s) pedido(s)?",
                type: "warning",
                buttons: {
                cancel: "Não",
                confirm: {
                    text: "Sim",
                    className: "btn-primary",
                },
                },
                closeOnCancel: false
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            data: data,
                            type: "POST",
                            cache: false,
                            url: "ecommerce.php?deletarPedidos", 
                            complete: function( data ){
                                swal("Deletados!", "Pedido(s) deletado(s).", "success");                                
                                setImmediate(function refreshTable() {$table.bootstrapTable('refresh', {silent: false});});
                                }
                                
                        });
                    } 
                    else {
                        swal("Cancelado", "Pedido(s) permanece(m) salvo(s)", "error");
                        setImmediate(function refreshTable() {$table.bootstrapTable('refresh', {silent: true});});
                    }  
                
                });        
            });
            $(document).ready(function() {
                $("#BootstrapTable").DataTable({
                    "language": {
                        "sEmptyTable": "Nenhum registro encontrado",
                        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sInfoThousands": ".",
                        "sLengthMenu": "Mostrar _MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sSearch": "Pesquisar",
                        "oPaginate": {
                            "sNext": "Próximo",
                            "sPrevious": "Anterior",
                            "sFirst": "Primeiro",
                            "sLast": "Último"
                        },
                    },
                });  
            });
               
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.js"></script>
    <script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/libs/FileSaver/FileSaver.min.js"></script>
    <script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/libs/js-xlsx/xlsx.core.min.js"></script>
    <script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/libs/jsPDF/jspdf.min.js"></script>
    <script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
    <script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/tableExport.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/export/bootstrap-table-export.min.js"></script>  
    <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table-locale-all.min.js"></script>
  </body>
</html>