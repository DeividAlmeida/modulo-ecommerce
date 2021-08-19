(function($) {
  'use strict';

  // Atualizar carrinho
  $('.cart_qtd').change(function(){
    var parent = $(this).parent();
    var btn_id = parent.attr('id');
  
    var id = parseInt(btn_id.split("cart_qtd_")[1]);
    var qtd = parseInt(parent.find('input').val());
  
    var  pdt = parent.attr("pdt");
    var  vlf = parent.attr("vlf");
    
  fetch(UrlPainel+"estoque.php")
	.then(response=>{
		if (response.ok) {		
      
      var ref = parent.attr("ref");
    
      estoque(ref).then(res=>{
          if(parseInt(res.estoque) >= parseInt(qtd)){
              $.ajax({
                type: 	"GET",
                cache: 	false,
                url: 		UrlPainel+'wa/ecommerce/carrinho/?UpdateQtd='+id+'&qtd='+qtd+'&pdt='+pdt+'&vlf='+vlf+"&ref="+res.id+"&refs="+ref,
          
                success: function () {
                 new EcommerceBtnCarrinho();
                 new  EcommerceCarrinho();
                 Swal.fire({
                    icon: 'success',
                    title: 'Atualizado',
                    html: '<p style="font-size:15px">Carrinho atualizado com sucesso.</p>',
                    showConfirmButton: false,
                    showCloseButton: true,
                  });
          
                }
              });
          }else{  
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '<p style="font-size:15px">Infelizmente não temos estoque suficiente para suprir essa demanda. Nós temos '+ res.estoque +' unidade(s) desse produto em estoque.</p>',
                showConfirmButton: false,
                showCloseButton: true,
              });
          }
      })

		} else {
			throw new Error('Something went wrong');
		}
	})
	.catch(error=>{


    var xhttp = new XMLHttpRequest();
    xhttp.open('GET', UrlPainel+'wa/ecommerce/carrinho?Saldo='+pdt, false);
    xhttp.setRequestHeader('Content-Type',  'text/xml');
    xhttp.send(null);
    const wo = parseInt(xhttp.responseText, 10);

    
    if(wo >= qtd){
    $.ajax({
      type: 	"GET",
      cache: 	false,
      url: 		UrlPainel+'wa/ecommerce/carrinho/?UpdateQtd='+id+'&qtd='+qtd+'&pdt='+pdt+'&vlf='+vlf,

      success: function () {
       new EcommerceBtnCarrinho();
       new  EcommerceCarrinho();
       Swal.fire({
          icon: 'success',
          title: 'Atualizado',
          html: '<p style="font-size:15px">Carrinho atualizado com sucesso.</p>',
          showConfirmButton: false,
          showCloseButton: true,
        });

      }
    });
    }else{
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          html: '<p style="font-size:15px">Infelizmente não temos estoque suficiente para suprir essa demanda. Nós temos '+ xhttp.responseText +' unidade(s) desse produto em estoque.</p>',
          showConfirmButton: false,
          showCloseButton: true,
        });
    }

	})
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
      success: function () {
      new EcommerceBtnCarrinho();
      new  EcommerceCarrinho();
      }
    });
  })

})(jQuery);
