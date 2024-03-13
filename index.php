<?php

require 'config/config.php';
require 'config/database.php';

$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id, nombre, precio, descuento  FROM productos WHERE activo=1");
$sql->execute();
$resuldado = $sql->fetchAll(PDO::FETCH_ASSOC);

//session_destroy(); //vacia el carrito
//print_r($_SESSION);  //imprime el arry del carrito

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
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/fef978e8e6.js" crossorigin="anonymous"></script>

</head>

<body>

    <?php include 'menu.php'; ?>

    <main>
        <div class="container mb-2">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-sm-5 g-3">
                <?php foreach ($resuldado as $row) {
                    $descuento = $row['descuento'];
                    $precio = $row['precio'];
                    $precio_desc = $precio - (($precio * $descuento) / 100);
                ?>
                    <div class="col">
                        <div class="card shadow-sm ">
                            <?php
                            $id = $row['id'];
                            $imagen = "images/productos/" . $id . "/principal.png";

                            if (!file_exists($imagen)) {
                                $imagen = "images/no-photo.png";
                            }
                            ?>
                            <img src="<?php echo $imagen; ?>" style="max-width: 250px; height: auto;" class="img-thumbnail">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $row['nombre']; ?>
                                </h5>
                                <?php if ($descuento > 0) { ?>
                                    <p><del><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></del></p>
                                    <h2>
                                        <?php echo MONEDA . number_format($precio_desc, 2, '.', ','); ?>
                                        <small class="text-success"><?php echo $descuento ?>% descuento</small>
                                    </h2>

                                <?php } else { ?>
                                    <h2><?php echo MONEDA . number_format($precio, 2, '.', ','); ?> </h2>
                                <?php } ?>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>" class="btn btn-primary">Detalles</a>
                                    </div> &nbsp;
                                    <button class="btn btn-outline-success" type="button" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">
                                    <i class='bx bx-cart-add bx-sm'></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <?php include 'foother.php'; ?>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        function addProducto(id, token) {
            let url = 'clases/carrito.php'
            let formData = new FormData()
            formData.append('id', id)
            formData.append('token', token)

            fetch(url, {
                    method: 'POST',
                    body: formData,
                    mode: 'cors'
                }).then(response => response.json())
                .then(data => {
                    if (data.ok) {
                        let elemento = document.getElementById("num_cart")
                        elemento.innerHTML = data.numero
                    }
                })
        }
    </script>
</body>

</html>