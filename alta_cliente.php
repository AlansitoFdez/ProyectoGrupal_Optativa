<?php
require_once("funcionesBD.php");

$conexion = obtenerConexion();

// query para sacar monedas
$sql = "SELECT * FROM currency;";
$resultado = mysqli_query($conexion, $sql);

$options = "";
while($fila = mysqli_fetch_assoc($resultado)){
    $options .= "<option value='" . $fila["currency_id"] . "'>" . $fila["currency_name"] . "</option>";
}

include_once("cabecera.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_alta_cliente.php" name="frmAltaCliente" id="frmAltaCliente" method="post">
            <fieldset>
                <!-- Form Name -->
                <legend>Alta de Cliente</legend>
                <!-- Teléfono -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtPhone">Teléfono</label>
                    <div class="col-xs-4">
                        <input id="txtPhone" name="txtPhone" placeholder="Número de Teléfono" class="form-control input-md" type="number" required>
                    </div>
                </div>
                <!-- Nombre -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombre">Nombre</label>
                    <div class="col-xs-4">
                        <input id="txtNombre" name="txtNombre" placeholder="Nombre cliente" class="form-control input-md" maxlength="50" type="text" required>
                    </div>
                </div>
                <!-- Activo -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="chkActivo">Activo</label>
                    <div class="col-xs-4">
                        <input type="checkbox" id="chkActivo" name="chkActivo" checked>
                    </div>
                </div>
                <!-- Fecha nacimiento -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtFecha">Fecha de nacimiento</label>
                    <div class="col-xs-4">
                        <input id="txtFecha" name="txtFecha" class="form-control input-md" type="date" required>
                    </div>
                </div>
                <!-- Selección de moneda -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="lstMoneda">Moneda</label>
                    <div class="col-xs-4">
                        <select name="lstMoneda" id="lstMoneda" class="form-select" required>
                            <?php echo $options; ?>
                        </select>
                    </div>
                </div>
                <!-- Button -->
                <div class="form-group">
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarAltaCliente" name="btnAceptarAltaCliente" class="btn btn-primary" value="Aceptar" />
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>
