function CountProductView(id) {
  $.ajax({
    type: "GET",
    cache: false,
    url: UrlPainel + 'wa/ecommerce/produto/count_view.php?id=' + id
  });
}
function EcommerceRelacionadosListagem(id) {
  $.ajax({
    type: "GET",
    cache: false,
    url: UrlPainel + 'wa/ecommerce/produtos_relacionados?id=' + id,
    success: function (data) {
      jQuery('#EcommerceRelacionadosListagem').html(data);
    },
    error: function (data) {
      setTimeout(function () { EcommerceRelacionadosListagem(id); }, 5000);
    },
  });
}
function EcommerceMaisVistos() {
  $.ajax({
    type: "GET",
    cache: false,
    url: UrlPainel + 'wa/ecommerce/produtos_mais_vistos',
    success: function (data) {
      jQuery('#EcommerceMaisVistos').html(data);
    },
    error: function (data) {
      setTimeout(function () { EcommerceMaisVistos(); }, 5000);
    },
  });
}