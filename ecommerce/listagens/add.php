<?php
  if(!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'listagem', 'adicionar')){ Redireciona('./index.php'); }
?>
<form method="post" action="?AddLista">
  <div class="card">
    <div class="card-header  white">
      <strong>Cadastrar Lista</strong>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <!-- `titulo` varchar(255) NOT NULL -->
          <div class="form-group">
            <label>Titulo: </label>
            <input class="form-control" name="titulo" required>
          </div>

          <!-- `tipo` enum('1', '2', '3', '2') DEFAULT '1' -->
          <div class="form-group">
            <label>Tipo:</label>
            <select class="form-control custom-select" name="tipo">
              <option value="1" selected>Categoria</option>
              <option value="5">Marca</option>
              <option value="2">Mais Vistos</option>
              <option value="3">Mais Vendidos</option>
              <option value="4">Mais Recentes</option>
            </select>
          </div>

          <!-- `ordenar_por` varchar(255) NOT NULL -->
          <div class="form-group">
            <label>Ordernar por:</label>
            <select class="form-control custom-select" name="ordenar_por">
              <option value="id" selected>ID (Ordem de Criação)</option>
              <option value="nome">Nome</option>
              <option value="ordem_manual">Ordem Manual</option>
            </select>
          </div>

          <!-- `asc_desc` enum('ASC','DESC') NOT NULL DEFAULT 'ASC' -->
          <div class="form-group">
            <label>Ordem de Exibição:</label>
            <select class="form-control custom-select" name="asc_desc">
              <option value="ASC" selected>Crescente (Menor > Maior)</option>
              <option value="DESC">Decrescente (Maior > Menor)</option>
            </select>
          </div>

          <!-- `colunas` int(11) NOT NULL -->
          <div class="form-group">
            <label>Colunas:</label>
            <select class="form-control" name="colunas">
              <option value="2">Colunas 2</option>
              <option value="3">Colunas 3</option>
              <option value="4">Colunas 4</option>
            </select>
          </div>

          <!-- `mostrar_paginacao` enum('S', 'N') DEFAULT 'N' -->
          <div class="form-group">
            <label>Mostrar Paginação:</label>
            <select class="form-control custom-select" name="mostrar_paginacao">
              <option value="S">Sim</option>
              <option value="N" selected>Não</option>
            </select>
          </div>

          <!-- `mostrar_filtro` enum('S', 'N') DEFAULT 'N' -->
          <div class="form-group">
            <label>Mostrar Filtro:</label>
            <select class="form-control custom-select" name="mostrar_filtro">
              <option value="S" selected>Sim</option>
              <option value="N">Não</option>
            </select>
          </div>

          <!-- `paginacao` int(11) -->
          <div class="form-group">
            <label>Quantidade de produto por página: </label>
            <input class="form-control" name="paginacao" required type="number">
          </div>

          <!-- `carrocel` enum('S', 'N') DEFAULT 'N' -->
          <div class="form-group">
						<label>Carousel:</label>
						<select class="form-control custom-select" name="carrocel">
							<option value="S">Ativo</option>
							<option value="N" selected>Inativo</option>
						</select>
					</div>

          <div class="form-group <?php if (DadosSession('nivel') <> 1){ ?>hidden<?php } ?>">
            <label>Efeito de Entrada do Módulo:</label>
            <select name="efeito" required class="form-control custom-select">
              <option value="none">Nenhum</option>
              <option value="tc-animation-slide-top">Slide Top</option>
              <option value="tc-animation-slide-right">Slide Right</option>
              <option value="tc-animation-slide-bottom">Slide Bottom</option>
              <option value="tc-animation-slide-left">Slide Left</option>
              <option value="tc-animation-scale-up">Scale Up</option>
              <option value="tc-animation-scale-down">Scale Down</option>
              <option value="tc-animation-scale">Scale</option>
              <option value="tc-animation-shake">Shake</option>
              <option value="tc-animation-rotate">Rotate</option>
            </select>
          </div>

          <button class="btnSubmit btn btn-primary float-right" type="submit">Cadastrar</button>
        </div>
      </div>
    </div>
  </div>
</form>
