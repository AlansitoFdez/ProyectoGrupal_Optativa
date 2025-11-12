<?php
require_once("funcionesBD.php");

if (isset($_POST['id_customers'])) {
    $id_customers = intval($_POST['id_customers']);
    $phone = $_POST['txtPhone'];
    $customer_name = $_POST['txtNombre'];
    $customer_active = isset($_POST['chkActivo']) ? 1 : 0;
    $birthdate = $_POST['txtFecha'];
    $currency_id_FK = $_POST['lstMoneda'];

    //le quitamos los valores actuales al cliente y le damos los que están actualmente en cada campo del formulario tras
    //darle a aceptar los cambios
    $conexion = obtenerConexion();
    $sql = "UPDATE customers SET phone=?, customer_name=?, customer_active=?, birthdate=?, currency_id_FK=? WHERE id_customers=?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "isisii", $phone, $customer_name, $customer_active, $birthdate, $currency_id_FK, $id_customers);

    if (mysqli_stmt_execute($stmt)) {
        echo "<div class='alert alert-success'>Datos de cliente modificados correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error modificando datos del cliente.</div>";
    }
    mysqli_stmt_close($stmt);
    echo '<a href="listado_clientes.php" class="btn btn-primary">Volver al listado</a>';
} else {
    echo "<div class='alert alert-warning'>No se ha recibido cliente a modificar.</div>";
}
?>
