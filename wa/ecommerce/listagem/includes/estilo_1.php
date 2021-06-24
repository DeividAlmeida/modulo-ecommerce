<!-- External Css -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<style>
.swal2-popup{
  font-size: 14px !important;
}
.shop--modal-add-product__btn{
  border: 0 !important;
  margin-top:10px !important;
  background-color: <?php echo $config['carrinho_cor_btns']; ?> !important;
}

#shop--list<?php echo $uniqid; ?> .swal2-popup{
  font-size: 14px !important;
}
#shop--list<?php echo $uniqid; ?> .shop--list--bar{
  width: 100%;
  text-align: right;
}
#shop--list<?php echo $uniqid; ?> .shop--list--bar__btn{
  font-size: 1.5em;
  color: #000;
  opacity: 0.5;
  margin: 0 5px;
}
#shop--list<?php echo $uniqid; ?> .shop--list--bar__btn:hover{
  opacity: 1;
}
#shop--list<?php echo $uniqid; ?> .shop--list--bar__btn.is-active{
  opacity:1;
}
#shop--list<?php echo $uniqid; ?> .shop--product__wrapper {
  background: #ffffff;
  border: 1px solid #e5e5e5;
  border-radius: 8px;
  overflow: hidden;
  position: relative;
  margin: 15px 0;
}
#shop--list<?php echo $uniqid; ?> .shop--product__name {
  color: #383838;
  font-size: 16px;
  margin: 6px 0;
  padding: 0;
  float: left;
  width: 100%;
  overflow: hidden;
  text-overflow: ellipsis;
}
#shop--list<?php echo $uniqid; ?> .shop--product__name a {
  white-space: nowrap;
}

#shop--list<?php echo $uniqid; ?> .shop--product__price {
  color: #383838;
  font-size: 18px;
  font-weight: 600;
  margin: 0;
  padding: 0 0 15px;
  clear: both;
}

#shop--list<?php echo $uniqid; ?> .shop--product__price a {
  white-space: nowrap;
}
#shop--list<?php echo $uniqid; ?> .shop--product__tag {
  background-color: #666;
  border-radius: 100%;
  color: #fff;
  display: inline-block;
  font-size: 12px;
  font-weight: bold;
  height: 40px;
  left: 20px;
  letter-spacing: 1px;
  line-height: 40px;
  position: absolute;
  text-align: center;
  text-transform: uppercase;
  top: 20px;
  width: 40px;
}
#shop--list<?php echo $uniqid; ?> .shop--product__img img {
  max-width: 100%;
  max-height: 100%;
}
#shop--list<?php echo $uniqid; ?> .shop--product__secondary-img{
  left: 0;
  opacity: 0;
  position: absolute;
  right: 0;
  top: 0;
  transition: all 500ms ease-in-out 0s;
}
#shop--list<?php echo $uniqid; ?> .shop--product__wrapper:hover .shop--product__action, #shop--list<?php echo $uniqid; ?> .shop--product__wrapper:hover .shop--product__secondary-img {
  opacity: 1;
}
#shop--list<?php echo $uniqid; ?> .shop--product__wrapper:hover .shop--product__img{
  opacity: 0.8;
}
#shop--list<?php echo $uniqid; ?> .shop--product__action{
  bottom: 80px;
  display: inline-block;
  left: 0;
  opacity: 0;
  padding: 0 20px;
  position: absolute;
  right: 0;
  text-align: center;
  transition: all 0.3s ease 0s;
}
#shop--list<?php echo $uniqid; ?> .shop--product__action a, #shop--list<?php echo $uniqid; ?> .shop--product__btn a{
  color: #fff !important;
  border: none;
  border-radius: 50%;
  padding: 5px 7px;
}
#shop--list<?php echo $uniqid; ?> .shop--product__content{
  text-align: center;
  padding: 0 15px;
}


#shop--list<?php echo $uniqid; ?> .shop--list__content.is-grid .shop--product__resume, #shop--list<?php echo $uniqid; ?> .shop--list__content.is-grid .shop--product__btn, #shop--list<?php echo $uniqid; ?> .shop--list__content.is-list .shop--product__action{
  display:none;
}

#shop--list<?php echo $uniqid; ?> .shop--list__content.is-list .shop--product__resume{
  display: block;
  color: #818181;
  font-size: 16px;
  line-height: 30px;
  margin: 0;
}
#shop--list<?php echo $uniqid; ?> .shop--list__content.is-list .shop--product__wrapper{
  display: flex;
  margin: 7.5px 0;
}
#shop--list<?php echo $uniqid; ?> .shop--list__content.is-list .shop--product__img{
  flex: 0 0 200px;
  max-width: 200px;
}
#shop--list<?php echo $uniqid; ?> .shop--list__content.is-list .shop--product__content{
  margin-left: 20px;
  text-align: left;
}

