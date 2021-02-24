let farol = true;
document.getElementsByClassName('jss101')[0].addEventListener('click', ()=>{ 
    let senha = document.getElementById('campo0')
    let confirma = document.getElementById('campo1')
    let inputs = document.querySelectorAll('input')
    let a  = confirma.value.match(/[0-9]/);
    let b  = confirma.value.match(/[A-Z]/);
    let c = confirma.value.length > 5;
    let form = new FormData()
     if(!a || !b || !c){
        swal({title:"Senha muito fraca!",html:true, text:"Critérios mínimos: \n 1° Uma letra maiúscula \n 2° Um número \n 3° mais de 5 dígitos.", icon:"error"}); 
     }else if(senha.value !='' && senha.value == confirma.value){
        for(let i = 1; i < 7; i++){
            form.append(inputs[i].name,inputs[i].value)
        }
        form.append('imagem',inputs[0].files[0])
        fetch(origin+'wa/ecommerce/apis/cadastar.php',{
            method: 'POST',
            body: form
        }).then(dt => dt.text()).then(data =>{
            if(data == 1){
                window.location.href = origin+'wa/ecommerce/dashboard/inicio/?status=curso&posicao=avancar'
            }else{
                swal("ERRO",data,"error")
            }
        })
        val.erro = ''
    }else{
        val.erro = '*senha inválida'
    }
})
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