<?php
include_once("cabecera.html"); 
?>

<div class="container mt-4">
    <h2>Buscar cliente por nombre</h2>
    <form class="mb-3" method="post" action="proceso_buscar_cliente.php">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="txtNombre" class="col-form-label">Nombre:</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" name="txtNombre" id="txtNombre"
                       value="" required>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
