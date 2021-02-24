const back = document.getElementById('back');
const menu = document.getElementById('menu');
const profile = document.getElementById('profile');
const profile_menu = document.getElementById('profile-menu');
let concluidas = document.getElementsByClassName('chart-text');
let circulo = document.getElementsByClassName('chart-circle-fill');
let prox_texto = document.getElementsByClassName('lesson-text-title');
let stroker = document.getElementsByClassName('chart-circle-fill');
let licao = document.getElementsByClassName('lesson-icon');
let bxl = document.getElementsByClassName('lesson-content');
let border = document.getElementsByClassName('jss129');
let info = document.getElementsByClassName('lesson-infos-icon-go');
function progresso_barra(a){
    for(let i = 0; i< val.cursos.length; i++){
        let contar = 0;
        for(let ii = 0; ii < val.progressos.length; ii++ ){
            if(val.progressos[val.cursos[i][0].id+ii] != null){
                contar++
            }
        }
        let centos = (contar/(Object.getOwnPropertyNames(val.aula[val.cursos[i][0].id]).length -1))*100
        let cento = parseInt(centos)
        eval(a)
    }
}
curso = (a) => {
    if(a == 'avancar'){
        val.status = 'curso';
        back.style.width = '0';
        menu.style.display = 'none'
    }else{
         window.location.href=origin+'/wa/ead/dashboard/inicio/?posicao=voltar&status=curso'
    }
}
geral = (a) => {
    if(a == 'avancar'){
        val.status = 'geral'
        back.style.width = '0'
        menu.style.display = 'none'
    }else{
        window.location.href=origin+'/wa/ead/dashboard/inicio/?posicao=voltar&status=geral'
    }
}
abrir = () =>{
    back.style.width = '325px';
    menu.style.display = 'block'
};
perfil = () =>{
    profile.style.visibility = "visible";
    profile_menu.style.visibility = "visible";
}
perfil_menu = () =>{
    profile.style.visibility = "hidden";
    profile_menu.style.visibility = "hidden";
}
esconder = () =>{
    back.style.width = '0';
    menu.style.display = 'none'
}
document.getElementsByClassName('MuiListItem-button')[0].addEventListener('click', ()=>{
    window.location.href = origin+'wa/ead/dashboard/perfil'
})
