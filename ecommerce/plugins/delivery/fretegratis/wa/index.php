<?php 
header("Access-Control-Allow-Origin: *");
require_once("../../../../../includes/funcoes.php");
require_once("../../../../../database/config.database.php");
require_once("../../../../../database/config.php");
$read =  DBRead("ecommerce_fretegratis","*")[0];
if($_GET['valorcarrinho']>= $read['valor']){
?>
<label for="fretegratis" id="tototin" style="cursor:pointer; margin-left:10px;">
<input type="radio" onchange="D4(0.00)" style="cursor:pointer;white-space: nowrap" name="frete" id="fretegratis" value="00,00"> <b>Frete Grátis</b><br> <?php echo $read['descricao'] ?>
</label>
<?php } ?>
