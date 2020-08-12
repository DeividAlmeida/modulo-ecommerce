<?php ob_start(); ?>

<div id="EcommerceRelacionadosListagem" ></div>
<script type="text/javascript">EcommerceRelacionadosListagem(<?php echo $produto['id']; ?>,1);</script>
              
<?php
$html = ob_get_clean();
$matriz = str_replace('[WAC_ECOMMERCE_LISTA_PROD_RELACIONADOS]', $html, $matriz);
