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
$valida = DBRead('ead_usuario','*',"WHERE id = '{$id}' AND  senha = '{$senha}' ")[0];
 if($senha!= null && $valida['senha'] == $senha){
$config = json_encode(DBRead('ead_config_geral','*'));
$cursos = json_decode($valida['cursos'], true);
if(is_array($cursos)){
    foreach($cursos as $chave => $valor){
      $curso_valida[$chave] =  DBRead('ead_curso','*',"WHERE nome = '{$valor}'");
    }
    $curso = json_encode($curso_valida);
}else{$curso = 'null';}

if(empty($valida['imagem'])){
    $avatar = "";
}else{
   $avatar = ConfigPainel('base_url').'wa/ead/uploads/'.$valida['imagem'];
}
$wacr = DBRead('ead_config_geral','*' ,"WHERE id = '1'")[0];
?>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <base target="_blank">
    <title>Login - Curso de Web Acappella</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>wa/ead/dashboard/perfil/src/style/main.css">
    <script src="https://cdn.jsdelivr.net/npm/vue-swal@1/dist/vue-swal.min.js"></script>
    <?php echo DBRead('ead','*',"WHERE id = '1'")[0]['modo']; ?>
    <?php require_once('src/style/wacr.php');?>

</head>

<body style="margin:0 !important">
    <div id="root">
        <div class="MuiBox-root jss23 jss22">
            <?php require_once('../menu/horizontal.php'); ?>
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
                                     <input onchange="readURL(this)" id="avatar-input" type="file" class="perfil" multiple accept='image/*' name="imagem">
                                    </div>
                                </lable >
                            </div>
                            <div class="MuiBox-root jss94 account-area account-data-inputs-container">
                                <div class="MuiBox-root jss95 input-container name">
                                    <div class="MuiFormControl-root MuiTextField-root input">
                                        <label class="MuiFormLabel-root MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated MuiInputLabel-shrink MuiInputLabel-outlined MuiFormLabel-filled" data-shrink="true" for="name" id="name-label">Nome</label>
                                        <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl">
                                            <input aria-invalid="false"  type="text" class="MuiInputBase-input MuiOutlinedInput-input perfil" name="nome"  value="<?php  echo $valida['nome']; ?>">
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
                                                <input aria-invalid="false"  type="text" class="MuiInputBase-input MuiOutlinedInput-input perfil" name="cpf" value="<?php  echo $valida['cpf']; ?>">
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
                                                <input aria-invalid="false"  type="text" class="MuiInputBase-input MuiOutlinedInput-input perfil" name="data" value="<?php  echo $valida['data']; ?>">
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
                                            <input aria-invalid="false" id="email" type="email" class="MuiInputBase-input MuiOutlinedInput-input  perfil" name="email" value="<?php  echo $valida['email']; ?>">
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
                                            <input aria-invalid="false" id="Endereço" type="text" class="MuiInputBase-input MuiOutlinedInput-input perfil" name="endereco" value="<?php  echo $valida['endereco']; ?>">
                                            <fieldset aria-hidden="true" class="jss96 MuiOutlinedInput-notchedOutline">
                                                <legend class="jss98 jss99">
                                                    <span>Endereço</span>
                                                </legend>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div><br>
                            </div>
                        </div>
                        <div class="MuiBox-root jss101 account-footer">
                            <button class="MuiButtonBase-root MuiButton-root MuiButton-text btn-profile MuiButton-textPrimary" tabindex="0" type="button">
                                <span class="MuiButton-label">Salvar Alterações</span>
                                <span class="MuiTouchRipple-root"></span>
                            </button>
                        </div>
                    </div>
                    <div class="MuiBox-root jss102 jss85 account-password-container">
                        <span class="MuiTypography-root section-title MuiTypography-overline">Alterar senha </span>
                        <div class="MuiBox-root jss103 account-password-content">
                            <div class="MuiBox-root jss104 account-password-current-container">
                                <div class="MuiBox-root jss105 input-container current-password">
                                    <div class="MuiFormControl-root MuiTextField-root input password">
                                        <label class="MuiFormLabel-root MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated MuiInputLabel-shrink MuiInputLabel-outlined MuiFormLabel-filled" data-shrink="true" for="password" id="password-label">Senha atual</label>
                                        <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl MuiInputBase-adornedEnd MuiOutlinedInput-adornedEnd">
                                            <input id="campo1" aria-invalid="false" name="senha_atual" type="password" class="MuiInputBase-input MuiOutlinedInput-input MuiInputBase-inputAdornedEnd MuiOutlinedInput-inputAdornedEnd" value="">
                                            <div class="MuiInputAdornment-root MuiInputAdornment-positionEnd">
                                                <button onclick="visivel('1')" class="MuiButtonBase-root MuiIconButton-root MuiIconButton-edgeEnd" tabindex="0" type="button" aria-label="toggle password visibility">
                                                    <span class="MuiIconButton-label">
                                                        <span id="eye1" class="material-icons MuiIcon-root" aria-hidden="true">visibility</span>
                                                    </span>
                                                    <span class="MuiTouchRipple-root"></span>
                                                </button>
                                            </div>
                                            
                                            <fieldset aria-hidden="true" class="jss96 MuiOutlinedInput-notchedOutline">
                                                <legend class="jss98 jss99">
                                                    <span>Senha atual</span>
                                                </legend>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="MuiBox-root jss106 account-password-new-container">
                                <div class="MuiBox-root jss107 input-container new-password">
                                    <div class="MuiFormControl-root MuiTextField-root input">
                                        <label class="MuiFormLabel-root MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated MuiInputLabel-shrink MuiInputLabel-outlined MuiFormLabel-filled" data-shrink="false" for="newPassword" id="newPassword-label">Nova senha</label>
                                        <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl MuiInputBase-adornedEnd MuiOutlinedInput-adornedEnd">
                                            <input id="campo2" aria-invalid="false" name="nova_senha" type="password" class="MuiInputBase-input MuiOutlinedInput-input MuiInputBase-inputAdornedEnd MuiOutlinedInput-inputAdornedEnd" value="">
                                            <div class="MuiInputAdornment-root MuiInputAdornment-positionEnd">
                                                <button onclick="visivel('2')" class="MuiButtonBase-root MuiIconButton-root MuiIconButton-edgeEnd" tabindex="0" type="button" aria-label="toggle password visibility">
                                                    <span class="MuiIconButton-label" >
                                                        <span id="eye2"  class="material-icons MuiIcon-root" aria-hidden="true">visibility</span>
                                                    </span>
                                                    <span class="MuiTouchRipple-root"></span>
                                                </button>
                                            </div>
                                            <fieldset aria-hidden="true" class="jss96 MuiOutlinedInput-notchedOutline">
                                                <legend class="jss98 jss99">
                                                    <span>Nova senha</span>
                                                </legend>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="MuiBox-root jss108 input-container new-password-confirm">
                                    <div class="MuiFormControl-root MuiTextField-root input">
                                        <label class="MuiFormLabel-root MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated MuiInputLabel-shrink MuiInputLabel-outlined MuiFormLabel-filled" data-shrink="false" for="confirmNewPassword"  id="confirmNewPassword-label">Confirme a nova senha</label>
                                        <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-formControl MuiInputBase-adornedEnd MuiOutlinedInput-adornedEnd">
                                            <input  id="campo3" aria-invalid="false"  type="password" class="MuiInputBase-input MuiOutlinedInput-input MuiInputBase-inputAdornedEnd MuiOutlinedInput-inputAdornedEnd" value="">
                                            <div class="MuiInputAdornment-root MuiInputAdornment-positionEnd">
                                                <button onclick="visivel('3')" class="MuiButtonBase-root MuiIconButton-root MuiIconButton-edgeEnd" tabindex="0" type="button" aria-label="toggle password visibility">
                                                    <span class="MuiIconButton-label">
                                                        <span class="material-icons MuiIcon-root" id="eye3" aria-hidden="true">visibility</span>
                                                    </span>
                                                    <span class="MuiTouchRipple-root"></span>
                                                </button>
                                            </div>
                                            <fieldset aria-hidden="true" class="jss96 MuiOutlinedInput-notchedOutline">
                                                <legend class="jss98 jss99">
                                                    <span>Confirme a nova senha</span>
                                                </legend>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <small class="MuiTypography-root section-title MuiTypography-overline" style="color:red">{{erro}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="MuiBox-root jss109 account-footer">
                            <button class="MuiButtonBase-root MuiButton-root MuiButton-text btn-profile MuiButton-textPrimary" tabindex="0" type="button">
                                <span class="MuiButton-label">Salvar Alterações</span>
                                <span class="MuiTouchRipple-root"> </span>  
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php require_once('../menu/vertical.php'); ?>
    </div>
    <script>
        const sessao = '?token=<?php echo md5(session_id()) ?>&'
        const origin = '<?php echo ConfigPainel('base_url'); ?>';
        const val = new Vue({
            el:'#root',
            data: {
                avatar:'<?php echo $avatar ?>',
                erro: '',
                cursos:<?php echo  $curso ?>
            }
        });
    </script>
    <script src="src/script/main.js"></script>
    <script src="../menu/src/script/main.js"></script>
</body>

</html>
<?php }else{ header('location:'.ConfigPainel('base_url').'wa/ead/login/index.php'); } ?>