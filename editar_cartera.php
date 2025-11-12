<?php

// Recupero datos de parametro en forma de array asociativo
$wallet = json_decode($_POST['wallet'],true);

require_once("funcionesBD.php");
$conexion = obtenerConexion();

$sql = "SELECT * FROM wallet_type;";

$resultado = mysqli_query($conexion, $sql);

$options = "";
while ($fila = mysqli_fetch_assoc($resultado)) {
    // Si coincide el tipo con el del componente es el que debe aparecer seleccionado (selected)
    if ($fila['wallet_type_id'] == $wallet['wallet_type_id_FK']){
        $options .= " <option selected value='" . $fila["wallet_type_id"] . "'>" . $fila["wallet_type_name"] . "</option>";
    } else{
        $options .= " <option value='" . $fila["wallet_type_id"] . "'>" . $fila["wallet_type_name"] . "</option>";
    }
}

// Cabecera HTML que incluye navbar
include_once("cabecera.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_modificar_wallet.php" name="frmAltaWallet" id="frmAltaWallet" method="post">
            <fieldset>
                <!-- Form Name -->
                <legend>Modificación de wallet</legend>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombre">Nombre</label>
                    <div class="col-xs-4">
                        <input value="<?php echo $wallet['wallet_name']?>" id="txtNombre" name="txtNombre" placeholder="Nombre de la cartera" class="form-control input-md" type="text">
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtDescripcion">Descripción</label>
                    <div class="col-xs-4">
                        <input value="<?php echo $wallet['description']?>" id="txtDescripcion" name="txtDescripcion" placeholder="Descripcion" class="form-control input-md" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="lstTipo">Tipo</label>
                    <div class="col-xs-4">
                        <select name="lstTipo" id="lstTipo" class="form-select" aria-label="Default select example">
                            <?php echo $options; ?>
                        </select>
                    </div>
                </div>
                <input value="<?php echo $wallet['id_wallet']?>" type='hidden' name='id_wallet' id='id_wallet' />
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