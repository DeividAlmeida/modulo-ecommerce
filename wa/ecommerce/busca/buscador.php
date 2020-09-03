<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');

$query = DBRead('ecommerce_config','*');

$config = [];
foreach ($query as $key => $row) {
  $config[$row['id']] = $row['valor'];
}

switch ($config['busca_btn_tamanho']) {
  case 'pequeno':
    $tamanho_barra = 'input-group-sm';
    break;

  case 'normal':
    $tamanho_barra = 'input-group-large';
    break;

  case 'grande':
    $tamanho_barra = 'input-group-extra-large';
    break;

  default:
    $tamanho_barra = 'input-group-large';
    break;
}
?>
<style>
.add-on .input-group-btn > .btn {
  border-left-width:0;left:-2px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}
/* stop the glowing blue shadow */
.add-on .form-control:focus {
 box-shadow:none;
 -webkit-box-shadow:none;
 border-color:#cccccc;
}
.input-group-extra-large>.form-control, .input-group-extra-large>.input-group-addon, .input-group-extra-large>.input-group-btn>.btn {
  height: 60px;
  padding: 10px 16px;
  font-size: 20px;
  line-height: 1.3333333;
  border-radius: 6px;
}

.shop--search-bar .btn{
  background-color: <?php echo $config['busca_btn_cor']; ?> !important;
  color: <?php echo $config['busca_btn_cor_texto']; ?> !important;
}
.shop--search-bar .btn:hover{
  background-color: <?php echo $config['busca_btn_cor_hover']; ?> !important;
}
</style>
<meta charset="UTF-8">
<form class="shop--search-bar" action="<?php echo $config['pagina_resultado_busca']; ?>" method="get" role="form">
  <div class="input-group <?php echo $tamanho_barra; ?> add-on">
    <input type="text" name="b" class="form-control" placeholder="Pesquisar Produtos">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit">
        <?php if($config['busca_btn_tipo'] == 'ambos') { ?>
          <i class="fa fa-search"></i>
          Procurar
        <?php } else if($config['busca_btn_tipo'] == 'texto'){ ?>
          Procurar
        <?php } else { ?>
          <i class="fa fa-search"></i>
        <?php } ?>
      </button>
    </div>
  </div>
</form>
