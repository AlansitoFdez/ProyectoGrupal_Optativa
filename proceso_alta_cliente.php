<?php
require_once("funcionesBD.php");

$conexion = obtenerConexion();

// Recoger datos del formulario
$phone = $_POST['txtPhone'];
$customername = $_POST['txtNombre'];
$customeractive = isset($_POST['chkActivo']) ? 1 : 0;
$birthdate = $_POST['txtFecha'];
$currencyidFK = $_POST['lstMoneda'];

// Validación básica (esta parte la añadí para probar un poco, me lo dijo chatgpt, al principio no entendía del todo
//el funcioanamiento pero repasando el codigo y haciendolo aprendí)
$errores = [];
if (empty($phone)) $errores[] = "El teléfono es obligatorio.";
if (empty($customername)) $errores[] = "El nombre es obligatorio.";
if (empty($birthdate)) $errores[] = "La fecha de nacimiento es obligatoria.";
if (empty($currencyidFK)) $errores[] = "La moneda es obligatoria.";

if (count($errores) === 0) {
    $sql = "INSERT INTO customers (phone, customer_name, customer_active, birthdate, currency_id_FK) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "isisi", $phone, $customername, $customeractive, $birthdate, $currencyidFK);

    if (mysqli_stmt_execute($stmt)) {
        echo "<div class='alert alert-success'>Cliente dado de alta correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error en el alta de cliente: " . mysqli_error($conexion) . "</div>";
    }
    mysqli_stmt_close($stmt);
} else {
    foreach ($errores as $e) {
        echo "<div class='alert alert-warning'>$e</div>";
    }
}
?>

<a href="alta_cliente.php" class="btn btn-secondary">Volver</a>
