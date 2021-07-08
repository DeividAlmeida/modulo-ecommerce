<?php 
error_reporting(0);
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
$data = DBRead('ecommerce_usuario', '*', 'ORDER BY id DESC');

$tabela = [];
if(is_array($data)){
    foreach($data as $chave => $valor){
         $data[$chave]['endereco'] = json_decode($data[$chave]['endereco'], true); 
         $tabela[$chave]['<div class="row" ><div class="hidden">'] = '</div>';
         $tabela[$chave]['<div class="col-md-4"><div class="card"><div class="card-header">DADOS DO CLIENTE</div><div class="card-body"> nome'] = $valor['nome']." ".$valor['sobrenome'];
            $tabela[$chave]['email'] = $valor['email'];  
            $tabela[$chave]['CPF / CNPJ'] = $valor['id_pessoa'];
            $tabela[$chave]['telefone'] = $valor['telefone'];
        $tabela[$chave]['</div></div></div><div class="hidden">'] ='</div>' ;
        foreach($data[$chave]['endereco'] as $key => $valeu){
                    $tabela[$chave]['<div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            '.(1+$key).'° ENDEREÇO
                        </div>
                        <div class="card-body">
                            <div class="hidden">'.$key.'</div>'.'estado'] = $valeu['estado'];
                    $tabela[$chave]['<div class="hidden">'.$key.'</div>'.'cidade'] = $valeu['cidade'];
                    $tabela[$chave]['<div class="hidden">'.$key.'</div>'.'cep'] = $valeu['cep'];
                    $tabela[$chave]['<div class="hidden">'.$key.'</div>'.'bairro'] = $valeu['bairro'];
                    $tabela[$chave]['<div class="hidden">'.$key.'</div>'.'rua'] = $valeu['rua'];
                    $tabela[$chave]['<div class="hidden">'.$key.'</div>'.'número'] = $valeu['numero'];
           
            $tabela[$chave]['</div></div></div><div class="hidden">'.$key] ='</div>';
        }
        
        $tabela[$chave]['</div><div class="hidden">'] = "";
        $tabela[$chave]['nome'] = $valor['nome']." ".$valor['sobrenome'];
        $tabela[$chave]['fristname'] = $valor['nome'];
        $tabela[$chave]['lastname'] = $valor['sobrenome'];
        $tabela[$chave]['senha'] = $valor['senha'];
        $tabela[$chave]['endereco'] = $valor['endereco'];
        $tabela[$chave]['id'] = $valor['id'];  
        $tabela[$chave]["<i class='fa fa-pencil'></i>"] ="<center><a onclick='find(".$valor['id'].")' style='cursor:pointer' data-target='#Modal' data-toggle='modal' '><i class='text-center text-primary icon icon-pencil' aria-hidden='true'></i></a></center>";
    }
}
echo json_encode($tabela);