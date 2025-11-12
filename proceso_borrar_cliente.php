<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Recuperar id_cliente y validar
$id_cliente = $_POST['id_cliente'];

//Borrar todos los stocks de todas las wallets del cliente
$sql_stocks = "DELETE FROM stocks WHERE id_wallet_FK IN (
    SELECT id_wallet FROM wallet WHERE id_customers_FK = $id_cliente
);";
mysqli_query($conexion, $sql_stocks);

//Borrar las wallets del cliente
$sql_wallets = "DELETE FROM wallet WHERE id_customers_FK = $id_cliente;";
mysqli_query($conexion, $sql_wallets);

//Borrar el cliente
$sql_client = "DELETE FROM customers WHERE id_customers = $id_cliente;";
mysqli_query($conexion, $sql_client);

// Control de errores y mensaje
if (mysqli_errno($conexion) != 0) {
    $numerror = mysqli_errno($conexion);
    $descrerror = mysqli_error($conexion);
    $mensaje = "<h2 class='text-center mt-5'>Se ha producido un error número $numerror que corresponde a: $descrerror </h2>";
} else {
    $mensaje = "<h2 class='text-center mt-5'>Cliente con id $id_cliente borrado correctamente</h2>"; 
}

include_once("cabecera.html");
echo $mensaje;
?>
