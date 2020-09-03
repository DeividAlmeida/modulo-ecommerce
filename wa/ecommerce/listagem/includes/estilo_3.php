<!-- External Css -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<style>
.swal2-popup{
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
  overflow: hidden;
  position: relative;
  margin: 15px 0;
}
#shop--list<?php echo $uniqid; ?> .shop--product__name {
  color: #383838;
  font-size: 16px;
  font-weight: 400;
  margin-bottom: 6px;
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
#shop--list<?php echo $uniqid; ?> .shop--product__wrapper:hover .shop--product__img{
  opacity: 0.8;
}
#shop--list<?php echo $uniqid; ?> .shop--product__content{
  position: relative;
  text-align: center;
  padding: 0 15px;
  padding-top: 30px;
}
#shop--list<?php echo $uniqid; ?> .shop--product__info, #shop--list<?php echo $uniqid; ?> .shop--product__action{
  position: relative;
  width: 100%;
}
#shop--list<?php echo $uniqid; ?> .shop--product__wrapper .btn-buy{
  transition: all 250ms ease-in-out 0s;
  display:none;
}
#shop--list<?php echo $uniqid; ?> .shop--product__wrapper:hover .btn-buy{
  display: inline;
}
#shop--list<?php echo $uniqid; ?> .shop--product__action a, #shop--list<?php echo $uniqid; ?> .shop--product__btn a{
  color: #fff !important;
  border: none;
  border-radius: 30px;
  padding: 8px 13px;
}

.shop--modal-add-product__btn{
  border: 0 !important;
  margin-top:10px !important;
  background-color: <?php echo $config['carrinho_cor_btns']; ?> !important;
}
#shop--list<?php echo $uniqid; ?> .shop--product__name a{
  color: <?php echo $config['listagem_cor_titulo']; ?> !important;
}
#shop--list<?php echo $uniqid; ?> .shop--product__price{
  color: <?php echo $config['listagem_cor_preco']; ?> !important;
}
#shop--list<?php echo $uniqid; ?> .shop--product__action a, .shop--product__btn a{
  color: <?php echo $config['listagem_cor_botao']; ?> !important;
  border: 1px solid <?php echo $config['listagem_cor_botao']; ?> !important;
  background-color:#fff;
}
#shop--list<?php echo $uniqid; ?> .shop--product__action a:hover, .shop--product__btn a:hover{
  color: <?php echo $config['listagem_cor_hover_botao']; ?> !important;
  border-color: <?php echo $config['listagem_cor_hover_botao']; ?> !important;
}
.trimText{
    white-space: nowrap;
    overflow: hidden; 
    text-overflow: ellipsis
}
</style>

<div id="shop--list<?php echo $uniqid; ?>" class="wow <?php echo $lista['efeito']; ?> shop--list__wrapper">

  <div class="shop--list__content">
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
            </div>
            <div class="shop--product__content">
              <div class="shop--product__info">
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
              </div>
              <div class="shop--product__action">
                <a class="btn-see btn btn-primary" href="<?php echo $url;?>">Ver Produto</a>
              </div>
            </div>
            
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
