<?php
session_start();
header('Content-Type: application/json');
require('../../database/config.php');
require('../../database/config.database.php');
require_once('../../includes/funcoes.php');
require('ssp.class.php');


$sql_details = array(
  'user' => DB_USERNAME,
  'pass' => DB_PASSWORD,
  'db'   => DB_DATABASE,
  'host' => DB_HOSTNAME
);
$table        = 'ecommerce';
$primaryKey   = 'id';
$columns      = array(
  array(
    'db' => 'id',
    'dt' => 0,
    'formatter' => function ($id, $row) {
      ob_start();
?>
  <input class="checkBoxClass" type="checkbox" name="ids[]" value="<?php echo $id; ?>" />
<?php
      return ob_get_clean();
    }
  ),
  array(
    'db' => 'id',
    'dt' => 1
  ),
  array(
    'db' => 'id_imagem_capa',
    'dt' => 2,
    'formatter' => function ($id_imagem_capa, $row) {
      $query_foto = DBRead('ecommerce_prod_imagens', '*', "WHERE id = '{$id_imagem_capa}'");
      $id_foto    = $query_foto[0]['uniq'];
      ob_start();
?>
  <img src="wa/ecommerce/uploads/<?php echo $id_foto; ?>" width="100">
<?php
      return ob_get_clean();
    }
  ),
  array(
    'db' => 'nome',
    'dt' => 3
  ),
  array(
    'db' => 'id',
    'dt' => 4,
    'formatter' => function ($id, $row) {
      ob_start();
      $PERMISSION = GetPermissionsUser();
?>
  <div class="dropdown">
    <a class="" href="#" data-toggle="dropdown">
      <i class="icon-apps blue lighten-2 avatar"></i>
    </a>

    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
      <?php if (checkPermission($PERMISSION, 'ecommerce', 'produto', 'editar')) { ?>
        <a class="dropdown-item" href="?EditarProduto=<?php echo $id; ?>"><i class="text-primary icon icon-pencil"></i> Editar</a>
      <?php } ?>
      <?php if (checkPermission($PERMISSION, 'ecommerce', 'produto', 'adicionar')) { ?>
        <a class="dropdown-item" href="?DuplicarProduto=<?php echo $id; ?>"><i class="text-primary icon icon-clone"></i> Duplicar</a>
      <?php } ?>
      <?php if ($id != 0) { ?>
        <?php if (checkPermission($PERMISSION, 'ecommerce', 'produto', 'deletar')) { ?>
          <a class="dropdown-item" onclick="DeletarItem(<?php echo $id; ?>, 'DeletarProduto');" href="#!"><i class="text-danger icon icon-remove"></i> Excluir</a>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
<?php
      return ob_get_clean();
    }
  )
);

$response = SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);

echo json_encode($response);
