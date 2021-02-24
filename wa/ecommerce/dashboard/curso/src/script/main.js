let jss78 = document.getElementById('jss78');
let container = document.getElementById('container');
let progresso = document.getElementById('progresso');
let texto = document.getElementsByClassName('course-progress-text');
let barra = document.getElementsByClassName('jss204');
let color = document.getElementsByClassName('jss170');
let nav = false;
function marcar(){
    if(val.concluidos[id_curso+val.id_aula]==null){
        val.md = 'Marcar'
    }else{
        val.md = 'Desmarcar'
        
    }
}
function efeitos(){
let t_t = 0;
    
    let t_c = 0 ;
    for(z=0;z< val.modulos.length; z++){
        let contar = 0;
        

        for(i=0; i<val.aulas[val.modulos[z].id].length;i++){
            ++t_t
            if(val.concluidos[id_curso+val.aulas[val.modulos[z].id][i].tag] != null){ 
                ++t_c
                ++contar
                circulo[z].setAttribute('stroke-dasharray', (contar/val.aulas[val.modulos[z].id].length)*100+' 100')
                concluidas[z].innerText = contar;
                if(contar == val.aulas[val.modulos[z].id].length){
                    color[z].style.color = '#00C268'
                    stroker[z].style.stroke = '#00C268'
                    concluidas[z].innerText = 'check'
                    concluidas[z].setAttribute('class', 'chart-text material-icons')
                }
            }else{
                circulo[z].setAttribute('stroke-dasharray', (contar/val.aulas[val.modulos[z].id].length)*100+' 100')
                color[z].style.color = '#000'
                stroker[z].style.stroke = destaque
                concluidas[z].innerText = contar;
                concluidas[z].setAttribute('class', 'chart-text')
            }
            
        }
    }
    let countpro = (t_c/t_t)*100;
    barra[0].style.width = countpro+'%'
    texto[0].innerText = parseInt(countpro)+'% Concluído'
     new marcar()
}
window.onload = () => {
    document.body.style.height= '800px';
        let count = 0;
        for(let i= 0; i < val.modulos.length; i++){
            val.aulas[val.modulos[i].id].forEach((a, b)=>{
                val.aulas[val.modulos[i].id][b].tag = count +=1;
            })
        }
        new efeitos()
}
anterior = () => {
      
    val.status = ''
    val.id_aula > 1 ? val.id_aula = val.id_aula - 1: val.id_aula = val.id_aula ;
    for(let i= 0; i < val.modulos.length; i++){
        val.aulas[val.modulos[i].id].forEach((a, b)=>{
             if(val.aulas[val.modulos[i].id][b].tag == val.id_aula){
                return val.idx = val.aulas[val.modulos[i].id][b];
            }
        })
    }
    new marcar()
}; 
function proximo(a){
    val.status = ''
    val.id_aula < a ? val.id_aula = val.id_aula + 1: val.id_aula = val.id_aula ;
    for(let i= 0; i < val.modulos.length; i++){
        val.aulas[val.modulos[i].id].forEach((a, b)=>{
             if(val.aulas[val.modulos[i].id][b].tag == val.id_aula){
                return val.idx = val.aulas[val.modulos[i].id][b];
            }
        })
    }
    new marcar()
}
navegar = () =>{
    if(nav){
        nav = false
        val.nav = 'open'; 
        val.main_width = 'false'; 
        val.icon = 'opened'; 
        val.texto = 'Esconder navegação'; 
        progresso.style.display = 'flex';
        container.style.display = 'block';
        jss78.style.height = '100%';
        
    }else{ 
        nav = true
        val.nav = 'close'; 
        val.main_width = 'without-sidemenu'; 
        val.icon = ''; 
        val.texto = 'Mostrar navegação';
        progresso.style.display = 'none';
        container.style.display = 'none';
        jss78.style.height = '75px';
    }

}
function salvar(){
    let save = new FormData;
    save.append('0', JSON.stringify(val.notas))
    let post = new XMLHttpRequest;
    post.open('POST',origin+'wa/ead/apis/notacoes.php'+sessao+'salvarnotas&id='+id_aluno);
    post.send(save)
    post.onload = function(){
        swal("Salvo!", "Alterações salvas com sucesso!", "success"); 
        sessionStorage.removeItem('edita')
    } 
}
document.getElementById('salvar').addEventListener('click', ()=>{ 
    let data = new Date();
    let dia = ((data.getDate() )+ "-" + ((data.getMonth() + 1)) + "-" + data.getFullYear() + " " + data.getHours()+ "h" +data.getMinutes()+ "m");
    let valor = document.getElementById('notes-new-input').value;
    let edita = sessionStorage.getItem('edita')
    var resultado = null
    if(val.notas[id_curso+val.id_aula] == null){ val.notas[id_curso+val.id_aula] = []; val.idx_notas = []}
    if(edita == null){  resultado = '{'+'"'+dia+'"'+':"'+valor+'"}'}else{ resultado = '{'+'"'+edita+'"'+':"'+valor+'"}'}
    val.notas[id_curso+val.id_aula].push(JSON.parse(resultado));
    new salvar()
})

document.getElementsByClassName('btn-conclusion')[0].addEventListener('click', ()=>{
    let oq = val.concluidos[id_curso+val.id_aula];
    if(oq == '1'){val.concluidos[id_curso+val.id_aula]= null;}else{val.concluidos[id_curso+val.id_aula] = '1'}
    let concluido = new FormData;
    concluido.append('0', JSON.stringify(val.concluidos))
    fetch(origin+'wa/ead/apis/concluido.php'+sessao+'id='+id_aluno,{
        method: 'POST',
        body: concluido
    }).then(dt => dt.text()).then(data =>{
        if(data == 1){
            new efeitos()
            new proximo(key)
        }else{
            swal("ERRO!", data, "error")
        }
    })
    
})
/*document.getElementsByClassName('btn-conclusion')[0].addEventListener('click', ()=>{
   val.idx.questoes = JSON.parse(val.idx.questoes)
   val.status = 'teste'
   if(val.idx.tipo_prova == 'multipla'){
      val.idx.alternativas = JSON.parse(val.idx.alternativas) 
   }
})*/
concluir = () =>{
  new proximo(key) 
}