<?php
include_once("cabecera.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_buscar_wallet.php" name="frmBuscarWallet" id="frmBuscarWallet" method="get">
            <fieldset>
                <!-- Form Name -->
                <legend>Buscar una Wallet</legend>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtTelefonoCliente">Telefono</label>
                    <div class="col-xs-4">
                        <input id="txtTelefonoCliente" name="txtTelefonoCliente" placeholder="Telefono del Cliente" class="form-control input-md" type="text">
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="btnAceptarBuscarWallet"></label>
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarBuscarWallet" name="btnAceptarBuscarWallet" class="btn btn-primary" value="Aceptar" />
                    </div>
                </div>
            </fieldset>
        </form>

    </div>
</div>
</body>

</html>