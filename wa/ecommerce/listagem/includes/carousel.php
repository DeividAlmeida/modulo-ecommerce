<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>elementia/assets/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>elementia/css/button.css">
<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>elementia/css/slider.css">
<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>/wa/ecommerce/assets/css/carousel.css">

<script src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>elementia/assets/js/owl.carousel.min.js"></script>

<script>
  $(document).ready( function() {
    $("#CaroulselCatalogoProduto<?php echo $uniqid; ?>").owlCarousel({
      slideSpeed:     200,
      autoPlay:       3000,
      stopOnHover:    true,
      nav:            true,
      navText:        ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
      pagination:     false,
      lazyLoad :      true,
      responsive : {
        0 : {
          items:    1
        },
        994:{
          items: <?php echo $lista['colunas']; ?>
        }
      }
    });
  });
</script>


<style>
.shop--modal-add-product__btn{
  border: 0 !important;
  margin-top:10px !important;
  background-color: <?php echo $config['carrinho_cor_btns']; ?> !important;
}
#CaroulselCatalogoProduto<?php echo $uniqid; ?> .cpe-button{
  background-color: <?php echo $config['carrocel_cor_btn']; ?> !important;
  color: <?php echo $config['carrocel_cor_btn_texto']; ?> !important;
}
#CaroulselCatalogoProduto<?php echo $uniqid; ?> .cpe-button:hover{
  background-color: <?php echo $config['carrocel_cor_hover_btn']; ?> !important;
}
#CaroulselCatalogoProduto<?php echo $uniqid; ?> .product-body h6{
  color: <?php echo $config['carrocel_cor_titulo']; ?> !important;
}
#CaroulselCatalogoProduto<?php echo $uniqid; ?> .product-body h6:hover{
  color: <?php echo $config['carrocel_cor_hover_titulo']; ?> !important;
}
#CaroulselCatalogoProduto<?php echo $uniqid; ?> .product-body p{
  color: <?php echo $config['carrocel_cor_descricao']; ?> !important;
}
#CaroulselCatalogoProduto<?php echo $uniqid; ?> .owl-next, #CaroulselCatalogoProduto<?php echo $uniqid; ?> .owl-prev{
  background-color: <?php echo $config['carrocel_cor_setas']; ?> !important;
}
#CaroulselCatalogoProduto<?php echo $uniqid; ?> .owl-next:hover, #CaroulselCatalogoProduto<?php echo $uniqid; ?> .owl-prev:hover{
  background-color: <?php echo $config['carrocel_cor_hover_setas']; ?> !important;
}
</style>

<div class="row">
  <div class="span12 shop--list">
    <div id="CaroulselCatalogoProduto<?php echo $uniqid; ?>" class="cpe-product-calousel owl-carousel owl-theme">
      <?php if(is_array($produtos)){ foreach ($produtos as $produto) {
        $nome_arquivo    = $produto['url'].'-'.$produto['id'].".html";
        $url             = ConfigPainel('site_url').$nome_arquivo;
      ?>
        <div class="cpe-product-item">
          <div class="product-thumb">
            <a href="<?php echo $url; ?>">
              <img src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>wa/ecommerce/uploads/<?php echo $produto['id_foto_capa']; ?>" alt="Foto Produto <?php echo $produto['nome']; ?>">
            </a>
          </div>
          <div class="product-body">
            <h6><a href="<?php echo $url; ?>"><?php echo $produto['nome']; ?></a></h6>
            <p><?php echo $produto['resumo']; ?></p>
            <div class="product-buttons">
              <a href="<?php echo $url; ?>" class="cpe-button cpe-detail-button cpe-button-2x"><?php echo $produto['btn_texto']; ?></a>
            </div>
          </div>
        </div>
      <?php } } ?>
    </div>
  </div>
</div>
