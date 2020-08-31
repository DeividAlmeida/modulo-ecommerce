<?php
if(!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'termo', 'editar')){ Redireciona('./index.php'); }
$id     = get('EditarTermo');
$query  = DBRead('ecommerce_termos','*',"WHERE id = '{$id}'");
if (is_array($query)) {
  foreach ($query as $dados) { ?>
    <form method="post" action="?AtualizarTermo=<?php echo $id; ?>">
      <div class="card">
        <div class="card-header  white">
          <strong>Editar Termo</strong>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">

              <!-- NOME -->
              <div class="form-group">
                <label>Nome: </label>
                <input class="form-control" name="nome" required value="<?php echo $dados['nome'] ;?>">
              </div>

              <button class="btnSubmit btn btn-primary float-right" type="submit">Atualizar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  <?php
  }
}
?>
