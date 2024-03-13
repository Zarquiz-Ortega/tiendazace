<?php
require '../config/database.php';
require '../config/config.php';
$db = new Database();
$con = $db->conectar();

$id = $_POST['id'];
$nombre = $_POST['Nombre'];
$precio = $_POST['Precio'];
$descripcion = $_POST['Descripcion'];
$descuento = $_POST['Descuento'];
$id_categoria = isset($_POST['id_categoria'])? $_POST['id_categoria'] : 1;
$estado = $_POST['estado'];
$sql = "UPDATE productos SET nombre ='$nombre',descripcion = '$descripcion', precio = '$precio', descuento = '$descuento', id_categoria = '$id_categoria', activo = '$estado' WHERE id=$id";
if ($con->query($sql)) {
}
header('Location:../modificar_pro.php');

