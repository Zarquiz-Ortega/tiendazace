<?php

require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';

$user_id = $_GET['id'] ?? $_POST['user_id'] ?? '';
$token = $_GET['token'] ?? $_POST['token'] ?? '';

if ($user_id == '' || $token == '') {
    header("location: index.php");
    exit;
}

$db = new Database();
$con = $db->conectar();

$errors = [];

if (!verificaTokenRequest($user_id, $token, $con)) {
    echo "No se pudo verifacar la información.";
    exit;
}

if (!empty($_POST)) {

    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    if (esNulo([$user_id, $token, $password, $repassword])) {
        $errors[] = "Deve llenar todos los campos.";
    }
    if (!validaPassword($password, $repassword)) {
        $errors[] = "Las contraseñas no coinciden.";
    }

    if (count($errors) == 0) {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        if (actualizaPassword($user_id, $pass_hash, $con)) {
            echo "Contraseña modificada.<br> <a href='login.php'>Iniciar sesión </a>";
            exit;
        } else {
            $errors[] = "Error al modificar contraseña. Intentalo nuevamente";
        }
    }
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

    <main class="form-login m-auto pt-4">
        <h3>Cambiar contraseña</h3>

        <?php mostrarMensajes($errors); ?>

        <form action="reset_password.php" method="post" class="row g-3" autocomplete="off">

            <input type="hidden" name="user_id" id="user_id" value="<?= $user_id; ?>" />
            <input type="hidden" name="token" id="token" value="<?= $token; ?>" />

            <div class="form-floating">
                <input class="form-control" type="password" name="password" id="password" placeholder="Nueva contraseña" require>
                <label for="Nueva contraseña">Nueva contraseña</label>
            </div>

            <div class="form-floating">
                <input class="form-control" type="password" name="repassword" id="repassword" placeholder="Confirmar contraseña" require>
                <label for="Confirmar contraseña">Confirmar contraseña</label>
            </div>

            <div class="d-grid gap-3 col-12">
                <button class="btn btn-primary" type="submit">Continuar</button>
            </div>

            <hr>

            <div class="col-12">
                <a href="login.php">Iniciar sesión</a>
            </div>
        </form>
    </main>



    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>