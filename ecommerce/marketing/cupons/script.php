<script src='https://unpkg.com/react/umd/react.development.js'></script>
<script src='https://unpkg.com/react-dom/umd/react-dom.development.js'></script>
<script>


<?php 
#Listagem Cupons
if(isset($_GET['ListarCupons'])){
foreach($query as $dados){ ?>
class Dropdown<?php echo $dados['id']; ?> extends React.Component {
  constructor(props) {
    super(props);

    this.toggleDropdown = this.toggleDropdown.bind(this);
    this.handleMouseEvent = this.handleMouseEvent.bind(this);
    this.handleBlurEvent = this.handleBlurEvent.bind(this);
    this.hasFocus = this.hasFocus.bind(this);

    this.state = {
      show: false };
  }

  componentDidMount() {
    // handles mouse events like click and dblclick
    document.addEventListener('mouseup', this.handleMouseEvent);
    // handles tabbing out of
    this.dropdown.addEventListener('focusout', this.handleBlurEvent);
  }

  hasFocus(target) {
    // React ref callbacks pass `null` when a component unmounts, so guard against `this.dropdown` not existing
    if (!this.dropdown) {
      return false;
    }
    var dropdownHasFocus = false;
    var nodeIterator = document.createNodeIterator(this.dropdown, NodeFilter.SHOW_ELEMENT, null, false);
    var node;

    while (node = nodeIterator.nextNode()) {if (window.CP.shouldStopExecution(0)) break;
      if (node === target) {
        dropdownHasFocus = true;
        break;
      }
    }window.CP.exitedLoop(0);

    return dropdownHasFocus;
  }

  handleBlurEvent(e) {
    var dropdownHasFocus = this.hasFocus(e.relatedTarget);

    if (!dropdownHasFocus) {
      this.setState({
        show: false });
    }
  }

  handleMouseEvent(e) {
    var dropdownHasFocus = this.hasFocus(e.target);

    if (!dropdownHasFocus) {
      this.setState({
        show: false });
    }
  }

  toggleDropdown() {
    this.setState({
      show: !this.state.show });
  }

  sayHello<?php echo $dados['id']; ?>() {
   new DeletarItem(<?php echo $dados['id']; ?>, 'DeletarCupom')
  }

  render() {
    return (
      React.createElement("div", { style :{ cursor: "pointer"}, className: `dropdown ${this.state.show ? 'show' : ''}`, ref: dropdown => this.dropdown = dropdown },
      React.createElement("i", {
        className: "icon-apps blue lighten-2 avatar",
        id: "dropdownMenuButton",
        "data-toggle": "dropdown",
        "aria-haspopup": "true",
        "aria-expanded": this.state.show,
        onClick: this.toggleDropdown }, ),

      React.createElement("div", {
        className: "dropdown-menu dropdown-menu-right",
        "aria-labelledby": "dropdownMenuButton" },
      React.createElement("a", { className: "dropdown-item", href: "?EditarCupom=<?php echo $dados['id']; ?>" }, 
      React.createElement("i",{ className: "text-primary icon icon-pencil"})," Editar"), 
      React.createElement("a", { className: "dropdown-item", href: "#!",  onClick: this.sayHello<?php echo $dados['id']; ?>}, 
      React.createElement("i",{ className: "text-danger icon icon-remove"})," Excluir"), 
      )));
  }}


const App<?php echo $dados['id']; ?> = () => {
  return (
    React.createElement("div", null,
    React.createElement(Dropdown<?php echo $dados['id']; ?>, null),
  ));

};
<?php } ?>
ReactDOM.render(
    React.createElement("table", { className: "table m-0 table-striped" },   
        React.createElement("thead", null,   
            React.createElement("tr", null, 
                React.createElement("th", { style: { fontWeight: "bold", fontSize: "15px", width: "400px"},}, "ID"),
                React.createElement("th", { style: { fontWeight: "bold", fontSize: "15px" },}, "Código")<?php if (DadosSession('nivel') == 1) { ?>,
                React.createElement("th", { style: { fontWeight: "bold", fontSize: "15px",width: "53px" },}, "Ação")<?php } ?>)),
        React.createElement("tbody", null,
            <?php foreach($query as $dados){ ?>
            React.createElement("tr", null,  
                React.createElement("td", null, <?php echo $dados['id']; ?>),
                React.createElement("td", null, <?php echo "'".$dados['codigo']."'"; ?>)<?php if (DadosSession('nivel') == 1) { ?>,
                React.createElement("td", null, 
                React.createElement(App<?php echo $dados['id']; ?>, null)
                )<?php } ?>
            ),<?php } ?>             
)),document.getElementById('DataTable'));
<?php } 



