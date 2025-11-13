<?php
require_once("funcionesBD.php");

$conexion = obtenerConexion();

$sql = "SELECT * FROM stock_type;";

$resultado = mysqli_query($conexion, $sql);

$options = "";
while ($fila = mysqli_fetch_assoc($resultado)) {
    $options .= "<option value='" . $fila["stock_type_id"] . "'>" . $fila["stock_type_name"] . "</option>";
}

include_once("cabecera.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_alta_stock.php" name="frmAltaStock" id="frmAltaStock" method="post">
            <fieldset>
                <!-- Form Name -->
                <legend>Alta de Stock</legend>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombreWalletStock">Nombre de la Cartera</label>
                    <div class="col-xs-4">
                        <input id="txtNombreWalletStock" name="txtNombreWalletStock" placeholder="Nombre de la Cartera" class="form-control input-md" maxlength="25" type="text">
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombreStock">Nombre del Stock</label>
                    <div class="col-xs-4">
                        <input id="txtNombreStock" name="txtNombreStock" placeholder="Nombre de la Stock" class="form-control input-md" maxlength="25" type="text">
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="nmbCantidad">Cantidad</label>
                    <div class="col-xs-4">
                        <input id="nmbCantidad" name="nmbCantidad" class="form-control input-md" type="number">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="lstTipo">Tipo de Stock</label>
                    <div class="col-xs-4">
                        <select name="lstTipoStock" id="lstTipoStock" class="form-select" aria-label="Default select example">
                            <?php echo $options; ?>
                        </select>
                    </div>
                </div>
                <!-- Button -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="btnAceptarAltaStock"></label>
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarAltaStock" name="btnAceptarAltaStock" class="btn btn-primary" value="Aceptar" />
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>