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

$valida = DBRead('ecommerce_usuario','*',"WHERE id = '{$id}' AND  senha = '{$senha}' ")[0];
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
        <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>wa/ecommerce/cadastro/src/style/main.css">
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/vue-swal@1/dist/vue-swal.min.js"></script>
        <?php #require_once('src/style/wacr.php');?>
    </head>

<body style="margin:0 !important">
    <div id="root">
        <div class="MuiBox-root jss23 jss22">
            <div class="MuiBox-root jss42 jss41 app-toolbar">
                <a class="logo-toolbar" href="/">
                    
                </a>
            </div>
            <div class="MuiBox-root jss83 jss82">
                <div class="MuiBox-root jss84 content">
                    <div class="MuiBox-root jss86 jss85 account-data-container">
                        <span class="MuiTypography-root section-title MuiTypography-overline">Dados da conta</span>
                        <div class="MuiBox-root jss87 account-data-content">
                            <div class="MuiBox-root jss88 account-data-avatar-container">
                                <label style="cursor: pointer" multiple accept='image/*' for="avatar-input" class="MuiBox-root jss90 jss89">
                                    <div  class="MuiBox-root jss91 avatar-wrapper">
                                        
                                            <div class="MuiBox-root jss93 undefined jss50 jss92">
                                                <span v-if="avatar ==''"  class="material-icons MuiIcon-root avatar-icon" style="font-size:50px" aria-hidden="true">person</span>
                                                <img  v-if="avatar !=''"  :src="avatar">
                                            </div>
                                            <span class="MuiTouchRipple-root"></span>
                                     <input onchange="readURL(this)" id="avatar-input" type="file" multiple accept='image/*' name="imagem">
                                    </div>
                                </lable >
                            </div>
                            <div class="MuiBox-root jss94 account-area account-data-inputs-container">
                                <div class="MuiBox-root jss95 input-container name">
                                    <div class="MuiFormControl-root MuiTextField-root input">
                                        <label class="MuiFormLabel-root MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated MuiInputLabel-shrink MuiInputLabel-outlined MuiFormLabel-filled" data-shrink="true" for="name" id="name-label">Nome</label>
                                        <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl">
                                            <input aria-invalid="false" name="nome" type="text" class="MuiInputBase-input MuiOutlinedInput-input"  value="">
                                            <fieldset aria-hidden="true" class="jss96 MuiOutlinedInput-notchedOutline">
                                                <legend class="jss98 jss99">
                                                    <span>Nome</span>
                                                </legend>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="MuiBox-root jss106 account-password-new-container">
                                    <div class="MuiBox-root jss107 input-container new-password" id="metade">
                                        <div class="MuiFormControl-root MuiTextField-root input">
                                            <label class="MuiFormLabel-root MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated MuiInputLabel-shrink MuiInputLabel-outlined MuiFormLabel-filled" data-shrink="true" for="name" id="name-label">CPF</label>
                                            <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl">
                                                <input aria-invalid="false" name="cpf" type="number" min="9" max="9" class="MuiInputBase-input MuiOutlinedInput-input"  >
                                                <fieldset aria-hidden="true" class="jss96 MuiOutlinedInput-notchedOutline">
                                                    <legend class="jss98 jss99">
                                                        <span>CPF</span>
                                                    </legend>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="MuiBox-root jss108 input-container new-password-confirm" id="metade">
                                        <div class="MuiFormControl-root MuiTextField-root input">
                                            <label class="MuiFormLabel-root MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated MuiInputLabel-shrink MuiInputLabel-outlined MuiFormLabel-filled" data-shrink="true" for="name" id="name-label">Data de Nascimento</label>
                                            <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl">
                                                <input aria-invalid="false" name="data" type="date" class="MuiInputBase-input MuiOutlinedInput-input"  >
                                                <fieldset aria-hidden="true" class="jss96 MuiOutlinedInput-notchedOutline">
                                                    <legend class="jss98 jss99">
                                                        <span>Data de Nascimento</span>
                                                    </legend>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="MuiBox-root jss95 input-container email">
                                    <div class="MuiFormControl-root MuiTextField-root input">
                                        <label class="MuiFormLabel-root MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated MuiInputLabel-shrink MuiInputLabel-outlined MuiFormLabel-filled" data-shrink="true" for="name" id="name-label">E-mail</label>
                                        <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl">
                                            <input aria-invalid="false" id="email" name="email" type="email" class="MuiInputBase-input MuiOutlinedInput-input"  >
                                            <fieldset aria-hidden="true" class="jss96 MuiOutlinedInput-notchedOutline">
                                                <legend class="jss98 jss99">
                                                    <span>E-mail</span>
                                                </legend>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="MuiBox-root jss95 input-container Endereço">
                                    <div class="MuiFormControl-root MuiTextField-root input">
                                        <label class="MuiFormLabel-root MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated MuiInputLabel-shrink MuiInputLabel-outlined MuiFormLabel-filled" data-shrink="true" for="name" id="name-label">Endereço</label>
                                        <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl">
                                            <input aria-invalid="false" id="Endereço" name="endereco" type="text" class="MuiInputBase-input MuiOutlinedInput-input"  >
                                            <fieldset aria-hidden="true" class="jss96 MuiOutlinedInput-notchedOutline">
                                                <legend class="jss98 jss99">
                                                    <span>Endereço</span>
                                                </legend>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="MuiBox-root jss106 account-password-new-container">
                                    <div class="MuiBox-root jss107 input-container new-password" id="metade">
                                        <div class="MuiFormControl-root MuiTextField-root input">
                                            <label class="MuiFormLabel-root MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated MuiInputLabel-shrink MuiInputLabel-outlined MuiFormLabel-filled" data-shrink="true" for="name" id="name-label">Senha</label>
                                            <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl">
                                                <input id="campo0" aria-invalid="false" id="senha" name='senha' type="password" class="MuiInputBase-input MuiOutlinedInput-input"  value="">
                                                <div class="MuiInputAdornment-root MuiInputAdornment-positionEnd">
                                                    <button onclick="visivel('0')" id="eyesenha2" class="MuiButtonBase-root MuiIconButton-root MuiIconButton-edgeEnd" tabindex="0" type="button" aria-label="toggle password visibility">
                                                        <span class="MuiIconButton-label">
                                                            <span class="material-icons MuiIcon-root" id="eye0" aria-hidden="true" id="olho" >visibility</span>
                                                        </span>
                                                        <span class="MuiTouchRipple-root"></span>
                                                    </button>
                                                </div>
                                                <fieldset aria-hidden="true" class="jss96 MuiOutlinedInput-notchedOutline">
                                                    <legend class="jss98 jss99">
                                                        <span>Senha</span>
                                                    </legend>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="MuiBox-root jss108 input-container new-password-confirm" id="metade">
                                        <div class="MuiFormControl-root MuiTextField-root input">
                                            <label class="MuiFormLabel-root MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated MuiInputLabel-shrink MuiInputLabel-outlined MuiFormLabel-filled" data-shrink="true" for="name" id="name-label">Confirme a senha</label>
                                            <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl">
                                                <input id="campo1" aria-invalid="false"  type="password" class="MuiInputBase-input MuiOutlinedInput-input"  >
                                                <div class="MuiInputAdornment-root MuiInputAdornment-positionEnd">
                                                    <button onclick="visivel('1')" id="eyesenha" class="MuiButtonBase-root MuiIconButton-root MuiIconButton-edgeEnd" tabindex="0" type="button" aria-label="toggle password visibility">
                                                        <span class="MuiIconButton-label">
                                                            <span class="material-icons MuiIcon-root" id="eye1" aria-hidden="true">visibility</span>
                                                        </span>
                                                        <span class="MuiTouchRipple-root"></span>
                                                    </button>
                                                </div>
                                                <fieldset aria-hidden="true" class="jss96 MuiOutlinedInput-notchedOutline">
                                                    <legend class="jss98 jss99">
                                                        <span>Confirme a senha</span>
                                                    </legend>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <small class="MuiTypography-root section-title MuiTypography-overline" style="color:red">{{erro}}</small>
                                    </div>
                                </div><br>
                            </div>
                        </div>
                        <div class="MuiBox-root jss101 account-footer">
                            <button class="MuiButtonBase-root MuiButton-root MuiButton-text btn-profile MuiButton-textPrimary" tabindex="0" type="button">
                                <span class="MuiButton-label">Salvar</span>
                                <span class="MuiTouchRipple-root"></span>
                            </button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <script>
        const origin = '<?php echo ConfigPainel('base_url'); ?>';
        const val = new Vue({
            el:'#root',
            data: {
                erro:'',
                status: 'login',
                avatar:''
            }
        });
    </script>
    <script src="src/script/main.js"></script>
</body>

</html>