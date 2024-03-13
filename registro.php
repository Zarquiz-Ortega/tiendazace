<?php

require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';

$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)) {

    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $matricula = trim($_POST['matricula']);
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);
    $idCarrera = $_POST['carrera'];
    $idGrupo = $_POST['grupo'];

    if (esNulo([$nombres, $apellidos, $email, $telefono, $matricula, $idCarrera, $idGrupo])) {
        $errors[] = "Deve llenar todos los campos.";
    } else {

        if (!esEmail($email)) {
            $errors[] = "La dirección de correo $email no es valida.";
        }

        if (!validaPassword($password, $repassword)) {
            $errors[] = "Las contraseñas no coinciden.";
        }

        if (usuarioExiste($usuario, $con)) {
            $errors[] = "El nombre de usuario $usuario ya se encuantra registrada.";
        }

        if (emailExiste($email, $con)) {
            $errors[] = "El correo electronico $email ya se encuantra registrada.";
        }
        if (matriculaExiste($matricula, $con)) {
            $errors[] = "la matricula $matricula ya se encuantra registrada.";
        }

        if (count($errors) == 0) {

            $id = registraCliente([$nombres, $apellidos, $email, $telefono, $matricula, $idCarrera, $idGrupo], $con);


            if ($id > 0) {

                require 'clases/Mailer.php';
                $mailer = new Mailer();
                $token = generarToken();
                $pass_hash = password_hash($password, PASSWORD_DEFAULT);

                $idUsuario = registraUsuario([$usuario, $pass_hash, $token, $id], $con);
                if ($idUsuario > 0) {

                    $url = SITE_URL . '/activa_cliente.php?id=' . $idUsuario . '&token=' . $token;
                    $asunto = "Activa tu cuenta - Tienda ZACE";
                    $cuerpo = " Estimado $nombres: <br> Para continuar con el proceso de registro es indispensable de click en la siguiente liga <a href='$url'>Activar cuenta</a>";

                    if ($mailer->enviarEmail($email, $asunto, $cuerpo)) {
                        echo "Para terminar el proceso de registro siga las intruciones que le emos enviado a la direcion de Correo Electornico $email";
                        exit;
                    }
                } else {
                    $errors[] = "Error al registrar Ususario";
                }
            } else {
                $errors[] = "Error al registrar Cliente";
            }
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

    <main>
        <div class="container">
            <h2>Datos del cliente</h2>

            <?php mostrarMensajes($errors) ?>

            <form class="row g-3" action="registro.php" method="post" autocomplete="off">
                <div class="col-md-6">
                    <label for="nombres"><span class="text-danger">*</span> Nombres</label>
                    <input type="text" name="nombres" id="nombres" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="apellidos"><span class="text-danger">*</span> Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="email"><span class="text-danger">*</span> Correo electronico</label>
                    <input type="email" name="email" id="email" class="form-control">
                    <span id="validaEmail" class="text-danger"></span>

                </div>
                <div class="col-md-6">
                    <label for="telefono"><span class="text-danger">*</span> Telefono</label>
                    <input type="tel" name="telefono" id="telefono" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="matricula"><span class="text-danger">*</span> Matricula</label>
                    <input type="text" name="matricula" id="matricula" class="form-control">
                    <span id="validaMatricula" class="text-danger"></span>
                </div>
                <div class="col-md-6">
                    <label for="usuario"><span class="text-danger">*</span> Usuario</label>
                    <input type="text" name="usuario" id="usuario" class="form-control">
                    <span id="validaUsuario" class="text-danger"></span>
                </div>
                <div class="col-md-6">
                    <label for="password"><span class="text-danger">*</span> Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="repassword"><span class="text-danger">*</span> Repetir contraseña</label>
                    <input type="password" name="repassword" id="repassword" class="form-control">
                    <span id="validaPassword" class="text-danger"></span>
                </div>
                <div class="col-md-6">
                    <label for="carrera"><span class="text-danger">*</span> Carrera</label>
                    <select class="form-select form-select-sm" name="carrera" id="carrera">
                        <option>Selecione una opcion</option>
                        <option value="1">Ingeneria en TIC'S</option>
                        <option value="2">Ingeneria industrilal</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="grupo"><span class="text-danger">*</span> Grupo</label> <br>
                    <select class="form-select form-select-sm" name="grupo" id="grupo">
                        <option>Selecione una opcion</option>
                        <option value="1">03IT101</option>
                        <option value="2">03IT102</option>
                        <option value="3">03IT103</option>
                        <option value="4">03IT104</option>
                        <option value="5">03IT105</option>
                        <option value="6">03IT106</option>
                        <option value="7">03IT107</option>
                        <option value="8">03IT108</option>
                        <option value="9">03IT109</option>
                        <option value="10">03II101</option>
                        <option value="11">03II102</option>
                        <option value="12">03II103</option>
                        <option value="13">03II104</option>
                        <option value="14">03II105</option>
                        <option value="15">03II106</option>
                        <option value="16">03II107</option>
                        <option value="17">03II108</option>
                        <option value="18">03II109</option>
                    </select>
                </div>

                <i><b>Nota: </b> Los campos con asterisco (<span class="text-danger">*</span>) son obligatorios </i>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit" data-bs-toggle="modal" data-bs-target="#modificaModal">Registrar</button>
                </div>

            </form>
        </div>
    </main>

    <?php include 'foother.php'; ?>



    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script>
        //elemento Usuario
        let txtUsuario = document.getElementById('usuario')
        txtUsuario.addEventListener("blur", function() {
            existeUsuario(txtUsuario.value)
        }, false)

        //Elemento Email
        let txtEmail = document.getElementById('email')
        txtEmail.addEventListener("blur", function() {
            existeEmail(txtEmail.value)
        }, false)

        //Elemento Mtricula
        let txtMatricula = document.getElementById('matricula')
        txtMatricula.addEventListener("blur", function() {
            existeMatricula(txtMatricula.value)
        }, false)

        //Elemento Contraseñas
        let txtPassword = document.getElementById('password')
        let txtRepassword = document.getElementById('repassword')
        txtRepassword.addEventListener("blur", function() {
            coincidirPassword(txtPassword.value, txtRepassword.value)
        }, false)

        //funcion usuario
        function existeUsuario(usuario) {

            let url = 'clases/clienteAjax.php'
            let formData = new FormData()
            formData.append("action", "existeUsuario")
            formData.append("usuario", usuario)

            fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                .then(data => {

                    if (data.ok) {
                        document.getElementById('usuario').value = ''
                        document.getElementById('validaUsuario').innerHTML = 'Usuario no disponible'
                    } else {
                        document.getElementById('validaUsuario').innerHTML = ''
                    }

                })
        }

        //funcion Email
        function existeEmail(email) {

            let url = 'clases/clienteAjax.php'
            let formData = new FormData()
            formData.append("action", "existeEmail")
            formData.append("email", email)

            fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                .then(data => {

                    if (data.ok) {
                        document.getElementById('email').value = ''
                        document.getElementById('validaEmail').innerHTML = 'Correo electronico ya registrado'
                    } else {
                        document.getElementById('validaEmail').innerHTML = ''
                    }

                })
        }
        //funcion Matricula
        function existeMatricula(matricula) {

            let url = 'clases/clienteAjax.php'
            let formData = new FormData()
            formData.append("action", "existeMatricula")
            formData.append("matricula", matricula)

            fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                .then(data => {

                    if (data.ok) {
                        document.getElementById('matricula').value = ''
                        document.getElementById('validaMatricula').innerHTML = 'Matricula ya reguistrada'
                    } else {
                        document.getElementById('validaMatricula').innerHTML = ''
                    }

                })
        }
        //funcion Password
        function coincidirPassword(password, repassword) {

            let url = 'clases/clienteAjax.php'
            let formData = new FormData()
            formData.append("action", "coincidirPassword")
            formData.append("password", password)
            formData.append("repassword", repassword)

            fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                .then(data => {

                    if (data.ok) {
                        document.getElementById('validaPassword').innerHTML = ''
                    } else {
                        document.getElementById('validaPassword').innerHTML = 'las contraseñas deven coincidir'
                    }

                })
        }
    </script>
</body>

</html>