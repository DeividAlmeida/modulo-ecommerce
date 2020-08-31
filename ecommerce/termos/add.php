<?php
  if(!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'termo', 'adicionar')){ Redireciona('./index.php'); }
?>

<form method="post" action="?AddTermo=<?php echo $_GET['AdicionarTermo'];?>">
  <div class="card">
    <div class="card-header white">
      <strong>Cadastrar Termo</strong>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">

          <!-- NOME -->
          <div class="form-group">
            <label>Nome: </label>
            <input class="form-control" name="nome" required>
          </div>

          <button class="btnSubmit btn btn-primary float-right" type="submit">Cadastrar</button>
        </div>
      </div>
    </div>
  </div>
</form>
