<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html lang="pt" >
<head>
  <meta charset="UTF-8">
</head>
<body>
<!-- partial:index.partial.html -->
<form>
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <lable id="doc_tipo">País: </lable>
    				<select required onchange="docm(this.value)" name="doc" class="form-control">
    					<option value="0" selected disable>Selecione uma opção…</option>
    					<option value="1">Brasil</option>
    					<option value="2">Portugal</option>
    				</select>
				</div>
			</div>
		</div>
        <frm-txtfld5 slot="body" v-for="item in array" :id="item.id" :lbl="item.label" :txt.sync="item.val"></frm-txtfld5>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <lable id="doc_tipo">Pessoa: </lable>
    				<select required onchange="docm(this.value)" name="doc" class="form-control">
    					<option value="0" selected disable>Selecione uma opção…</option>
    					<option value="1">Pessoa Física</option>
    					<option value="2">Pessoa Jurídica</option>
    				</select>
				</div>
			</div>
			<div class="col-md-6">
                <div class="form-group">
    				<lable id="doc_tipo">E-mail:</lable>
    				<input type='text' class='form-control' id='doc_id'>
				</div>
			</div>
		</div>
		<div class="row d-none">
			<div class="col-md-6 d-none">
                <div class="form-group">
    				<lable id="doc_tipo"></lable>
    				<input type='text' class='form-control' id='doc_id'>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
                <div class="form-group">
    				<lable id="doc_tipo">CEP:</lable>
    				<input type='text' class='form-control' id='doc_id'>
				</div>
			</div>
			<div class="col-md-6">
                <div class="form-group">
    				<lable id="doc_tipo">Rua:</lable>
    				<input type='text' class='form-control' id='doc_id'>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
                <div class="form-group">
    				<lable id="doc_tipo">Número</lable>
    				<input type='text' class='form-control' id='doc_id'>
				</div>
			</div>
			<div class="col-md-6">
                <div class="form-group">
    				<lable id="doc_tipo">Complemento</lable>
    				<input type='text' class='form-control' id='doc_id'>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
                <div class="form-group">
    				<lable id="doc_tipo">Bairro:</lable>
    				<input type='text' class='form-control' id='doc_id'>
				</div>
			</div>
			<div class="col-md-6">
                <div class="form-group">
    				<lable id="doc_tipo">Cidade:</lable>
    				<input type='text' class='form-control' id='doc_id'>
				</div>
			</div>
		</div>
		<div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <lable id="doc_tipo">Estado: </lable>
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

// Register components
Vue.component('frm-txtfld5', frmTxtFld);

// Create a root instance
var app = new Vue({
    el: '#app',
    data: {
        params: [
            {color: 'primary', title: 'Panel Title A'},
            
        ],
        array: [
            {id: 'fld1', label: 'Nome', val: ''}
            
            
        ]
    }
})
  </script>

</body>
</html>
