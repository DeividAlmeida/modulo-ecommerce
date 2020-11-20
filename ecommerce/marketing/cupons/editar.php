<?php
if(!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'produto', 'editar')){ Redireciona('./index.php'); }
$id     = get('EditarCupom');
$query  = DBRead('ecommerce_cupom','*',"WHERE id = '{$id}'")[0];
?>

<form method="post" id="card" action="?EditCupom=<?php echo $id ?>" enctype="multipart/form-data">

</form>

<?php require("script.php"); ?>