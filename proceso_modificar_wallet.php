<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Recuperar parámetros
$id_wallet = $_POST['id_wallet'];
$wallet_name = $_POST['txtNombre'];
$descripcion = $_POST['txtDescripcion'];
$idtipo = $_POST['lstTipo'];

// No validamos, suponemos que la entrada de datos es correcta

// Definir update
$sql = "UPDATE wallet SET wallet_name = '" . $wallet_name . "' , descripcion = '" . $descripcion . "' , wallet_type_id_FK = $idtipo 
WHERE id_wallet = $id_wallet;";

// Ejecutar consulta
$resultado = mysqli_query($conexion, $sql);

// Verificar si hay error y almacenar mensaje
if (mysqli_errno($conexion) != 0) {
    $numerror = mysqli_errno($conexion);
    $descrerror = mysqli_error($conexion);
    $mensaje =  "<h2 class='text-center mt-5'>Se ha producido un error numero $numerror que corresponde a: $descrerror </h2>";
} else {
    $mensaje =  "<h2 class='text-center mt-5'>Wallet actualizado</h2>";
}

// Aquí empieza la página
include_once("cabecera.html");

// Mostrar mensaje calculado antes
echo $mensaje;

?>