<link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>wa/ecommerce/dashboard/menu/src/style/main.css">
<div class="MuiBox-root jss27 jss26 app-toolbar">
    <button class="MuiButtonBase-root MuiIconButton-root icon-toolbar menu" onclick="abrir()" tabindex="0" type="button">
        <span class="MuiIconButton-label">
            <span class="material-icons MuiIcon-root" aria-hidden="true">menu</span>
        </span>
        <span class="MuiTouchRipple-root"></span>
    </button>
    <a class="logo-toolbar" >
        
    </a>
    <button class="MuiButtonBase-root MuiIconButton-root jss32" tabindex="0" type="button"  aria-controls="profile" aria-haspopup="true" onclick="perfil()">
        <span class="MuiIconButton-label">
            <div class="MuiBox-root jss37 undefined jss35 jss36" avatar="" >
                <?php if(empty($valida['imagem'])){?>
                    <span  class="material-icons MuiIcon-root avatar-icon" aria-hidden="true">person</span>
                <?php  }else{?>
                    <img style="width:150px; height:70px" src="<?php echo ConfigPainel('base_url').'wa/ecommerce/uploads/'.$valida['imagem'];?>">
                <?php } ?>
            </div>
        </span>
        <span class="MuiTouchRipple-root"></span>
    </button>
</div>
<div role="presentation" class="MuiPopover-root jss33" id="profile-menu" onclick="perfil_menu()" aria-hidden="true" style="position: fixed; z-index: 1300; inset: 0px; visibility: hidden;">
    <div tabindex="0" data-test="sentinelStart"></div>
    <div class="MuiPaper-root MuiPopover-paper MuiPaper-elevation8 MuiPaper-rounded" id="profile" tabindex="-1" style="opacity: 1; transform: none; transition: opacity 287ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, transform 191ms cubic-bezier(0.4, 0, 0.2, 1) 0ms; top: 46px; right: 3%; transform-origin: 260px 6px; visibility: hidden;">
        
        <div class="MuiBox-root jss38 profile-infos">
            <div class="MuiBox-root jss40 profile-infos-avatar jss35 jss39" avatar="" >
                <?php if(empty($valida['imagem'])){?>
                    <span  class="material-icons MuiIcon-root avatar-icon" aria-hidden="true">person</span>
                <?php  }else{?>
                    <img src="<?php echo ConfigPainel('base_url').'wa/ecommerce/uploads/'.$valida['imagem'];?>">
                <?php } ?>
            </div>
            <p class="MuiTypography-root profile-infos-name MuiTypography-body2">
                <b style="color:<?php echo $wacr['destaque'];?> !important"><?php echo $valida['nome'] ?></b>
            </p>
            <span  class="MuiTypography-root profile-infos-email MuiTypography-caption"><?php echo $valida['email'] ?></span>
        </div>
        
        <hr class="MuiDivider-root">
        <a class="MuiButtonBase-root MuiListItem-root MuiMenuItem-root jss34 profile-menu-item MuiMenuItem-gutters MuiListItem-gutters MuiListItem-button"  tabindex="-1" role="menuitem" aria-disabled="false" >
            <span  class="material-icons MuiIcon-root profile-menu-item-icon" aria-hidden="true">assignment_ind</span>
            <p class="MuiTypography-root MuiTypography-body2">Minha Conta</p>
            <span  class="MuiTouchRipple-root"></span>
        </a>
        <li onclick="window.location.href ='<?php echo ConfigPainel('base_url') ?>wa/ecommerce/apis/logout.php?token=<?php echo md5(session_id()) ?>'" class="MuiButtonBase-root MuiListItem-root MuiMenuItem-root jss34 profile-menu-item MuiMenuItem-gutters MuiListItem-gutters MuiListItem-button"   tabindex="-1" role="menuitem" aria-disabled="false">
                <span class="material-icons MuiIcon-root profile-menu-item-icon" aria-hidden="true">exit_to_app</span>
                <p class="MuiTypography-root MuiTypography-body2">Sair</p>
                <span class="MuiTouchRipple-root"></span>
        </li>
    </div>
    <div tabindex="0" data-test="sentinelEnd"></div>
</div>
