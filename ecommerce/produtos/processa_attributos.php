<?php header('Access-Control-Allow-Origin: *');
  require_once('../../includes/funcoes.php');
  require_once('../../database/config.database.php');
  require_once('../../database/config.php');
  $query  = DBRead('ecommerce_atributos','*')?>


          <div class="form-group">
            <label>Atributo:</label>
            <select name="atb" required class="form-control custom-select" id="mySelect" onchange="myFunction()">
              <option default> Selecione o Atributo</option>
              <?php foreach ($query as $key => $value) {
                 ?>
                <option value="<?php echo $value['id']; ?>" ><?php echo $value['nome']; ?></option>
              <?php } ?>              
            </select>
          </div>
          <p id="demo"></p>
<script type="text/javascript">
    function myFunction() {
  var x = document.getElementById("mySelect").value;
 $("#no-c").load("<?php echo ConfigPainel('base_url'); ?>/ecommerce/produtos/processa_termos.php?radar=<?php echo $_GET['radar']; ?>&id=" + x);}
   
</script>
