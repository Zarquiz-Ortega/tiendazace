<?php

require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';

$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)) {

    $email = trim($_POST['email']);

    if (esNulo([$email])) {
        $errors[] = "Deve llenar todos los campos.";
    }
    if (!esEmail($email)) {
        $errors[] = "La dirección de correo $email no es valida.";
    }
    if (count($errors) == 0) {
        if (emailExiste($email, $con)) {
            $sql = $con->prepare("SELECT usuarios.id, clientes.nombres FROM usuarios 
            INNER JOIN clientes ON usuarios.id_cliente=clientes.id
            WHERE clientes.email LIKE ? LIMIT 1");
            $sql->execute([$email]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $user_id = $row['id'];
            $nombres = $row['nombres'];

            $token = solicitaPassword($user_id, $con);

            if ($token !== null) {
                require 'clases/Mailer.php';
                $mailer = new Mailer();

                $url = SITE_URL . '/reset_password.php?id=' . $user_id . '&token=' . $token;
                $asunto = "Recuperar password - Tienda ZACE";
                $cuerpo = " Estimado $nombres: <br> Si has solicitado el cambio de tu
                contaseña de clic en el siguiente link <a href = '$url' >$url</a>.";
                $cuerpo .= "<br>Si no hiciste esta solicitud puedes ignorar este correo.";

                if ($mailer->enviarEmail($email, $asunto, $cuerpo)) {
                    echo "<p><b>Correo enviado</b></p>";
                    echo "<p>Hemos enviadso un correo electrónico a la dirección $email para restablecer la contraseña </p>";
                    exit;
                }
            }
        } else {
            $errors[] = "No existe una cuenta asociada a esta dirección de correo.";
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
        <h3>Recuperar contraseña</h3>

        <?php mostrarMensajes($errors); ?>

        <form action="recupera.php" method="post" class="row g-3" autocomplete="off">
            <div class="form-floating">
                <input class="form-control" type="email" name="email" id="email" placeholder="Correo electronico" require>
                <label for="Correo electronico">Correo electrónico</label>
            </div>

            <div class="d-grid gap-3 col-12">
                <button class="btn btn-primary" type="submit">Continuar</button>
            </div>

            <hr>

            <div class="col-12">
                ¿No tienes cuenta? <a href="registro.php">Registrate aqui!</a>
            </div>
        </form>
    </main>



    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>