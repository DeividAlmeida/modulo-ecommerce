function CountProductView(id) {
  $.ajax({
    type: "GET",
    cache: false,
    url: UrlPainel + 'wa/ecommerce/produto/count_view.php?id=' + id
  });
}
function CatalogoProdutosRelacionadosListagem(id) {
  $.ajax({
    type: "GET",
    cache: false,
    url: UrlPainel + 'wa/ecommerce/produtos_relacionados?id=' + id,
    success: function (data) {
      jQuery('#CatalogoProdutosRelacionadosListagem').html(data);
    },
    error: function (data) {
      setTimeout(function () { CatalogoProdutosRelacionadosListagem(id); }, 5000);
    },
  });
}
function CatalogoProdutosMaisVistos() {
  $.ajax({
    type: "GET",
    cache: false,
    url: UrlPainel + 'wa/ecommerce/produtos_mais_vistos',
    success: function (data) {
      jQuery('#CatalogoProdutosMaisVistos').html(data);
    },
    error: function (data) {
      setTimeout(function () { CatalogoProdutosMaisVistos(); }, 5000);
    },
  });
}