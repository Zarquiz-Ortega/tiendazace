<?php

require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';

$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';
print_r($id);
print_r($token);

if ($id == '' || $token = '') {
    header("location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tieda ZACE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/estilos.css" rel="stylesheet">
</head>

<body>

    <?php include 'menu.php'; ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="display-3">
                        <center> Activacion de cuenta</center>
                    </h1>
                </div>
                <div class="col">
                    <p class="text-center">
                        Al activar tu cuenta confirmas tu correo electronico. <br>
                    </p>
                </div>
            </div>
            <div class="col">
                <h3 class="text-center"><?php echo validaToken($id, $token, $con); ?></h3>
            </div>
        </div>
    </main>
</body>

</html>