<?php
require 'config/config.php';
require 'config/database.php';

$db = new Database();
$con = $db->conectar();

if (isset($_SESSION['user_id'])) {
    $id_transaccion =  isset($_GET['key']) ? $_GET['key'] : 0;

    $eror = '';

    if ($id_transaccion == '') {
        $eror = 'Error al procesar la peticion';
    } else {
        $sql = $con->prepare("SELECT id, fecha, email, total FROM compra WHERE id_transaccion=? AND status=? LIMIT 1");
        $sql->execute([$id_transaccion, 'COMPLETED']);
        if ($sql->fetchColumn() > 0) {

            $sql = $con->prepare("SELECT id, fecha, email, total FROM compra WHERE id_transaccion=? AND status=? LIMIT 1");
            $sql->execute([$id_transaccion, 'COMPLETED']);
            $row = $sql->fetch(PDO::FETCH_ASSOC);

            $idcompra = $row['id'];
            $total = $row['total'];
            $fecha = $row['fecha'];

            $sqlDet = $con->prepare("SELECT nombre, precio, cantidad FROM detalle_compra WHERE id_compra = ?");
            $sqlDet->execute([$idcompra]);
        } else {
            $eror = 'Error al realizar la compra';
        }
    }
} else {
    header("Location: index.php");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>

    <?php include 'menu.php'; ?>

    <main>
        <div class="container">
            <?php if (strlen($eror) > 0) { ?>
                <div class="row">
                    <div class="col">
                        <h3><?php echo $eror; ?></h3>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="col-12">
                        <h1 class="display-3"><b>
                                <center> Gracias por su compra</center>
                            </b></h1><br>
                        <p></p>
                    </div>
                    <div class="col">
                        <b>Folio de la compra: </b> <?php echo $id_transaccion; ?> <br>
                        <b>Fecha de compra: </b> <?php echo $fecha; ?> <br>
                        <b>Total de la compra: </b> <?php echo  MONEDA . number_format($total, 2, '.', ','); ?> <br>
                        <p></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Producto</th>
                                    <th>Importe</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row_det = $sqlDet->fetch(PDO::FETCH_ASSOC)) {
                                    $importe = $row_det['precio'] * $row_det['cantidad']; ?>
                                    <tr>
                                        <td><?php echo $row_det['cantidad']; ?></td>
                                        <td><?php echo $row_det['nombre']; ?></td>
                                        <td><?php echo MONEDA . number_format($importe, 2, '.', ','); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="index.php" class="btn btn-outline-dark">Volver al inicio</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
</body>

</html>