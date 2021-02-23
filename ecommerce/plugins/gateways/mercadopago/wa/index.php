<?php
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';
$reading =  DBRead('ecommerce_mercadopago','*', "WHERE id = '1'")[0];

// Configura credenciais
MercadoPago\SDK::setAccessToken($reading['token']);

$preference = new MercadoPago\Preference();

$shipments = new MercadoPago\Shipments();
$frete =   floatval($_POST['vl_frete']);
$shipments->cost = $frete;

  
# Building an item

    foreach($read as $r){
        $pdt = json_decode($r['produto'], true);
        foreach($pdt as $key => $fds){
        

            $item[$key] = new MercadoPago\Item();
            $item[$key] ->id = $fds['id_pdt'];
            $item[$key] ->title = $fds['produto_pg']; 
            $item[$key] ->quantity = $fds['qtd'];
            $item[$key] ->unit_price = $fds['un_valor'];
           
          
        }
    }
    $itens = array_merge($item);

  $preference->items  = $itens;


$preference->shipments = $shipments;
$preference->save(); # Save the preference and send the HTTP Request to create

# Return the HTML code for button
header('Location:'.$preference->init_point);
