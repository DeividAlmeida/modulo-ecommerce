<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html lang="pt" >
<head>
  <meta charset="UTF-8">
</head>
<body>
<form>
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 align-self-center">
                <div class="form-group">
                    <lb slot="body" v-for="param in params" :descri="param.pais" ></lb>
    				<select required name="doc" class="form-control" v-model="pais">
    					<option value="0" disabled>Selecione uma opção…</option>
    					<option value="1">Brasil</option>
    					<option value="2">Portugal</option>
    				</select>
				</div>
			</div>
		</div><br>
		
		<div v-if=" pais == 2">
		    
		    
		    
		</div>
		
		
		<div v-if="pais == 1">
            <frm-txtfld5 slot="body" v-for="item in array" :id="item.id" :lbl="item.label" :txt.sync="item.val"></frm-txtfld5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <lb slot="body" v-for="param in params" :descri="param.pessoa" ></lb>
        				<select required  v-model="key" name="doc" class="form-control">
        					<option value="0" selected disabled >Selecione uma opção…</option>
        					<option value="1">Pessoa Física</option>
        					<option value="2">Pessoa Jurídica</option>
        				</select>
    				</div>
    			</div>
    			<div class="col-md-6" >
                    <div class="form-group">
        				<lb slot="body" v-for="param in params" :descri="param.email" ></lb>
        				<input type='text' class='form-control' id='doc_id'>
    				</div>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-md-6" v-if="key == 1">
                    <div class="form-group">
        				<lb slot="body" v-for="param in params" :descri="param.fisica" ></lb>
        				<input type='text' class='form-control' id='doc_id'>
    				</div>
    			</div>
    			<div class="col-md-6" v-if="key == 2">
                    <div class="form-group">
        				<lb slot="body" v-for="param in params" :descri="param.juridica" ></lb>
        				<input type='text' class='form-control' id='doc_id'>
    				</div>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-md-6">
                    <div class="form-group">
                        <lb slot="body" v-for="param in params" :descri="param.cep" ></lb>
        	
        				<input type='text' class='form-control' id='doc_id'>
    				</div>
    			</div>
    			<div class="col-md-6">
                    <div class="form-group">
        				<lb slot="body" v-for="param in params" :descri="param.rua" ></lb>
        				<input type='text' class='form-control' id='doc_id'>
    				</div>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-md-6">
                    <div class="form-group">
        				<lb slot="body" v-for="param in params" :descri="param.numero" ></lb>
        				<input type='text' class='form-control' id='doc_id'>
    				</div>
    			</div>
    			<div class="col-md-6">
                    <div class="form-group">
        				<lb slot="body" v-for="param in params" :descri="param.complemento" ></lb>
        				<input type='text' class='form-control' id='doc_id'>
    				</div>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-md-6">
                    <div class="form-group">
        				<lb slot="body" v-for="param in params" :descri="param.bairro" ></lb>
        				<input type='text' class='form-control' id='doc_id'>
    				</div>
    			</div>
    			<div class="col-md-6">
                    <div class="form-group">
        				<lb slot="body" v-for="param in params" :descri="param.cidade" ></lb>
        				<input type='text' class='form-control' id='doc_id'>
    				</div>
    			</div>
    		</div>
    		<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <lb slot="body" v-for="param in params" :descri="param.estado" ></lb>
        				<select required onchange="docm(this.value)" name="doc" class="form-control">
        					<option value="0" selected disable>Selecione uma opção…</option>
        					<option value="AC">Acre</option>
    						<option value="AL">Alagoas</option>
    						<option value="AP">Amapá</option>
    						<option value="AM">Amazonas</option>
    						<option value="BA">Bahia</option>
    						<option value="CE">Ceará</option>
    						<option value="DF">Distrito Federal</option>
    						<option value="ES">Espírito Santo</option>
    						<option value="GO">Goiás</option>
    						<option value="MA">Maranhão</option>
    						<option value="MT">Mato Grosso</option>
    						<option value="MS">Mato Grosso do Sul</option>
    						<option value="MG">Minas Gerais</option>
    						<option value="PA">Pará</option>
    						<option value="PB">Paraíba</option>
    						<option value="PR">Paraná</option>
    						<option value="PE">Pernambuco</option>
    						<option value="PI">Piauí</option>
    						<option value="RJ">Rio de Janeiro</option>
    						<option value="RN">Rio Grande do Norte</option>
    						<option value="RS">Rio Grande do Sul</option>
    						<option value="RO">Rondônia</option>
    						<option value="RR">Roraima</option>
    						<option value="SC">Santa Catarina</option>
    						<option value="SP">São Paulo</option>
    						<option value="SE">Sergipe</option>
    						<option value="TO">Tocantins</option>
        				</select>
    				</div>
    			</div>
    		</div>
		</div>
    </div>
</form>

<script >


// Define a custom component
var frmTxtFld = Vue.extend({
    props: {
        id: String,
        lbl: String
    },
    template: "" +
    "<div class='row'>"+
        "<div class='col-md-2'>" +
            "<div class='form-group'>" +
                "<label for='nome'>Nome</label>" +
                "<input type='text' class='form-control' id='nome'>" +
            "</div>"+
        "</div>"+
        
        "<div class='col-md-4'>" +
            "<div class='form-group'>" +
                "<label for='sobrenome'>Sobrenome:</label>" +
                "<input type='text' class='form-control' id='sobrenome'>" +
            "</div>"+
        "</div>"+
        "<div class='col-md-6'>" +
            "<div class='form-group'>" +
                "<label for='sobrenome'>Telefone:</label>" +
                "<input type='text' class='form-control' id='sobrenome'>" +
            "</div>"+
        "</div>"+
    "</div>"
})
var lb = Vue.extend({
    props: {
        descri: String,
        lbl: String
    },
    template:
    "<label for=''>{{descri}}</label>"
});
// Register components
Vue.component('frm-txtfld5', frmTxtFld);
Vue.component('lb', lb);

// Create a root instance
var app = new Vue({
    el: '#app',
    data: {
        params: [
            {fisica: "CPF:", juridica: "CNPJ:", pais: "País:", pessoa: "Pessoa:",email: "E-mail:", cep: "CEP:", rua: "Rua:", 
            numero: "Numero:", complemento: "Complemento:", bairro: "Bairro:", cidade: "Cidade:", estado: "Estado:"},
            
        ],
        array: [
            {id: 'fld1', label: 'Nome', val: ''}
            
            
        ],
        key:"0",
        pais:"0"
         
    },
    
})
  </script>

</body>
</html>
