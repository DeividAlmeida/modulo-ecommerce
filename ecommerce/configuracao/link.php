<?php $read = DBRead('ecommerce_config_link','*',"WHERE id = '1'")[0]; ?>
<form id="post" method="post" enctype="multipart/form-data" onsubmit="return false">
    <div class="card">
        <div class="card-header white">
        <strong>Configurar do Link de Acompanhamento do Produto</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="form-group">
                    <?php if(empty($read['logo'])){ ?>
                        <img id="learn" src=""  />
                    <?php }else{ ?>
                        <img id="learn" src="./wa/ecommerce/uploads/<?php echo $read['logo']; ?>"  />
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <div class="form-group">
					<input onchange="readURL(this)"  style="width: 0.1px; height: 0.1px; opacity: 0; overflow: hidden; z-index: -1;" type="file" multiple accept='image/*' name="img" id="img">
                    <label multiple accept='image/*' class="btn btn-primary" for="img"><i class="icon-upload blue lighten-2 avatar"></i><b>Upload logo</b></labor>
                </div>                
            </div>
        </div>        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Cor do Fundo do Cabeçalho:</label>
                    <div class="color-picker input-group colorpicker-element focused">
                        <input type="text" class="form-control" name="cabecalho" value="<?php echo $read['cabecalho'];?>">
                        <span class="input-group-append">
                            <span class="input-group-text add-on white">
                                <i class="circle"></i>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label>Cor do Texto do Cabeçalho:</label>
                <div class="color-picker input-group colorpicker-element focused">
                    <input type="text" class="form-control" name="texto" value="<?php echo $read['texto'];?>">
                        <span class="input-group-append">
                            <span class="input-group-text add-on white">
                                <i class="circle"></i>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>      
    </div>
    <div class="card-footer white">
      <button class="btn btn-primary float-right" id="my-button" onclick="post()" type="submit">Atualizar</button>
    </div>
</form>


<div id="my-result"></div>

<script>
readURL = () =>{
    let a = document.querySelector('input[type=file]').files[0];
    let b = document.querySelector('#learn');
    let read = new FileReader();
    let decode = read.readAsDataURL(a);
    read.onloadend = () =>{
        b.src = read.result;
    }    
}

function post(){
    let m = new XMLHttpRequest();
    let form = new FormData();
    let f = document.getElementById('post');
    let inputs = f.querySelectorAll('input');
    let a = document.querySelector('input[type=file]').files[0];
    for(let i = 0; i < inputs.length; i++ ){ 
        form.append(inputs[i].name, inputs[i].value)
        
    };
    form.append("img", a);
    m.open("POST", "ecommerce.php?editaLink");
    m.send(form);
    m.onprogress = function () {
        swal({
            title: 'Aguarde!',
            text: 'Estamos atualizando as configurações da página de acompanhamento do produto\n. Não recarregue a página até a mensagem de sucesso.',
            icon: "info",
            html: true,
            showConfirmButton: true
        });
    };
    m.onload = function(){
        swal("Página Atualizada!", "Página de acompanhamento do produto atualizada com sucesso!", "success");                              

    } 
}

</script>
