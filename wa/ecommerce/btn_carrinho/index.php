<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once(dirname(__FILE__).'/../../../includes/funcoes.php');
require_once(dirname(__FILE__).'/../../../database/config.database.php');
require_once(dirname(__FILE__).'/../../../database/config.php');
require_once(dirname(__FILE__).'/../carrinho/functions.php');

$query = DBRead('ecommerce_config','*');

$config = [];
foreach ($query as $key => $row) {
  $config[$row['id']] = $row['valor'];
}

$total_itens = 0;
if(!empty($_SESSION["cart"])){
  foreach($_SESSION["cart"] as $qtd){
    $total_itens += $qtd;
  }
}
?>
<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>/wa/ecommerce/assets/css/btn_carrinho.css">
<style>
.shop--cart-dropdown .dropdown-toggle{
  color: <?php echo $config['btn_carrinho_cor_btn_meu_carrinho']; ?> !important;
}
.shop--cart-dropdown .dropdown-menu{
  background-color: <?php echo $config['btn_carrinho_cor_fundo']; ?> !important;
  color: <?php echo $config['btn_carrinho_cor_texto']; ?> !important;
}
.shop--cart-dropdown--footer .btn{
  background-color: <?php echo $config['btn_carrinho_cor_btn_ver_carrinho']; ?> !important;
  color: <?php echo $config['btn_carrinho_cor_texto_btn_ver_carrinho']; ?> !important;
}
.shop--cart-dropdown--footer .btn:hover{
  background-color: <?php echo $config['btn_carrinho_cor_hover_btn_ver_carrinho']; ?> !important;
}
.container, .container-fluid{
  overflow-x: visible !important;
}
</style>

<div class="dropdown shop--cart-dropdown">
  <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="fa fa-shopping-cart"></span> Carrinho (<?php echo $total_itens; ?>)
  </span>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <?php if(!empty($_SESSION["cart"])){ ?>
      <ul class="shop--cart-dropdown--list">
        <?php
        $total_carrinho = 0;
        $i=0;
        foreach($_SESSION["cart"] as $id => $qtd ) {
          if ($i < 3) {
            $query = DBRead('ecommerce', '*', "WHERE id = $id");
            $produto = $query[0];

            // Carregando Fotos do produto
            $fotos  = DBRead('ecommerce_prod_imagens','*', "WHERE id_produto = {$produto['id']}");

            // Busca pela foto de capa e salva em variavel
            foreach($fotos as $foto){
              if($foto['id'] == $produto['id_imagem_capa']){
                $foto_capa = $foto;
              }
            }

            // URL da imagem da capa
            $url_img_capa = RemoveHttpS(ConfigPainel('base_url'))."wa/ecommerce/uploads/".$foto_capa['uniq'];

            $total_carrinho += $produto['preco']*$qtd;
            $i++;
          ?>
          <li class="shop--cart-dropdown--list__item">
            <div>
              <img src="<?php echo $url_img_capa ?>" alt="Foto Produto <?php echo $produto['nome']; ?>" width="80" class="shop--cart-dropdown--list__img">
            </div>
            <div>
              <h4 class="shop--cart-dropdown--list__title"><?php echo $produto['nome']; ?></h4>
              <div class="shop--cart-dropdown--list__qty"><?php echo $qtd; ?></div>
              <div class="shop--cart-dropdown--list__price"><?php echo $config['moeda'].' '.number_format(number_format($produto['preco'],2,",",".")*$qtd, 2, ',', '.'); ?></div>
            </div>
          </li>
        <?php } else { ?>
          <li class="shop--cart-dropdown--list__last-item"> ... </li>
        <? } } ?>
      </ul>

      <div class="shop--cart-dropdown--footer">
        <a class="btn btn-primary btn-block" href="<?php echo $config["pagina_carrinho"]; ?>">Ver Carrinho</a>
      </div>
    <?php } else { ?>
      <p class="shop--cart-dropdown__empty">Seu carrinho está vazio.</p>
    <?php } ?>
  </div>
</div>
