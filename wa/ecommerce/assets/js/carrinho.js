(function($) {
  'use strict';

  // Imprimir carrinho
  $('#cartPrint').click(function(){
    printJS('shop--cart--table', 'html')
  });

  // Atualizar carrinho
  $('.cart_qtd_update').click(function(){
    var parent = $(this).parent();
    var btn_id = parent.attr('id');

    var id = parseInt(btn_id.split("cart_qtd_")[1]);
    var qtd = parseInt(parent.find('input').val());

    var  pdt = parent.attr("pdt");
    var  vlf = parent.attr("vlf");


    $.ajax({
      type: 	"GET",
      cache: 	false,
      url: 		UrlPainel+'wa/ecommerce/carrinho/?UpdateQtd='+id+'&qtd='+qtd+'&pdt='+pdt+'&vlf='+vlf,
      beforeSend: function (data){
        $('.shop--cart__block').addClass("is-active");
      },
      success: function () {
        EcommerceCarrinho();
      }
    });
  })

  // Remove item do carrinho
  $('.cart_qtd_delete').click(function(){
    var parent = $(this).parent();
    var btn_id = parent.attr('id');
    var id_produto = parseInt(btn_id.split("cart_qtd_")[1]);

    $.ajax({
      type: 	"GET",
      cache: 	false,
      url: 		UrlPainel+'wa/ecommerce/carrinho/?RemItem='+id_produto,
      beforeSend: function (data){
        $('.shop--cart__block').addClass("is-active");
      },
      success: function () {
        EcommerceCarrinho();
      }
    });
  })

  $('#formCarrinho').submit(function (e) {
		// Para de enviar o formulario
		e.preventDefault();

		// Faz solicitação via AJAX
		$.ajax({
			type: 				'POST',
			cache: 				false,
			url: 					UrlPainel+'wa/ecommerce/carrinho/?EnviarEmail',
			data: 				$(this).serialize(),
      beforeSend: function (data){
        $("#formCarrinho .btnSubmit").attr("disabled", true).html("Enviando...");
      },
      success: function () {
        $('#formCarrinho').empty();
        $('#formCarrinho').html('');
        $('#formCarrinhoSucesso').attr('style', '');
      },
      error: function () {
        $("#formCarrinho .btnSubmit").attr("disabled", true).html("Erro interno. Tente novamente mais tarde.");
      }
		})
	});
})(jQuery);
