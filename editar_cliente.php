<?php
require_once("funcionesBD.php");

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-warning'>No se especificó cliente a editar.</div>";
    exit;
}
$id = intval($_GET['id']);
$conexion = obtenerConexion();

$sql = "SELECT * FROM customers WHERE id_customers = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$cliente = mysqli_fetch_assoc($result);
if (!$cliente) {
    echo "<div class='alert alert-danger'>Cliente no encontrado.</div>";
    exit;
}

// monedas
$sqlMonedas = "SELECT * FROM currency";
$resultMonedas = mysqli_query($conexion, $sqlMonedas);

// formulario
include_once("cabecera.html");
?>

<div class="container mt-4">
    <h2>Editar Cliente</h2>
    <form class="form-horizontal" action="proceso_editar_cliente.php" method="post">
        <input type="hidden" name="id_customers" value="<?php echo $cliente['id_customers']; ?>">
        <div class="form-group">
            <label class="col-xs-4 control-label">Teléfono</label>
            <div class="col-xs-4">
                <input name="txtPhone" class="form-control input-md" type="number" value="<?php echo $cliente['phone']; ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-4 control-label">Nombre</label>
            <div class="col-xs-4">
                <input name="txtNombre" class="form-control input-md" maxlength="50" type="text" value="<?php echo $cliente['customer_name']; ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-4 control-label">Activo</label>
            <div class="col-xs-4">
                <input type="checkbox" name="chkActivo" <?php if ($cliente['customer_active']) echo 'checked'; ?>>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-4 control-label">Fecha de nacimiento</label>
            <div class="col-xs-4">
                <input name="txtFecha" class="form-control input-md" type="date" value="<?php echo $cliente['birthdate']; ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-4 control-label">Moneda</label>
            <div class="col-xs-4">
                <select name="lstMoneda" class="form-select" required>
                    <?php
                    while ($m = mysqli_fetch_assoc($resultMonedas)) {
                        $selected = ($m['currency_id'] == $cliente['currency_id_FK']) ? "selected" : "";
                        echo "<option value='{$m['currency_id']}' $selected>{$m['currency_name']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group mt-3">
            <div class="col-xs-4">
                <input type="submit" class="btn btn-success" value="Guardar cambios" />
                <a href="listado_clientes.php" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
