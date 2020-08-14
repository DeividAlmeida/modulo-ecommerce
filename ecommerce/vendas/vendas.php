<!doctype html>
<html lang="pt-br">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   
    <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.js"></script>
    <script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/libs/FileSaver/FileSaver.min.js"></script>
    <script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/libs/js-xlsx/xlsx.core.min.js"></script>
    <script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/libs/jsPDF/jspdf.min.js"></script>
    <script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
    <script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>css_js/plugins/tableExport.jquery.plugin/tableExport.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/export/bootstrap-table-export.min.js"></script>  

    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">
  </head>
  <body>
  <?php $query = DBRead('ecommerce_vendas', '*');?>
    <div class="card">
        <div class="card-header  white"> 
        <div id="toolbar">
          <button id="showSelectedRows" class="btn btn-primary" type="button">Show Selected Rows</button>
        </div>
        </div>
        <div class="card-body p-0">
                <div>
                    <table class="table m-0 table-striped BootstrapTable" id="BootstrapTable" data-maintain-meta-data="true" data-custom-sort="customSort" data-show-refresh="true"  data-show-pagination-switch="true" data-detail-view="true"   data-detail-formatter="detailFormatter"  data-url="ecommerce/vendas/database.php" data-toggle="table" data-pagination="true" data-locale="pt-BR" data-cache="false" data-search="true" data-show-export="true" data-export-data-type="all" data-export-types="['csv', 'excel', 'pdf']" data-mobile-responsive="true" data-click-to-select="true" data-toolbar="#toolbar" data-show-columns="true" >
                       
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
    <script>
      function detailFormatter(index, row) {
        var html = []
        $.each(row, function (key, value) {
          html.push('<b>' + key + ':</b> ' + value + '<br>')
        })
        return html.join('')
      }
      function customSort(sortName, sortOrder, data) {
        var order = sortOrder === 'desc' ? -1 : 1
        data.sort(function (a, b) {
          var aa = +((a[sortName] + '').replace(/[^\d]/g, ''))
          var bb = +((b[sortName] + '').replace(/[^\d]/g, ''))
          if (aa < bb) {
            return order * -1
          }
          if (aa > bb) {
            return order
          }
          return 0
        })
      }
        var $table = $('#BootstrapTable');

          function getRowSelections() {
            return $.map($table.bootstrapTable('getSelections'), function(row) {
              return row;
            })
          }

          $('#showSelectedRows').click(function() {
            var selectedRows = getRowSelections();
            var selectedItems = '\n';
            $.each(selectedRows, function(index, value) {
              selectedItems += value.id + '\n';
            });

            alert('The following products are selected: ' + selectedItems);
          });
      
</script>
    
  </body>
</html>