<?php
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
session_start();
if(isset($_SESSION['Wacontrol'])){
    $id = $_SESSION['Wacontrol'][0];
    $senha = $_SESSION['Wacontrol'][1];
}
else if(isset($_COOKIE['Wacontroltoken'])){
    $id =  $_COOKIE['Wacontrolid'];
    $senha =  $_COOKIE['Wacontroltoken'];
}
if(!empty($senha)){$valida = DBRead('ead_usuario','*',"WHERE id = '{$id}' AND  senha = '{$senha}' ")[0];}
if(!empty($valida)){header('Location:'.ConfigPainel('base_url').'wa/ecommerce/dashboard/inicio/index.php?status=curso&posicao=avancar');}
$query = DBRead('ecommerce_config','*');
$wacr = [];
foreach ($query as $key => $row) {
    $wacr[$row['id']] = $row['valor'];
}
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <base target="_blank">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>wa/ecommerce/login/src/style/main.css">
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue-swal@1/dist/vue-swal.min.js"></script>
       <?php require_once('src/style/wacr.php') ?>
    </head>

    <body style="height:400px !important">
        <div id="root">
            <div class="MuiBox-root jss21 jss20">
                <div class="MuiBox-root jss23 jss22">
                    <div class="MuiBox-root jss24 logo-container">
                    <!--<?php if($wacr['logo'] == 'Sim'){ ?>
                        <img src="<?php echo ConfigPainel('base_url')."wa/ecommerce/uploads/".$wacr['img']; ?>" alt="" class="logo-img">
                    <?php }?>-->
                    </div>
                    <form class="MuiFormControl-root">
                        <div v-if="status == 'login'">
                            <div class="MuiBox-root jss25 input-container email">
                                <div class="MuiFormControl-root MuiTextField-root input">
                                    <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl">
                                        <input aria-invalid="false" placeholder="E-mail" id="login-email" name="email" type="email" class="MuiInputBase-input MuiOutlinedInput-input" value="">
                                        <fieldset aria-hidden="true" class="jss26 MuiOutlinedInput-notchedOutline"></fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="MuiBox-root jss30 input-container password">
                                <div class="MuiFormControl-root MuiTextField-root input">
                                    <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl MuiInputBase-adornedEnd MuiOutlinedInput-adornedEnd">
                                        <input aria-invalid="false" placeholder="Senha" autocomplete="on" id="login-password" name="password" type="password" class="MuiInputBase-input MuiOutlinedInput-input MuiInputBase-inputAdornedEnd MuiOutlinedInput-inputAdornedEnd" value="">
                                        <div class="MuiInputAdornment-root MuiInputAdornment-positionEnd">
                                            <button onclick="visivel(document.getElementById('olho').innerHTML)" class="MuiButtonBase-root MuiIconButton-root MuiIconButton-edgeEnd" tabindex="0" type="button" aria-label="toggle password visibility">
                                                <span class="MuiIconButton-label">
                                                    <span class="material-icons MuiIcon-root" id="olho" aria-hidden="true">visibility</span>
                                                </span>
                                                <span class="MuiTouchRipple-root"></span>                                        
                                            </button>
                                        </div>
                                        <fieldset  aria-hidden="true" class="jss26 MuiOutlinedInput-notchedOutline"></fieldset>                                    
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="MuiBox-root jss31 btn-login-container">
                                <button onclick="valida()" class="MuiButtonBase-root MuiButton-root MuiButton-contained btn-login MuiButton-containedPrimary MuiButton-containedSizeLarge MuiButton-sizeLarge" tabindex="0" type="button">
                                    <span class="MuiButton-label bt_txt">Entrar</span>
                                    <span class="MuiTouchRipple-root"></span>
                                </button>
                            </div>
                            <label class="MuiFormControlLabel-root "  for="manter" onclick="box(document.getElementById('manter').checked)" style="right:35%; position: relative">
                                <span class=" text2 MuiButtonBase-root MuiIconButton-root jss32 MuiCheckbox-root MuiCheckbox-colorSecondary MuiIconButton-colorSecondary" aria-disabled="false">
                                    <span class="MuiIconButton-label" id="switch_board">
                                        <input class="jss35" id="manter" type="checkbox" data-indeterminate="false" value="true">
                                        <span class="material-icons MuiIcon-root" id="switch" aria-hidden="true"></span>
                                    </span>
                                    <span class="MuiTouchRipple-root"></span>
                                </span>
                                <span class="MuiTypography-root MuiFormControlLabel-label MuiTypography-body1">
                                    <span class=" text2 MuiTypography-root keep-connected MuiTypography-caption" id="text2" > Mantenha-me conectado</span>
                                </span>
                            </label>
                        </div>
                        <div v-if="status == 'reset'">
                            <div class="MuiBox-root jss41 input-container email">
                                <p style="text-align: center" class="MuiTypography-root sign-up MuiTypography-body2 text2">Digite seu e-mail de cadastro</p>
                            </div>
                            <div class="MuiBox-root jss41 input-container email">
                                <div class="MuiFormControl-root MuiTextField-root input">
                                    <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl">
                                        <input aria-invalid="false" placeholder="E-mail" id="login-email" name="email" type="email" class="MuiInputBase-input MuiOutlinedInput-input recupera" value="">
                                        <fieldset aria-hidden="true" class="jss26 MuiOutlinedInput-notchedOutline"></fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="MuiBox-root jss31 btn-login-container">
                                <button onclick="recupera()" class="MuiButtonBase-root MuiButton-root MuiButton-contained btn-login MuiButton-containedPrimary MuiButton-containedSizeLarge MuiButton-sizeLarge enviar" tabindex="0" type="button">
                                    <span class="MuiButton-label bt_txt">Enviar</span>
                                    <span class="MuiTouchRipple-root"></span>
                                </button>
                            </div>
                            <div class="MuiBox-root jss31 btn-login-container">
                                <button onclick="val.status='login'" class="MuiButtonBase-root MuiButton-root MuiButton-contained btn-login MuiButton-containedPrimary MuiButton-containedSizeLarge MuiButton-sizeLarge enviar" tabindex="0" type="button">
                                    <span class="MuiButton-label bt_txt">Sair</span>
                                    <span class="MuiTouchRipple-root"></span>
                                </button>
                            </div>
                        </div>
                        <div v-if="status == 'altera'">
                            <div class="MuiBox-root jss41 input-container email">
                                <p style="text-align: center" class="MuiTypography-root sign-up MuiTypography-body2 text2">Alterar Senha</p>
                            </div>
                            <div class="MuiBox-root jss30 input-container password">
                                <div class="MuiFormControl-root MuiTextField-root input">
                                    <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl MuiInputBase-adornedEnd MuiOutlinedInput-adornedEnd">
                                        <input aria-invalid="false" placeholder=" Nova Senha" autocomplete="on" id="login-password" name="new_password" type="password" class="MuiInputBase-input MuiOutlinedInput-input MuiInputBase-inputAdornedEnd MuiOutlinedInput-inputAdornedEnd" value="">
                                        <div class="MuiInputAdornment-root MuiInputAdornment-positionEnd">
                                            <button onclick="visivel(document.getElementById('olho').innerHTML)" class="MuiButtonBase-root MuiIconButton-root MuiIconButton-edgeEnd" tabindex="0" type="button" aria-label="toggle password visibility">
                                                <span class="MuiIconButton-label">
                                                    <span class="material-icons MuiIcon-root" id="olho" aria-hidden="true">visibility</span>
                                                </span>
                                                <span class="MuiTouchRipple-root"></span>                                        
                                            </button>
                                        </div>
                                        <fieldset  aria-hidden="true" class="jss26 MuiOutlinedInput-notchedOutline"></fieldset>                                    
                                    </div>
                                </div>
                            </div>
                            <div class="MuiBox-root jss30 input-container password">
                                <div class="MuiFormControl-root MuiTextField-root input">
                                    <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl MuiInputBase-adornedEnd MuiOutlinedInput-adornedEnd">
                                        <input aria-invalid="false" placeholder="Confirme a Senha" autocomplete="on" id="login-password" name="new_password" type="password" class="MuiInputBase-input MuiOutlinedInput-input MuiInputBase-inputAdornedEnd MuiOutlinedInput-inputAdornedEnd" value="">
                                        <div class="MuiInputAdornment-root MuiInputAdornment-positionEnd">
                                        </div>
                                        <fieldset  aria-hidden="true" class="jss26 MuiOutlinedInput-notchedOutline"></fieldset>                                    
                                    </div>
                                </div>
                            </div>
                            <div class="MuiBox-root jss31 btn-login-container">
                                <button onclick="altera()" class="MuiButtonBase-root MuiButton-root MuiButton-contained btn-login MuiButton-containedPrimary MuiButton-containedSizeLarge MuiButton-sizeLarge enviar" tabindex="0" type="button">
                                    <span class="MuiButton-label bt_txt">Salvar</span>
                                    <span class="MuiTouchRipple-root"></span>
                                </button>
                            </div>
                            
                        </div>
                    </form>
                    <div  v-if="status == 'login'" class="MuiBox-root jss36 sign-up-container"  >
                        <span class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textSecondary MuiButton-textSizeLarge MuiButton-sizeLarge" tabindex="0" aria-disabled="false"  >
                            <span class="MuiButton-label">
                                <a  class="sign-up text2" style="text-decoration:none" onclick="val.status='reset'" >Esqueci minha senha</a>

                                <a  class="sign-up text2" style="text-decoration:none; " onclick="cadastro()">Ainda não é aluno?</a>
                            </span>
                            <span class="MuiTouchRipple-root"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const origin = '<?php echo ConfigPainel('base_url'); ?>';
            const val = new Vue({
                el:'#root',
                data: {
                    status: 'login',
                }
            });
        </script>
        <script src="src/script/main.js"></script>                          
    </body>
</html>