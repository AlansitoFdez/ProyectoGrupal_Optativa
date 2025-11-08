<?php
require_once("funcionesBD.php");

$conexion = obtenerConexion();

$sql = "SELECT * FROM wallet_type;";

$resultado = mysqli_query($conexion, $sql);

$options = "";
while($fila = mysqli_fetch_assoc($resultado)){
    $options .= "<option value='" . $fila["wallet_type_id"] . "'>" . $fila["wallet_type_name"] . "</option>";
}

include_once("cabecera.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_alta_wallet.php" name="frmAltaWallet" id="frmAltaWallet" method="post">
            <fieldset>
                <!-- Form Name -->
                <legend>Alta de la Wallet</legend>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombre">Nombre</label>
                    <div class="col-xs-4">
                        <input id="txtNombre" name="txtNombre" placeholder="Nombre de la Wallet" class="form-control input-md" maxlength="25" type="text">
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtDescripcion">Descripción</label>
                    <div class="col-xs-4">
                        <input id="txtDescripcion" name="txtDescripcion" placeholder="Descripcion" class="form-control input-md" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtPhone">Número de Télefono</label>
                    <div class="col-xs-4">
                        <input id="txtDescripcion" name="txtPhone" placeholder="Número de Teléfono" class="form-control input-md" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="lstTipo">Tipo de Wallet</label>
                    <div class="col-xs-4">
                        <select name="lstTipo" id="lstTipo" class="form-select" aria-label="Default select example">
                            <?php echo $options; ?>
                        </select>
                    </div>
                </div>
                <!-- Button -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="btnAceptarAltaWallet"></label>
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarAltaWallet" name="btnAceptarAltaWallet" class="btn btn-primary" value="Aceptar" />
                    </div>
                </div>
            </fieldset>
        </form>

    </div>
</div>
</body>

</html>