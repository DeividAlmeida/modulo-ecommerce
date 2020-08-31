<?php
if(!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'atributo', 'editar')){ Redireciona('./index.php'); }
$id     = get('EditarAtributo');
$query  = DBRead('ecommerce_atributos','*',"WHERE id = '{$id}'");
if (is_array($query)) {
  foreach ($query as $dados) { ?>
    <form method="post" action="?AtualizarAtributo=<?php echo $id; ?>">
      <div class="card">
        <div class="card-header  white">
          <strong>Editar Atributo</strong>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">

              <!-- NOME -->
              <div class="form-group">
                <label>Nome: </label>
                <input class="form-control" name="nome" required value="<?php echo $dados['nome'] ;?>">
              </div>


              <!-- DESCRIÇÃO -->
              <div class="form-group">
                <label>Descrição:</label>
                <textarea class="form-control" name="descricao" required><?php echo $dados['descricao'] ;?></textarea>
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
