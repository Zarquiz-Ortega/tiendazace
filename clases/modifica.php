<?php
require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();

$id =$_POST['id'];

$resultado = array();

$sql = $con->prepare("SELECT id, nombre, descripcion, precio, descuento, id_categoria, activo FROM productos WHERE id=? LIMIT 1");
$sql->execute([$id]);
$resultado[] = $sql->fetch(PDO::FETCH_ASSOC);

foreach($resultado as $productos){
    echo json_encode($productos);
}


