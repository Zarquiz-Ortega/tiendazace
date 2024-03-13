<?php
require 'config/config.php';

$payment =  $_GET['payment_id'];
$status =  $_GET['status'];
$payment_type =  $_GET['payment_type'];
$order_id =  $_GET['merchant_order_id'];

echo "<h3> Pgo Exitoso </h3>";

echo $payment."<br>";
echo $status."<br>";
echo $payment_type."<br>";
echo $order_id."<br>";

unset($_SESSION['carrito']);
/*http://localhost/tiendazace/captura.php?collection_id=1311143949&collection_status=approved&
payment_id=1311143949&
status=approved&
external_reference=null&
payment_type=credit_card&
merchant_order_id=6702379517&preference_id=313808390-8679c98d-f943-4b09-b399-95981958e133&
site_id=MLM&processing_mode=aggregator&
merchant_account_id=null */