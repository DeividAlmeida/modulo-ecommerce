<?php
  if(!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'marca', 'adicionar')){ Redireciona('./index.php'); }
?>

<form method="post" action="?AddMarca" enctype="multipart/form-data">
  <div class="card">
    <div class="card-header white">
      <strong>Cadastrar Marca</strong>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">

          <!-- NOME -->
          <div class="form-group">
            <label>Nome: </label>
            <input class="form-control" name="nome" required>
          </div>


          <!-- DESCRIÇÃO -->
          <div class="form-group">
            <label>Descrição:</label>
            <textarea class="form-control" name="descricao" required></textarea>
          </div>

           <!-- Imagem -->
              <div class="form-group">
                <label>Imagem:</label>
                <input class="form-control" type="file" multiple accept='image/*' name="imagem">
              </div>  

          <button class="btnSubmit btn btn-primary float-right" type="submit">Cadastrar</button>
        </div>
      </div>
    </div>
  </div>
</form>
