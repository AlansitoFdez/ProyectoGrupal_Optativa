<?php
require_once("funcionesBD.php");

$conexion = obtenerConexion();

$sql = "SELECT * FROM stock_type ORDER BY stock_type_id ASC;";

$resultado = mysqli_query($conexion, $sql);

$options = "";
while ($fila = mysqli_fetch_assoc($resultado)) {
    // $tipos[] = $fila; // Insertar una fila al final
    $options .= " <option value='" . $fila["stock_type_id"] . "'>" . $fila["stock_type_name"] . "</option>";
}

include_once("cabecera.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_listado_stock_tipo.php" method="get">
            <fieldset>
                <!-- Form Name -->
                <legend>Buscar Stocks de un tipo</legend>
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="lstTipo">Tipos de Stocks</label>
                    <div class="col-xs-4">
                        <select name="lstTipo" id="lstTipo" class="form-select" aria-label="Default select example">
                            <?php echo $options; ?>
                        </select>
                    </div>
                </div>
                <!-- Button -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="btnAceptarBuscarStockTipo"></label>
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarBuscarStockTipo" name="btnAceptarBuscarStockTipo" class="btn btn-primary" value="Aceptar" />
                    </div>
                </div>
            </fieldset>
        </form>

    </div>
</div>
</body>

</html>