<?php $query = DBRead('ecommerce_cupom','*'); ?>
<div class="card">
  <div class="card-header white">
    <strong>Cupom</strong>

    <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'produto', 'adicionar')) { ?>
      <a class="btn btn-sm btn-primary" href="?AdicionarCupom">Adicionar</a>
      <?php } ?>
  </div>

  <?php if (is_array($query)) {  ?>
    <div class="card-body p-0">
      <div>
        <div id="DataTable" >
          
        </div>
      </div>
    </div>
  <?php require("script.php"); } else { ?>
    <div class="card-body">
    <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'adicionar')) { ?>
      <div class="alert alert-info">Nenhum Cupom adicionado até o momento, <a href="?AdicionarCupom">clique aqui</a> para adicionar.</div>
      <?php } ?>
    </div>
  <?php } ?>
</div>
	