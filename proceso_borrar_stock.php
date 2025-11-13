<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

$id_stock = $_POST['id_stock'];

// Realizamos el borrado del stock
$sql = "DELETE FROM stocks WHERE id_stocks = " . intval($id_stock);

$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    $num_error = $conexion->errno;
    $descr_error = $conexion->error;
    $mensaje = "<h2 class='text-center mt-5'>Error al borrar stock $num_error: $descr_error</h2>";
} else {
    $filas_afectadas = mysqli_affected_rows($conexion);
    if ($filas_afectadas > 0) {
        $mensaje = "<h2 class='text-center mt-5'>Stock eliminado correctamente</h2>";
    } else {
        $mensaje = "<h2 class='text-center mt-5'>No se encontró ningún stock con ese ID para borrar</h2>";
    }
}

$conexion->close();

header("refresh:3;url=listado_stocks.php"); // Redirige a listado de stocks
include_once("cabecera.html");
echo $mensaje;
?>