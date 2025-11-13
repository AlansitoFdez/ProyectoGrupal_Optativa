<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();


$stock = json_decode($_POST['stock'], true);

// Consulta para obtener datos del stock con joins necesarios
$sql = "
        SELECT s.*, st.stock_type_quality, w.id_wallet
        FROM stocks s, stock_type st, wallet w
        WHERE s.stock_type_id_FK = st.stock_type_id
        AND s.wallet_id_FK = w.id_wallet
        AND s.id_stocks = $id_stock;
    ";

$res = mysqli_query($conexion, $sql);


include_once("cabecera.html");
?>


<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_editar_stock.php" name="frmAltaStock" id="frmAltaStock" method="post">
            <fieldset>
                <legend>Modificación de stock</legend>

                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombreStock">Nombre del Stock</label>
                    <div class="col-xs-4">
                        <input value="<?php echo $stock["stock_name"] ?>" id="txtNombreStock" name="txtNombreStock" placeholder="Nombre del stock" class="form-control input-md" type="text" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-4 control-label" for="nmbCantidad">Cantidad</label>
                    <div class="col-xs-4">
                        <input value="<?php echo $stock['quantity'] ?>" id="nmbCantidad" name="nmbCantidad" class="form-control input-md" type="number" min="0" required>
                    </div>
                </div>

                <input type="hidden" name="id_stock" value="<?php echo $stock['id_stocks']?>" />
                <input type="hidden" name="id_stock" value="<?php echo $stock['id_stocks']?>" />


                <div class="form-group">
                    <label class="col-xs-4 control-label" for="btnAceptarEditarStock"></label>
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarEditarStock" name="btnAceptarEditarStock" class="btn btn-primary" value="Aceptar" />
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>
</body>

</html>
