<?php
session_start();

function CarrinhoAddQtd($id, $qtd, $vlf, $att){
  $_SESSION["cart"][$att] = [$id, $qtd, $vlf,];

  $query         = DBRead('ecommerce', "WHERE id = {$id}");
  $contagem_cart = $query[0]['count_add_cart'];

  DBUpdate('ecommerce', array('count_add_cart' => $contagem_cart + 1), "id = {$id}");
}

function CarrinhoRemQtd($id, $qtd){
  if(isset($_SESSION["cart"][$id])){
    $qtd_final = $_SESSION["cart"][$id] - $qtd;

    if($qtd_final <= 0){
      unset($_SESSION["cart"][$id]);
    }
  }
}

function CarrinhoRemItem($id){
  unset($_SESSION["cart"][$id]);
}

function CarrinhoUpdate($id, $ptd, $qtd, $vlf){
  $_SESSION["cart"][$id] = [$vlf, $ptd, $qtd];

  if($qtd <= 0){
    unset($_SESSION["cart"][$id]);
  }
}
