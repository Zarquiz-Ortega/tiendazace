<?php

//configuraciones del sistema
define("SITE_URL","http://localhost/tiendazace/tienda_zace_cliente/");
define("KEY_TOKEN","");
define("MONEDA","$");


//Configuraciones Paypal
define("CLIENT_ID","");
define("CURRENCY","MXN");

//Configuraciones Mercado pago 
define("TOKEN_MP","");
define("PUBLIC_KEY_MP","");
define("LOCALE_MP","es-MX");


//correos
define("MAIL_HOST","");
define("MAIL_USER","");
define("MAIL_PASS","");
define("MAIL_PORT","");

session_start();

$num_cart = 0;

if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}

?>
