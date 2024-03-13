<?php

//configuraciones del sistema
define("SITE_URL","http://localhost/tiendazace/tienda_zace_cliente/");
define("KEY_TOKEN","APR.wqc-354*");
define("MONEDA","$");


//Configuraciones Paypal
define("CLIENT_ID","AWMtdFgQTcYR_82X9JlX6SpJxNqpKWoncN7XxxGB2Q8BIvqctlsZl2ro44yZu092zzZGRkJIFFe6N5sm");
define("CURRENCY","MXN");

//Configuraciones Mercado pago 
define("TOKEN_MP","TEST-5518880316568114-120218-27c9e71f4ef8ed490f7c7284cc065ad5-313808390");
define("PUBLIC_KEY_MP","");
define("LOCALE_MP","es-MX");


//correos
define("MAIL_HOST","smtp.gmail.com");
define("MAIL_USER","tiendazace@gmail.com");
define("MAIL_PASS","bptfanyxtjncgsfq");
define("MAIL_PORT","465");

session_start();

$num_cart = 0;

if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}

?>