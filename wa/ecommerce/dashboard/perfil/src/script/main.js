let farol = true;
visivel = (a) =>{
    const icon = document.getElementById('eye'+a);
    const campo = document.getElementById('campo'+a);
    if(farol == true){
        icon.innerHTML = 'visibility_off';
        campo.type = 'text';
        farol = false;
    }else{
        icon.innerHTML = 'visibility';
        campo.type = 'password';
        farol= true;
    }
}
readURL = (a) =>{
    let url = new FileReader()
    url.onload = (e) => { 
        val.avatar = e.target.result;
    }
    url.readAsDataURL(a.files[0]);
}
document.getElementsByClassName('MuiButtonBase-root')[4].addEventListener('click', ()=>{
    let inputs =  document.getElementsByClassName('perfil')
    let form = new FormData()
    for(let i = 1; i < 6; i++){
    form.append(inputs[i].name,inputs[i].value)
    }
    form.append('imagem',inputs[0].files[0])
    fetch(origin+'wa/ead/apis/perfil.php'+sessao,{
        method: 'POST',
        body: form
    }).then(dt => dt.text()).then(data =>{
        if(data == 1){
            document.location.reload(true);
        }else{
            alert(data)
        }
    })
})
document.getElementsByClassName('MuiButton-textPrimary')[1].addEventListener('click', ()=>{
    let senha = document.getElementsByClassName('MuiOutlinedInput-inputAdornedEnd');
    let a  = senha[1].value.match(/[0-9]/);
    let b  = senha[1].value.match(/[A-Z]/);
    let c = senha[1].value.length > 5;
    let form = new FormData();
    if(senha[1].value != senha[2].value || senha[2].value == ''){
        val.erro = '*senha inválida'
    }else if(!a || !b || !c){
        swal({title:"Senha muito fraca!",html:true, text:"Critérios mínimos: \n 1° Uma letra maiúscula \n 2° Um número \n 3° mais de 5 dígitos.", icon:"error"});
    }else{
        val.erro = ''
            for(let i = 0; i < 2; i++){
                form.append(senha[i].name, senha[i].value)
            }
            fetch(origin+'wa/ead/apis/senha.php'+sessao,{
            method: 'POST',
            body: form
        }).then(dt => dt.text()).then(data =>{
            if(data != 1){
                swal("ERRO",data,"error")
            }else{
                document.location.reload(true);
            }
        })
    }
})