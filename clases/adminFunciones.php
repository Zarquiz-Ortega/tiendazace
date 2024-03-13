<?php
/* 
 codijo de la funciones que puede realizar el administrador del portal web 
 aurtor: zarquiz y adan 
 2022 - 2023
*/
function esActivo($usuario, $con)
{
    $sql = $con->prepare("SELECT activacion FROM usuarios WHERE usuario LIKE ? LIMIT 1");
    $sql->execute([$usuario]);
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    if ($row['activacion'] == 1) {
        return true;
    }
    return false;
}


function esNulo(array $parametros)
{
    foreach ($parametros as $parametro) {
        if (strlen(trim($parametro)) < 1) {
            return true;
        }
    }
    return false;
}

function mostrarError(array $erros)
{
    if (count($erros) > 0) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><dl>';
        foreach ($erros as $error) {
            echo '<dd>' . $error . '</dd>';
        }
        echo '</dl>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
}

function mostrarMensajes(array $mensajes)
{
    if (count($mensajes) > 0) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><dl>';
        foreach ($mensajes as $mensajes) {
            echo '<dd>' . $mensajes . '</dd>';
        }
        echo '</dl>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
}

function agregarProducto($nombre, $descripcion, $precio, $descuento, $categoria, $estado, $con)
{
    $sql = $con->prepare("INSERT INTO productos (nombre, descripcion, precio, descuento, id_categoria, activo)
    VALUES (?,?,?,?,?,?)");
    $sql->execute([$nombre, $descripcion, $precio, $descuento, $categoria, $estado]);
    $id = $con->lastInsertId();
    if ($id > 0) {
        return true;
    } else {
        return false;
    }
}

function modificaProfucto($id, $nombre, $descripcion, $precio, $descuento, $id_categoria, $estado, $con)
{
    $sql = $con->prepare("UPDATE productos SET nombre=? ,descripcion=? , precio=?, descuento=?, id_categoria=?, activo=?  WHERE id=?");
    if ($sql->execute([$nombre, $descripcion, $precio, $descuento, $id_categoria, $estado, $id])) {
        return true;
    } else {
        return false;
    }
} 

function eliminaProducto($id, $con)
{
    $sql = $con->prepare("DELETE FROM productos WHERE id=?");
    if ($sql->execute([$id])) {
        return true;
    } else {
        return false;
    }
}
