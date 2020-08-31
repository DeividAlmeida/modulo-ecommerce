<?php $query = DBRead('ecommerce_marcas','*'); ?>

<div class="card">
  <div class="card-header white">
    <strong>Marca</strong>

    <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'marca', 'adicionar')) { ?>
      <a class="btn btn-sm btn-primary" href="?AdicionarMarca">Adicionar</a>
      <?php } ?>
  </div>

  <?php if (is_array($query)) {  ?>
    <div class="card-body p-0">
      <div>
        <div>
          <table id="DataTable" class="table m-0 table-striped">
            <tr>
              <th>ID</th>
              <th>Imagem</th>
              <th>Nome</th>
              <?php if (DadosSession('nivel') == 1) { ?>
              <th width="53px">Ações</th>
              <?php } ?>
            </tr>

            <?php foreach ($query as $dados) { ?>
              <tr>
                <td><?php echo $dados['id']; ?></td>
                <td><img src="wa/ecommerce/uploads/<?php echo $dados['imagem']; ?>" style="width: 100px;"></td>
                <td><?php echo $dados['nome']; ?></td>
                <?php if (DadosSession('nivel') == 1) { ?>
                  <td>
                    <div class="dropdown">
                      <a class="" href="#" data-toggle="dropdown">
                        <i class="icon-apps blue lighten-2 avatar"></i>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                      <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'marca', 'editar')) { ?>
                        <a class="dropdown-item" href="?EditarMarca=<?php echo $dados['id']; ?>"><i class="text-primary icon icon-pencil"></i> Editar</a>
                        <?php } ?>

                        <?php if ($dados['id'] != 0) { ?>
                          <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'marca', 'deletar')) { ?>
                            <a class="dropdown-item" onclick="DeletarItem(<?php echo $dados['id']; ?>, 'DeletarMarca');" href="#!"><i class="text-danger icon icon-remove"></i> Excluir</a>
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
    <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'adicionar')) { ?>
      <div class="alert alert-info">Nenhuma marca adicionada até o momento, <a href="?AdicionarMarca">clique aqui</a> para adicionar.</div>
      <?php } ?>
    </div>
  <?php } ?>
</div>
