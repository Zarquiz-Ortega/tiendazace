<?php 

require 'vendor/autoload.php';

MercadoPago\SDK::setAccessToken('TEST-5518880316568114-120218-27c9e71f4ef8ed490f7c7284cc065ad5-313808390');

$preference = new MercadoPago\Preference();

$item = new MercadoPago\Item();
$item->id= '0001';
$item->title = 'productos ZACE';
$item->quantity = 1;
$item->unit_price= 150.00;
$item->currency_id = 'MXN';

$preference->items = array($item);

$preference->back_urls = array(
    "success" => "http://localhost/tiendazace/captura.php",
    "failure" => "http://localhost/tiendazace/fallo.php"
);
$preference->auto_return = "approved";
$preference->binary_mode = true;

$preference->save();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>
    <h3>Mercado Pago</h3>

    <div class="checkout-btn"></div>

    <script>
        const mp = new MercadoPago('TEST-856713d4-6ee7-4b9c-b5ca-4af647e960d6',{
            locale: 'es-MX'
        });

        mp.checkout({
            preference: {
                id: '<?php echo $preference->id; ?>'
            },
            render: {
                container: '.checkout-btn',
                label: 'Pagar con MP'
            }
        })
    </script>
</body>
</html>