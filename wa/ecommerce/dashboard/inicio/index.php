<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../../includes/funcoes.php');
require_once('../../../../database/config.database.php');
require_once('../../../../database/config.php');
session_start();
if(isset($_SESSION['Wacontrol'])){
    $id = $_SESSION['Wacontrol'][0];
    $senha = $_SESSION['Wacontrol'][1];
}
else if(isset($_COOKIE['Wacontroltoken'])){
    $id =  $_COOKIE['Wacontrolid'];
    $senha =  $_COOKIE['Wacontroltoken'];
}
$valida = DBRead('ecommerce_usuario','*',"WHERE id = '{$id}' AND  senha = '{$senha}' ")[0];
 if($senha!= null && $valida['senha'] == $senha){
$query = DBRead('ecommerce_config','*');
$wacr = [];
foreach ($query as $key => $row) {
    $wacr[$row['id']] = $row['valor'];
}

?>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0,minimal-ui">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,600,700,900">
    <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>wa/ecommerce/dashboard/inicio/src/style/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <?php #require_once('src/style/wacr.php');?>
</head>

<body >
    <div id="root">
        <div class="MuiBox-root jss23 jss22">
            <?php require_once('../menu/horizontal.php'); ?>
            <div >
                <div class="MuiBox-root jss44 jss43" >
                    <h6 class="MuiTypography-root title MuiTypography-subtitle2">Compras</h6>
                </div>
            </div>
        </div>

        <?php require_once('../menu/vertical.php'); ?>
    </div>
    <script>
        const sessao = '?token=<?php echo md5(session_id()) ?>&'
        const origin = '<?php echo ConfigPainel('base_url'); ?>';
        const id_aluno = '<?php echo $id ?>';
        let inter = true;
        const val = new Vue({
            el:"#root",
            data: {

            },
            methods:{
                
                
            }
        });

    </script>
    <script src="src/script/main.js"></script>
    <script src="../menu/src/script/main.js"></script>
</body>

</html>
<?php }else{ header('location:'.ConfigPainel('base_url').'wa/ecommerce/login/index.php'); } ?>