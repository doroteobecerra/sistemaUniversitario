<?php

require 'config.php';

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

$setName= 'mensualidad de: ' . date('F');

$precio = $_POST['precio'];
$precio = (int) $precio;

$compra = new Payer();
$compra->setPaymentMethod('paypal');

$articulo = new Item();
$articulo->setName($setName)
         ->setCurrency('MXN')
         ->setQuantity(1)
         ->setPrice($precio);

$listaArticulos = new ItemList();
$listaArticulos->setItems(array($articulo));

$detalles = new Details();
$detalles->setShipping(0)
         ->setSubtotal($precio);

$cantidad = new Amount();
$cantidad->setCurrency('MXN')
         ->setTotal($precio)
         ->setDetails($detalles);

$transaccion = new Transaction();
$transaccion->setAmount($cantidad)
            ->setItemList($listaArticulos)
            ->setDescription('Pago Colegiatura')
            ->setInvoiceNumber(uniqid());

$redireccionar = new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO, "/pago_finalizado.php?exito=true")
              ->setCancelUrl(URL_SITIO, "/pago_finalizado.php?exito=false");

$pago = new Payment();
$pago->setIntent("sale")
     ->setPayer($compra)
     ->setRedirectUrls($redireccionar)
     ->setTransactions(array($transaccion));

     try{
          $pago->create($apiContext);
     }catch(PayPal\Exception\PayPalConnectionException $pce){
         echo "<pre>";
         print_r(json_decode($pce->getData()));
         exit;
         echo "</pre>";

     }

     $aprobado = $pago->getApprovalLink();

     header("Location: {$aprobado}");
     