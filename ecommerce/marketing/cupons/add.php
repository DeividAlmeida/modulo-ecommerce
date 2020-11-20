<?php
  if(!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'produto', 'adicionar')){ Redireciona('./index.php'); }
?>

<form method="post" id="card" action="?AddCupom" enctype="multipart/form-data">

</form>
<?php require("script.php"); ?>