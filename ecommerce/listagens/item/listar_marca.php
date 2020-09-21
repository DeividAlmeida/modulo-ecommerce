<?php
$id = get('VisualizarListaMarca');
$query = DBRead('ecommerce_lista_marca','*', "WHERE `id_lista` = $id");
?>

<div class="card">
  <div class="card-header white">
    <strong>Marcas da Listagem > #<?php echo $id ; ?></strong>
    <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'listagem', 'adicionar')) { ?>
      <a class="adicionarListagemItem tooltips" data-tooltip="Adicionar" href="#" data-href="ecommerce.php?AdicionarMarcaLista=<?php echo $id; ?>">
        <i class="icon-plus blue lighten-2 avatar"></i>
      </a>
      <?php } ?>
  </div>

  <?php if (is_array($query)) {  ?>
    <div class="card-body p-0">
      <div>
        <div>
          <table id="DataTable" class="table m-0 table-striped">
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <?php if (DadosSession('nivel') == 1) { ?>
              <th width="53px">Ações</th>
              <?php } ?>
            </tr>

            <?php foreach ($query as $dados) {
              $query = DBRead('ecommerce_marcas','*', "WHERE id = {$dados['id_marca']}");
              $marca = $query[0];
              ?>
              <tr>
                <td><?php echo $dados['id']; ?></td>
                <td><?php echo $marca['nome']; ?></td>
                <?php if (DadosSession('nivel') == 1) { ?>
                  <td>
                    <div class="dropdown">
                      <a class="" href="#" data-toggle="dropdown">
                        <i class="icon-apps blue lighten-2 avatar"></i>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                        <?php if ($dados['id'] != 0) { ?>
                          <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'listagem', 'deletar')) { ?>
                            <a class="dropdown-item" onclick="DeletarItem(<?php echo $dados['id']; ?>, 'DeletarmarcaLista');" href="#!"><i class="text-danger icon icon-remove"></i> Excluir</a>
                          <?php } ?>
                        <?php } ?>
                      </div>
                    </div>
                  </td>
                <?php } ?>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  <?php } else { ?>
    <div class="card-body">
    <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'listagem', 'adicionar')) { ?>
      <div class="alert alert-info">Nenhum marca a essa listagem adicionada até o momento, <a class="adicionarListagemItem" href="#" data-href="ecommerce.php?AdicionarMarcaLista=<?php echo $id ; ?>">clique aqui</a> para adicionar.</div>
      <?php } ?>
    </div>
  <?php } ?>
</div>
