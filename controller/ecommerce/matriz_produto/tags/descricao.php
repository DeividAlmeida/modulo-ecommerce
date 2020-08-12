<?php
ob_start();
?>
<style>
.shop--product-page__description{
  color: <?php echo $config['produto_cor_texto_descricao']; ?>;
}
</style>
<div class="shop--product-page__description">
  <?php echo $produto['descricao']; ?>
</div>
<?php
$descricao = ob_get_clean();
$matriz = str_replace('[WAC_ECOMMERCE_PROD_DESCRICAO]', $descricao, $matriz);
