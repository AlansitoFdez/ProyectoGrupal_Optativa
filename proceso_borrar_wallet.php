<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Recuperar parámetros
$id_wallet = $_POST['id_wallet'];

// Definir deletes
$sqlStocks = "DELETE FROM stocks WHERE wallet_id_FK = $id_wallet;";
$sql = "DELETE FROM wallet WHERE id_wallet = $id_wallet;";

// Ejecutar consultas
$resultadoDeleteStocks = mysqli_query($conexion, $sqlStocks);
$resultado = mysqli_query($conexion, $sql);

// Verificar si hay error y almacenar mensaje
if (mysqli_errno($conexion) != 0) {
    $numerror = mysqli_errno($conexion);
    $descrerror = mysqli_error($conexion);
    $mensaje =  "<h2 class='text-center mt-5'>Se ha producido un error numero $numerror que corresponde a: $descrerror </h2>";
} else {
    $mensaje =  "<h2 class='text-center mt-5'>Wallet con id $id_wallet borrada</h2>"; 
}

include_once("cabecera.html");

// Mostrar mensaje calculado antes
echo $mensaje;

?>