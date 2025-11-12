<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

date_default_timezone_set('Europe/Madrid');
$date = new DateTime();

// Recuperar parámetros del formulario
$nombre = $_POST['txtNombre'];
$phone = $_POST['txtPhone'];
$description = $_POST['txtDescripcion'];
$idtipo = $_POST['lstTipo'];
$fecha_formato = $date->format('Y-m-d');

// Insertar wallet con dinero en NULL y obteniendo el id_customers de la tabla customers usando el teléfono
$sql = "
    INSERT INTO wallet 
        (wallet_name, wallet_active, creation_date, description, wallet_type_id_FK, customers_id_FK, money_amount)
    SELECT
        '$nombre',
        1,
        '$fecha_formato',
        '$description',
        $idtipo,
        c.id_customers,
        0
    FROM customers c
    WHERE c.phone = '$phone'
    LIMIT 1
";
$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    $numerror = $conexion->errno;
    $descrerror = $conexion->error;
    $mensaje = "<h2 class='text-center mt-5'>Se ha producido un error $numerror: $descrerror</h2>";
} else {
    // Puedes añadir chequeo extra con mysqli_affected_rows($conexion) para ver si realmente se insertó
    $mensaje = "<h2 class='text-center mt-5'>Wallet insertada correctamente</h2>";
}

$conexion->close();

header("refresh:5;url=index.php");
include_once("cabecera.html");
echo $mensaje;
?>
