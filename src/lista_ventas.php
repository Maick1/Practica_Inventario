<?php
session_start();
require_once "../conexion.php";

// Verificar si la clave 'idUser' existe en $_SESSION
if (!isset($_SESSION['idUser'])) {
    header('Location: ../index.php');
    exit();
}

$id_user = $_SESSION['idUser'];
$permiso = "ventas";

// Escapar el valor de $permiso para evitar inyección SQL
$permisoEscapado = mysqli_real_escape_string($conexion, $permiso);

$sql = "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permisoEscapado'";

$resultado = mysqli_query($conexion, $sql);

if ($resultado === false) {
    die(mysqli_error($conexion)); // Muestra el error si la consulta falla
}

$existe = mysqli_fetch_all($resultado);

if (empty($existe) && $id_user != 1) {
    header('Location: permisos.php');
    exit();
}

$query = "SELECT v.*, c.idcliente, c.nombre FROM ventas v INNER JOIN cliente c ON v.id_cliente = c.idcliente";
$resultadoQuery = mysqli_query($conexion, $query);

include_once "includes/header.php";
?>

<div class="card">
    <div class="card-header">
        <i class="fas fa-history"></i> Historial ventas
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-light" id="tbl">
                <thead class="thead-dark">
                    <tr>
                        <th><i class="fas fa-sort-numeric-up"></i> #</th>
                        <th><i class="fas fa-user"></i> Cliente</th>
                        <th><i class="fas fa-dollar-sign"></i> Total</th>
                        <th><i class="fas fa-calendar-alt"></i> Fecha</th>
                        <th><i class="fas fa-file-pdf"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($resultadoQuery)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['total']; ?></td>
                            <td><?php echo $row['fecha']; ?></td>
                            <td>
                                <a href="pdf/generar.php?cl=<?php echo $row['id_cliente']; ?>&v=<?php echo $row['id']; ?>" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>
