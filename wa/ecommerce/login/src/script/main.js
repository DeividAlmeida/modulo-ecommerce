let url = document.referrer
let insp = new URL(url)
let reset = insp.searchParams.get('Z')
val.ver = (a) =>{ val.status = a};
var form = new FormData();

/*document.getElementsByClassName('text2')[3].addEventListener('click', ()=>{
window.location.href = origin+'wa/ead/cadastro'
})
document.getElementsByClassName('ds')[0].addEventListener('click', ()=>{
    let senha = document.getElementsByClassName('das')[0].value;
    let a  = senha.match(/[0-9]/);
    let b  = senha.match(/[A-Z]/);
    let c = senha.length > 5;
    if(a && b && c){

        }else{
            alert(a,b,c)
        }
    })*/
visivel = (a) =>{
    const icon = document.getElementById('olho');
    const campo = document.getElementById('login-password');
    if(a == 'visibility'){
        icon.innerHTML = 'visibility_off';
        campo.type = 'text'
    }else{
        icon.innerHTML = 'visibility';
        campo.type = 'password'
    }
}
box = (a) => {
    const view = document.getElementById('switch');
    if(a == true){
        view.innerHTML = 'checkbox'
    }else{
        view.innerHTML = ''
    }
}
valida = () =>{

    form.append("email", document.getElementById('login-email').value);
    form.append("senha", document.getElementById('login-password').value);
    form.append("manter", document.getElementById('manter').checked);
    fetch (origin+'wa/ead/apis/autentica.php',{method: "POST", body: form}).then(x => x.text()).then(data =>{
        if(data == 1){
            window.location.href = origin+'wa/ead/dashboard/inicio/?status=curso&posicao=avancar'
        }else{
            swal("ERRO!", data, "error"); 
        }
    });
}
recupera = ()=>{
    form.append('email',document.getElementsByClassName('recupera')[0].value)
    form.append('origin',url)
    fetch(origin+'wa/ead/apis/recupera.php',{
        method:'post',
        body: form
    }).then(dt => dt.text()).then(data=>{
        if(data == 1){
            swal("E-mail Enviado!", "E-mail de recuperação enviado com sucesso", "success").then((isConfirm)=>{if(isConfirm){document.location.reload(true);}})
        }else{
            swal("ERRO!", data, "error"); 
        }
    })
}
if(reset){
    val.status = 'altera'
}
altera = () =>{
    let senha = document.getElementsByName('new_password')
    let a  = senha[0].value.match(/[0-9]/)
    let b  = senha[0].value.match(/[A-Z]/)
    let c = senha[0].value.length > 5
    if(!a || !b || !c){
        swal({title:"Senha muito fraca!",html:true, text:"Critérios mínimos: \n 1° Uma letra maiúscula \n 2° Um número \n 3° mais de 5 dígitos.", icon:"error"});
    }else if(senha[0].value != senha[1].value){
        swal("ERRO","Senha incorreta","error")
    }else{
       form.append('senha',senha[0].value)
       form.append('Z',reset) 
       fetch(origin+'wa/ead/apis/altera.php',{
           method:"post",
           body:form
       }).then(a => a.text()).then(data=>{
           if(data == 1){
               swal("Salvo!", "Senha alterada com sucesso", "success").then((isConfirm)=>{if(isConfirm){document.location.reload(true);}})
           }else{
               swal("ERRO",data,"error")}
       })
    }
}
