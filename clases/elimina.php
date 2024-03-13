<?php
require '../config/config.php';
require '../config/database.php';

$db = new Database();
$con = $db->conectar();

$campo = isset($_POST['campo']) ? $_POST['campo']: null;

$sql = $con->prepare("SELECT id, nombre, activo  FROM productos");
$sql->execute();
$row = $sql->fetch(PDO::FETCH_ASSOC);

$html = '';

if ($row !== null) {
    foreach ($row as $producto) {
        $html .= '<tr>';
        $html .= '<td>' . $producto['id'] . '</td>';
        $html .= '<td>' . $producto['nombre'] . '</td>';
        $html .= '<td>' . $producto['activo'] . '</td>';
        $html .= '<td><a id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal"><img src="images/iconos/trash.png"></a></td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="4" >sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);




/*if(isset($_POST['action'])){

    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id'] : 0;

    if($action == 'elimina_pro'){
        $sql = $con->prepare("DELETE FROM productos WHERE id=?");
        $sql->execute([$id]);

        $datos['ok'] = true;
    }else{
        $datos['ok'] = false;
    }
}else{
    $datos['ok'] = false;
}

echo json_encode($datos);

<?php 
                                foreach ($resultado as $producto) {
                                    $id = $producto['id'];
                                    $nombre = $producto['nombre'];
                                    $estado = $producto['activo'];

                                    $imagen = "images/productos/" . $id . "/principal.png";

                                    if (!file_exists($imagen)) {
                                        $imagen = "images/no-photo.png";
                                    }
                                ?>
                                    <tr>
                                        <td><img src="<?php echo $imagen; ?>" class="rounded float-start" width="100PX"></td>
                                        <td><?php echo $nombre; ?></td>
                                        <td><?php if ($estado == 1) { ?>
                                                <span class="badge bg-success">Activo</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">Inactivo</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal"><img src="images/iconos/trash.png"></a>
                                        </td>

                                    </tr>
                                <?php  } */
