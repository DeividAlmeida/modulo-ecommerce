<?php ob_start(); ?>

<div id="EcommerceMaisVistos" ></div>
<script type="text/javascript">EcommerceMaisVistos(<?php echo $produto['id']; ?>,1);</script>
              
<?php
$html = ob_get_clean();
$matriz = str_replace('[WAC_ECOMMERCE_LISTA_PROD_MAIS_VISTOS]', $html, $matriz);