#shop--list<?php echo $uniqid; ?> .shop--product__name a{
  color: <?php echo $config['listagem_cor_titulo']; ?> !important;
}
#shop--list<?php echo $uniqid; ?> .shop--product__price{
  color: <?php echo $config['listagem_cor_preco']; ?> !important;
}
#shop--list<?php echo $uniqid; ?> .shop--product__wrapper{
  border-color: <?php echo $config['listagem_cor_borda']; ?> !important;
}
#shop--list<?php echo $uniqid; ?> .shop--product__action a, .shop--product__btn a{
  background-color: <?php echo $config['listagem_cor_botao']; ?> !important;
}
#shop--list<?php echo $uniqid; ?> .shop--product__action a:hover, .shop--product__btn a:hover{
  background-color: <?php echo $config['listagem_cor_hover_botao']; ?> !important;
}
#shop--list<?php echo $uniqid; ?> .shop--list--bar__btn{
  color: <?php echo $config['listagem_cor_filtro']; ?> !important;
}
.trimText{
    white-space: nowrap;
    overflow: hidden; 
    text-overflow: ellipsis
}
</style>

<div id="shop--list<?php echo $uniqid; ?>" class="wow <?php echo $lista['efeito']; ?> shop--list__wrapper">

  <?php if($lista['mostrar_filtro'] == 'S'){  ?>
    <div class="shop--list--bar">
      <a class="shop--list--bar__btn shop--list--bar__view-grid is-active"><span class="fa fa-th-large"></span></a>
      <a class="shop--list--bar__btn shop--list--bar__view-list"><span class="fa fa-th-list"></span></a>
    </div>
  <?php } ?>
  <div class="shop--list__content is-grid">
    <div class="row" style="display: flex; flex-wrap: wrap;">
      <?php foreach ($produtos as $produto) {
        $nome_arquivo    = $produto['url'].'-'.$produto['id'].".html";
        $url             = ConfigPainel('site_url').$nome_arquivo;

        $segunda_foto = DBRead('ecommerce_prod_imagens','uniq',"WHERE id_produto = '{$produto['id']}' AND id != {$produto['id_imagem_capa']}");

        if(is_array($segunda_foto)){
          $segunda_foto = $segunda_foto[0]['uniq'];
        }
        else{
          $segunda_foto = false;
        }
      ?>
        <div class="shop--product col-md-<?php echo $tamanho_coluna; ?> trimText">
          <div class="shop--product__wrapper">
            <div class="shop--product__img">
              <a href="<?php echo $url;?>">
                <img class="shop--product__primary-img" src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>wa/ecommerce/uploads/<?php echo $produto['id_foto_capa']; ?>" alt="Foto Produto <?php echo $produto['nome']; ?> 1">

                <?php if($segunda_foto){ ?>
                  <img class="shop--product__secondary-img" src="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>wa/ecommerce/uploads/<?php echo $segunda_foto; ?>" alt="Foto Produto <?php echo $produto['nome']; ?> 2">
                <?php } ?>
              </a>

              <div class="shop--product__action">
                <a class="btn btn-primary btn-lg" href="<?php echo $url;?>"><span class="fa fa-eye"></span></a>
              </div>
            </div>
            <div class="shop--product__content">
              <h4 class="shop--product__name">
                <a href="<?php echo $url;?>"><?php echo $produto['nome']; ?></a>
              </h4>
              <div class="shop--product__price">
                <?php if($produto['a_consultar'] == 'S') {?>
                  A consultar
                <?php } else { ?>
                  <?php echo $config['moeda'].' '.number_format($produto['preco'],2,",","."); ?>
                <?php } ?>
              </div>
              <div class="shop--product__resume">
                <?php echo $produto['resumo']; ?>
              </div>
              <div class="shop--product__btn">
                <a class="btn btn-primary" <?php echo (!empty($produto['link_venda'])) ? "href='{$produto["link_venda"]}'" : 'onclick="CarrinhoAdd('.$produto["id"].', '."'{$config["pagina_carrinho"]}'".')"'; ?>><span class="fa fa-cart-plus"></span></a>
                <a class="btn btn-primary" href="<?php echo $url;?>"><span class="fa fa-eye"></span></a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
