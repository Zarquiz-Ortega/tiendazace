<?php
require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();



$nombre = $_POST['Nombre'];
$precio = $_POST['Precio'];
$descripcion = $_POST['Descripcion'];
$descuento = $_POST['Descuento'];
$categoria = $_POST['Categoria'];
$estado = $_POST['Estado'];
$sql = "INSERT INTO productos (nombre, descripcion, precio, descuento, id_categoria, activo)
        VALUES ('$nombre','$descripcion','$precio','$descuento','$categoria','$estado')";
if ($con->query($sql)) {
    //$id = $con->inser_id;
}
header('Location: ../agregar_pro.php');
