    <div role="presentation" class="MuiDrawer-root MuiDrawer-modal" id="menu" style="position: fixed; z-index: 999; inset: 0px; display:none; transition: 0.8s;">
        <div class="MuiBackdrop-root" onclick="esconder()" i aria-hidden="true" style="opacity: 1; transition: opacity 225ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;"> </div>
        <div tabindex="0" data-test="sentinelStart"></div>       
    </div>   
    <div class="MuiPaper-root MuiDrawer-paper MuiDrawer-paperAnchorLeft MuiPaper-elevation16" tabindex="-1" id="back" style="transition: 0.5s; width:0">
        <div class="MuiBox-root jss143 jss63">
            <div class="MuiBox-root jss144 header-container">
                <button class="MuiButtonBase-root MuiIconButton-root header-close" tabindex="0" type="button" onclick="esconder()">
                    <span class="MuiIconButton-label">
                        <span class="material-icons MuiIcon-root" aria-hidden="true">close</span>
                    </span>
                    <span class="MuiTouchRipple-root"></span>
                </button>
                <div class="MuiBox-root jss145 header-logo-container">
                    
                </div>
            </div>
            <ul class="MuiList-root list-channels-container MuiList-padding">
                <!--<li id="sel"  class=" jss205 MuiListItem-root jss146 MuiListItem-gutters" onclick="geral('<?php echo $_GET['posicao'] ?>')">
                    <a  class="MuiTypography-root MuiLink-root MuiLink-underlineNone list-channels-item-link undefined MuiTypography-colorPrimary" >
                        <div class="MuiListItemIcon-root list-channels-item-icon">
                            <span  class="material-icons MuiIcon-root" aria-hidden="true">dashboard</span>
                        </div>
                        <p class="MuiTypography-root list-channels-item-text MuiTypography-body2">Visão geral</p>
                    </a>
                </li>-->
                <li id="sel"  class=" jss205 MuiListItem-root jss146 MuiListItem-gutters jss148" >
                    <a class="MuiTypography-root MuiLink-root MuiLink-underlineNone list-channels-item-link undefined MuiTypography-colorPrimary" >
                        <div class="MuiListItemIcon-root list-channels-item-icon">
                            <span  class="material-icons MuiIcon-root" aria-hidden="true">dvr</span>
                        </div>
                        <p class="MuiTypography-root list-channels-item-text MuiTypography-body2">Cursos</p>
                    </a>
                </li>
            </ul>
            <span class="MuiTypography-root list-title MuiTypography-overline">Meus treinamentos</span>
            <ul  class="MuiList-root list-courses-container MuiList-padding">
                <li id="sel" class="MuiListItem-root jss149  MuiListItem-gutters jss205" >
                    <a class="MuiTypography-root MuiLink-root MuiLink-underlineNone list-courses-item-link MuiTypography-colorPrimary" >
                        <div class="MuiListItemIcon-root list-courses-item-icon">
                        </div>
                        <span  class="MuiTypography-root list-courses-item-text MuiTypography-caption"></span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div tabindex="0" data-test="sentinelEnd"></div>
    </div>