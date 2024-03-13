<?php
require 'database.php';

$db = new Database();
$con = $db->conectar();

$table = "productos";
$campo = isset($_POST['campo']) ? $_POST['campo'] : null;
$sql = $con->prepare("SELECT id, nombre, activo  FROM $table");
$sql->execute();

$html = '';

if (isset($sql)) {
    while ($row = $sql->fetchAll(PDO::FETCH_ASSOC)) {
        $html .= '<tr>';
        $html .= '<td>' . $row['id'] . '</td>';
        $html .= '<td>' . $row['nombre'] . '</td>';
        $html .= '<td>' . $row['activo'] . '</td>';
        $html .= '<td>' . '<a id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal"><img src="images/iconos/trash.png"></a>' . '</td>';
        $html .= '</td>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="4" >sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
