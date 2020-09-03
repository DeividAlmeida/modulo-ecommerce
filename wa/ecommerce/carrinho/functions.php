<?php
session_start();

function CarrinhoAddQtd($id, $qtd, $vlf, $att){
  $_SESSION["car"][$att] = [$id, $qtd, $vlf,];

  $query         = DBRead('ecommerce', "WHERE id = {$id}");
  $contagem_cart = $query[0]['count_add_cart'];

  DBUpdate('ecommerce', array('count_add_cart' => $contagem_cart + 1), "id = {$id}");
}

function CarrinhoRemQtd($id, $qtd){
  if(isset($_SESSION["car"][$id])){
    $qtd_final = $_SESSION["car"][$id] - $qtd;

    if($qtd_final <= 0){
      unset($_SESSION["car"][$id]);
    }
  }
}

function CarrinhoRemItem($id){
  unset($_SESSION["car"][$id]);
}

function CarrinhoUpdate($id, $ptd, $qtd, $vlf){
  $_SESSION["car"][$id] = [$vlf, $ptd, $qtd];

  if($qtd <= 0){
    unset($_SESSION["car"][$id]);
  }
}