#Adicionar Cupons
else if(isset($_GET['AdicionarCupom'])){ ?>

    ReactDOM.render(
        React.createElement("div",{className: "card"},
        React.createElement("div",{className: "card-header white"},
        React.createElement("strong",null, "Cadastrar Cupom")
    ),
    React.createElement("div",{className: "card-body"},
        React.createElement("div",{className: "row"},
           React.createElement("div",{className: "col-md-6"},
                React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Código:"),
                React.createElement("input",{className: "form-control", name: "codigo", type: "text", required: true}),
            ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Descrição:"),
                React.createElement("textarea",{className: "form-control", name: "descricao", type: "text"}),
            ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Tipo de Desconto:"),
                React.createElement("select",{className: "form-control", name: "tipo", type: "text", required: true},
                React.createElement("option", {value: "Ford", disabled:true, selected:true}, "Ford"),
                React.createElement("option", {value: "WV"}, "WV"),
                React.createElement("option", {value: "Tesla"}, "Tesla"),
                
                ),),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Produtos:"),
                React.createElement("input",{ className: "form-control", name: "produtos", type:"text"}),
                ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Excluir Produtos:"),
                React.createElement("input",{ className: "form-control", name: "ex_produtos", type:"text"}),
                ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Categorias:"),
                React.createElement("input",{ className: "form-control", name: "categorias", type:"text"}),
                ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Excluir Categorias:"),
                React.createElement("input",{ className: "form-control", name: "ex_categorias", type:"text"}),
                ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Limite de uso por cupom:"),
                React.createElement("input",{ className: "form-control", name: "limite_cupom", type:"text"}),
                ),
            ), 
            
           React.createElement("div",{className: "col-md-6"},
                React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Valor:"),
                React.createElement("input",{className: "form-control", name: "valor", step: "0.01", type: "number"}),
            ),
            React.createElement("div",{style:{display: "flex"}, className: "form-group"},
                React.createElement("lable",null, "Frete:"),
                React.createElement("input",{style:{ marginTop: "3px", width: "7%"}, className: "form-control", name: "frete", type: "checkbox"}),
            ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Data de Expiração:"),
                React.createElement("input",{ className: "form-control", name: "data", type:"date"}),
            ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Gasto Mínimo:"),
                React.createElement("input",{ className: "form-control", name: "gasto_mi", step: "0.01", type: "number"}),
            ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Gasto Máximo:"),
                React.createElement("input",{ className: "form-control", name: "gasto_ma",step: "0.01", type: "number"}),
            ),
            React.createElement("div",{style:{display: "flex"}, className: "form-group"},
                React.createElement("lable",null, "Uso individual:"),
                React.createElement("input",{ style:{ marginTop: "3px", width: "7%"}, className: "form-control", name: "uso", type: "checkbox"}),
            ),
            React.createElement("div",{style:{display: "flex"}, className: "form-group"},
                React.createElement("lable",null, "Excluir itens em oferta:"),
                React.createElement("input",{ style:{ marginTop: "3px", width: "7%"}, className: "form-control", name: "ex_oferta", type: "checkbox"}),
            ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "E-mails permitidos:"),
                React.createElement("input",{ className: "form-control", name: "emails", type:"text"}),
                ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Limite de uso por cliente:"),
                React.createElement("input",{ className: "form-control", name: "limite_cliente", type:"text"}),
                ),
        ))),
        React.createElement("div",{className: "card-footer white"},                
                React.createElement("button",{ className: "btnSubmit btn btn-primary float-right", type:"submit"}, "Cadastrar"),
            ),

        ),document.getElementById('card'))

