<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Recuperar parámetros
$id_stock = $_POST['id_stock'];
$stock_name = $_POST['txtNombreStock'];
$quantity = $_POST['nmbCantidad'];

$sql = "UPDATE stocks SET stock_name = '" . $stock_name . "' , quantity = " . $quantity . " WHERE id_stocks = $id_stock;";


$resultado = mysqli_query($conexion, $sql);

$sql_quality = "SELECT st.stock_type_quality, s.wallet_id_FK FROM stocks s JOIN stock_type st ON s.stock_type_id_FK = st.stock_type_id WHERE s.id_stocks = $id_stock;";
$resultado_quality = mysqli_query($conexion, $sql_quality);
$fila = mysqli_fetch_assoc($resultado_quality);

$quality = $fila['stock_type_quality'];
$wallet_id = $fila['wallet_id_FK'];


$nuevo_valor = $quantity * $quality;


$sql_modificada = "UPDATE wallet SET money_amount = $nuevo_valor WHERE id_wallet = $wallet_id;";
$resultado_modificada = mysqli_query($conexion, $sql_modificada);

// Verificar si hay error y almacenar mensaje
if (mysqli_errno($conexion) != 0) {
    $numerror = mysqli_errno($conexion);
    $descrerror = mysqli_error($conexion);
    $mensaje =  "<h2 class='text-center mt-5'>Se ha producido un error numero $numerror que corresponde a: $descrerror </h2>";
} else {
    $mensaje =  "<h2 class='text-center mt-5'>Stock y Wallet actualizados</h2>";
}

// Aquí empieza la página
include_once("cabecera.html");

// Mostrar mensaje calculado antes
echo $mensaje;

?>