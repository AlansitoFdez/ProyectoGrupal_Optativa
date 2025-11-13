<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

date_default_timezone_set('Europe/Madrid');
$fecha_actual = new DateTime();

// Recuperar parámetros del formulario
$nombre_wallet = $_POST['txtNombreWalletStock'];
$nombre_stock = $_POST['txtNombreStock'];
$cantidad = $_POST['nmbCantidad'];
$id_tipo_stock = $_POST['lstTipoStock'];
$fecha_formato = $fecha_actual->format('Y-m-d');

// Insertar Stock Nuevo a la cartera que nos han pasado
$sql_insert = "
    INSERT INTO stocks
        (stock_name, quantity, in_use, added_date, wallet_id_FK, stock_type_id_FK)
    SELECT
        '$nombre_stock',
        $cantidad,
        1,
        '$fecha_formato',
        w.id_wallet,
        $id_tipo_stock
    FROM wallet w
    WHERE w.wallet_name = '$nombre_wallet' AND w.wallet_active = 1
    LIMIT 1
";

$result_insert = mysqli_query($conexion, $sql_insert);

if (!$result_insert) {
    $num_error = $conexion->errno;
    $descr_error = $conexion->error;
    $mensaje = "<h2 class='text-center mt-5'>Se ha producido un error $num_error: $descr_error</h2>";
} else {
    if (mysqli_affected_rows($conexion) > 0) {
        // Obtener precio unitario del tipo de stock
        $sql_valor = "SELECT stock_type_quality FROM stock_type WHERE stock_type_id = $id_tipo_stock LIMIT 1";
        $res_valor = mysqli_query($conexion, $sql_valor);
        if ($res_valor && mysqli_num_rows($res_valor) > 0) {
            $fila_valor = mysqli_fetch_assoc($res_valor);
            $precio_unitario = $fila_valor['stock_type_quality'];
            $total_compra = $cantidad * $precio_unitario;

            // Actualizar money_amount de la wallet
            $sql_update_wallet = "
                UPDATE wallet w
                SET w.money_amount = w.money_amount + $total_compra
                WHERE w.wallet_name = '$nombre_wallet' AND w.wallet_active = 1
                LIMIT 1
            ";
            mysqli_query($conexion, $sql_update_wallet);

            $mensaje = "<h2 class='text-center mt-5'>Stock insertado y wallet actualizada correctamente</h2>";
        } else {
            $mensaje = "<h2 class='text-center mt-5'>Error al obtener el precio unitario del stock</h2>";
        }
    } else {
        $mensaje = "<h2 class='text-center mt-5'>No se encontró la cartera activa con ese nombre</h2>";
    }
}

$conexion->close();

header("refresh:5;url=index.php");
include_once("cabecera.html");
echo $mensaje;
?>