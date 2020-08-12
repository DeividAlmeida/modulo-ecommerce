<?php header('Access-Control-Allow-Origin: *');
  require_once('../../includes/funcoes.php');
  require_once('../../database/config.database.php');
  require_once('../../database/config.php');
  $id = 0;
  $id_produto = $_GET['radar'];
  $termos = DBRead('ecommerce_prod_termos','*',"WHERE id_produto = '{$id}' OR id_produto = '{$id_produto}'"); 
 ?>
<div class="card">
  <?php if (is_array($termos)) {  ?>
    <div class="card-body p-0">
      <div>
        <div>
          <table id="DataTable" class="table m-0 table-striped">
            <tr>
              <th>ID</th>
              <th>Nome</th>              
               <th>Valor agregado</th>
              <th width="53px">Ação</th>
              
            </tr>

            <?php foreach ($termos as $dados) { ?>
              <tr>
                
                <td><?php echo $dados['id']; ?></td>
                <?php $nomes = DBRead('ecommerce_termos','nome',"WHERE id = '{$dados['id_termo']}'");foreach ($nomes as $nome) { $nome =implode($nome) ?>
                  <td><?php echo $nome; ?></td>
               <?php } ?>               
                                
                <td><?php echo $dados['valor']; ?></td>
                
                
                  <td>
                    
                         
                            <button type="button" id="produto-rem-rv6wwqr92" class="produto-rem-form btn btn-sm btn-danger float-right"onclick="DeletarProdutoTermo<?php echo $dados['id']; ?>(this);" href="#!">Deletar</button>
                              <script>function DeletarProdutoTermo<?php echo $dados['id']; ?>(t){                    
                                        var xhttp = new XMLHttpRequest();                                        
                                        xhttp.open("GET", "<?php echo ConfigPainel('base_url'); ?>/controller/ecommerce/produtos.php?DeletarProdutoTermo=<?php echo $dados['id']; ?>", true);
                                        xhttp.send();setTimeout(function(){$("#no-d").load('<?php echo ConfigPainel('base_url'); ?>/ecommerce/produtos/processa_termos_listados.php?radar=<?php echo $_GET['radar']; ?>')}, 1000);
                                      }
                                </script>                         
                        
                      
                  </td>
                
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  <?php }?>
</div>