<?php }  else if(isset($_GET['EditarCupom'])){ 



#Editar cupom  
?>

ReactDOM.render(
        React.createElement("div",{className: "card"},
        React.createElement("div",{className: "card-header white"},
        React.createElement("strong",null, "Cadastrar Cupom")
    ),
    React.createElement("div",{className: "card-body"},
        React.createElement("div",{className: "row"},
           React.createElement("div",{className: "col-md-6"},
                React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Código:"),
                React.createElement("input",{defaultValue:"<?php echo $query['codigo'] ?>", className: "form-control", name: "codigo", type: "text", required: true}),
            ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Descrição:"),
                React.createElement("textarea",{className: "form-control", name: "descricao", type: "text" }, "<?php echo $query['descricao'] ?>"),
            ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Tipo de Desconto:"),
                React.createElement("select",{className: "form-control", name: "tipo", type: "text", required: true, defaultValue: "<?php echo $query['tipo'] ?>"},
                React.createElement("option", {value: "Ford", disabled:true, selected:true}, "Ford"),
                React.createElement("option", {value: "WV"}, "WV"),
                React.createElement("option", {value: "Tesla"}, "Tesla"),
                
                ),),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Produtos:"),
                React.createElement("input",{ className: "form-control", name: "produtos", type:"text", defaultValue: "<?php echo $query['produtos'] ?>"}),
                ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Excluir Produtos:"),
                React.createElement("input",{ className: "form-control", name: "ex_produtos", type:"text", defaultValue: "<?php echo $query['ex_produtos'] ?>"}),
                ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Categorias:"),
                React.createElement("input",{ className: "form-control", name: "categorias", type:"text", defaultValue: "<?php echo $query['categorias'] ?>"}),
                ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Excluir Categorias:"),
                React.createElement("input",{ className: "form-control", name: "ex_categorias", type:"text", defaultValue: "<?php echo $query['ex_categorias'] ?>"}),
                ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Limite de uso por cupom:"),
                React.createElement("input",{ className: "form-control", name: "limite_cupom", type:"text", defaultValue: "<?php echo $query['limite_cupom'] ?>"}),
                ),
            ), 
            
           React.createElement("div",{className: "col-md-6"},
                React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Valor:"),
                React.createElement("input",{className: "form-control", name: "valor", type: "number", required: true, step: "0.01", defaultValue: "<?php echo $query['valor'] ?>" }),
            ),
            React.createElement("div",{style:{display: "flex"},className: "form-group"},
                React.createElement("lable",null, "Frete:"),
                React.createElement("input",{style:{ marginTop: "3px", width: "7%"}, className: "form-control", name: "frete", type: "checkbox", defaultValue: "<?php echo $query['frete'] ?>"}),
            ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Data de Expiração:"),
                React.createElement("input",{ className: "form-control", name: "data", type:"date", required: true, defaultValue: "<?php echo $query['data'] ?>"}),
            ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Gasto Mínimo:"),
                React.createElement("input",{ className: "form-control", name: "gasto_mi", type: "number", step: "0.01", defaultValue: "<?php echo $query['gasto_mi'] ?>"}),
            ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Gasto Máximo:"),
                React.createElement("input",{ className: "form-control", name: "gasto_ma", type: "number", step: "0.01", defaultValue: "<?php echo $query['gasto_ma'] ?>"}),
            ),
            React.createElement("div",{style:{display: "flex"}, className: "form-group"},
                React.createElement("lable",null, "Uso individual:"),
                React.createElement("input",{ style:{ marginTop: "3px", width: "7%"}, className: "form-control", name: "uso", type: "checkbox", defaultValue: "<?php echo $query['uso'] ?>"}),
            ),
            React.createElement("div",{style:{display: "flex"}, className: "form-group"},
                React.createElement("lable",null, "Excluir itens em oferta:"),
                React.createElement("input",{ style:{ marginTop: "3px", width: "7%"}, className: "form-control", name: "ex_oferta", type: "checkbox", defaultValue: "<?php echo $query['ex_oferta'] ?>"}),
            ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "E-mails permitidos:"),
                React.createElement("input",{ className: "form-control", name: "emails", type:"text", defaultValue: "<?php echo $query['emails'] ?>"}),
                ),
            React.createElement("div",{className: "form-group"},
                React.createElement("lable",null, "Limite de uso por cliente:"),
                React.createElement("input",{ className: "form-control", name: "limite_cliente", type:"text", defaultValue: "<?php echo $query['limite_cliente'] ?>"}),
                ),
        ))),
        React.createElement("div",{className: "card-footer white"},                
                React.createElement("button",{ className: "btnSubmit btn btn-primary float-right", type:"submit"}, "Cadastrar"),
            ),

        ),document.getElementById('card'))

<?php } ?>
</script>