<?php 
include_once("cabecera.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_buscar_stock.php" name="frmBuscarStock" id="frmBuscarStock" method="get">
            <fieldset>
                <!-- Form Name -->
                <legend>Buscar un Stock</legend>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombreCartera">Nombre de la Cartera</label>
                    <div class="col-xs-4">
                        <input id="txtNombreCartera" name="txtNombreCartera" placeholder="Nombre de la Cartera" class="form-control input-md" type="text">
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombreStock">Nombre del Stock</label>
                    <div class="col-xs-4">
                        <input id="txtNombreStock" name="txtNombreStock" placeholder="Nombre del Stock" class="form-control input-md" type="text">
                    </div>
                </div>


                <!-- Button -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="btnAceptarBuscarStock"></label>
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarBuscarStock" name="btnAceptarBuscarStock" class="btn btn-primary" value="Aceptar" />
                    </div>
                </div>
            </fieldset>
        </form>

    </div>
</div>
</body>

</html>