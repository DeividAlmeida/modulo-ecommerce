<?php $query = DBRead('ecommerce_listas', '*'); ?>

<?php

$query = DBExecute('SELECT SUM(`view`) as views FROM `ecommerce`');
while ($row = mysqli_fetch_assoc($query)) {
  $contagem_visualizacoes = $row['views'];
}

$query = DBExecute('SELECT SUM(`count_add_cart`) as count FROM `ecommerce`');
while ($row = mysqli_fetch_assoc($query)) {
  $contagem_orcamentos = $row['count'];
}
$contagem_produtos        = DBCount('ecommerce', '*');
$contagem_categorias      = DBCount('ecommerce_categorias', '*');
$contagem_marcas          = DBCount('ecommerce_marcas', '*');
$contagem_atributos       = DBCount('ecommerce_atributos', '*');
$contagem_listagem        = DBCount('ecommerce_listas', '*');

$query = DBRead('ecommerce_listas', '*');
?>

<div class="animated fadeInUpShort mb-3">
  <div class="card">
    <div class="card-header white">
      <strong> Estatisticas </strong>
    </div>
    <div class="card-body p-0">
      <div class="lightSlider" data-item="6" data-item-xl="4" data-item-md="2" data-item-sm="1" data-pause="7000" data-pager="false" data-auto="true" data-loop="true">
        <div class="p-5">
          <h5 class="font-weight-normal s-14">Quant. Produtos</h5>
          <span class="s-48 font-weight-lighter light-green-text"><?php echo $contagem_produtos; ?></span>
        </div>
        <div class="p-5 light">
          <h5 class="font-weight-normal s-14">Quant. Categorias</h5>
          <span class="s-48 font-weight-lighter text-primary"><?php echo $contagem_categorias; ?></span>
        </div>
        <div class="p-5">
          <h5 class="font-weight-normal s-14">Quant. Marcas</h5>
          <span class="s-48 font-weight-lighter text-primary"><?php echo $contagem_marcas; ?></span>
        </div>
        <div class="p-5 light">
          <h5 class="font-weight-normal s-14">Quant. Atributos</h5>
          <span class="s-48 font-weight-lighter text-primary"><?php echo $contagem_atributos; ?></span>
        </div>
        <div class="p-5">
          <h5 class="font-weight-normal s-14">Quant. Listagens</h5>
          <span class="s-48 font-weight-lighter light-green-text"><?php echo $contagem_listagem; ?></span>
        </div>
        <div class="p-5 light">
          <h5 class="font-weight-normal s-14">Quant. Visualizações dos Produtos</h5>
          <span class="s-48 font-weight-lighter text-primary"><?php echo $contagem_visualizacoes; ?></span>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header white">
    <strong>Listagem</strong>
  </div>

  <?php if (is_array($query)) {  ?>
    <div class="card-body p-0">
      <div>
        <div>
          <table id="DataTable" class="table m-0 table-striped">
            <tr>
              <th>ID</th>
              <th>Título</th>
              <?php if (DadosSession('nivel') == 1) { ?>
                <th></th>
                <th>Implementação</th>
                <th width="53px">Ações</th>
              <?php } ?>
            </tr>

            <?php foreach ($query as $dados) {
              $CodSite  = '<div id="EcommerceListagem' . $dados['id'] . '" ></div>' . "\n";
              $CodSite .= '<script type="text/javascript">EcommerceListagem(' . $dados['id'] . ',1);</script>';
            ?>
              <tr>
                <td><?php echo $dados['id']; ?></td>
                <td><?php echo $dados['titulo']; ?></td>
                <?php if (DadosSession('nivel') == 1) { ?>
                  <td>
                    <?php if ($dados['tipo'] == '1') { ?>
                      <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'listagem', 'adicionar')) { ?>
                        <a class="adicionarListagemItem tooltips" data-tooltip="Adicionar" href="#" data-href='ecommerce.php?AdicionarItemLista=<?php echo $dados['tipo'];?>'>
                          <i class="icon-plus blue lighten-2 avatar"></i>
                        </a>
                      <?php } ?>

                      <a class="tooltips" data-tooltip="Visualizar" href="?VisualizarLista=<?php echo $dados['id']; ?>">
                        <i class="icon-eye blue lighten-2 avatar"></i>
                      </a>
                    <?php } ?>
                    <?php if ($dados['tipo'] == '5') { ?>
                      <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'listagem', 'adicionar')) { ?>
                        <a class="adicionarListagemItem tooltips" data-tooltip="Adicionar" href="#" data-href="ecommerce.php?AdicionarMarcaLista=<?php echo $dados['id']; ?>">
                          <i class="icon-plus blue lighten-2 avatar"></i>
                        </a>
                      <?php } ?>
                      <?php if ($dados['tipo'] == '5') { ?>
                      <a class="tooltips" data-tooltip="Visualizar" href="?VisualizarListaMarca=<?php echo $dados['id']; ?>">
                        <i class="icon-eye blue lighten-2 avatar"></i>
                      </a>
                    <?php }else{ ?>
                      <a class="tooltips" data-tooltip="Visualizar" href="?VisualizarLista=<?php echo $dados['id']; ?>">
                        <i class="icon-eye blue lighten-2 avatar"></i>
                      </a>
                    <?php }} ?>
                  </td>

                  <td>
                    <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'codigo', 'acessar')) { ?>
                      <button id="btnCopiarCodSite<?php echo $dados['id']; ?>" class="btn btn-primary btn-xs" onclick="CopiadoCodSite(<?php echo $dados['id']; ?>)" data-clipboard-text='<?php echo $CodSite; ?>'>
                        <i class="icon icon-code"></i> Copiar Cód. do Site
                      </button>
                    <?php } ?>
                  </td>
                  <td>
                    <div class="dropdown">
                      <a class="" href="#" data-toggle="dropdown">
                        <i class="icon-apps blue lighten-2 avatar"></i>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                        <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'listagem', 'editar')) { ?>
                          <a class="dropdown-item" href="?EditarLista=<?php echo $dados['id']; ?>"><i class="text-primary icon icon-pencil"></i> Editar</a>
                        <?php } ?>
                        <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'listagem', 'adicionar')) { ?>
                          <a class="dropdown-item" href="?DuplicarLista=<?php echo $dados['id']; ?>"><i class="text-primary icon icon-clone"></i> Duplicar</a>
                        <?php } ?>
                        <?php if ($dados['id'] != 0) { ?>
                          <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'listagem', 'deletar')) { ?>
                            <a class="dropdown-item" onclick="DeletarItem(<?php echo $dados['id']; ?>, 'DeletarLista');" href="#!"><i class="text-danger icon icon-remove"></i> Excluir</a>
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
      <div class="alert alert-info">Nenhum lista adicionada até o momento, <a href="?AdicionarLista">clique aqui</a> para adicionar.</div>
      <?php } ?>
    </div>
  <?php } ?>
</div>