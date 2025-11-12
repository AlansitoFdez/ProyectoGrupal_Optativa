<?php

require_once("funcionesBD.php"); 
$conexion = obtenerConexion();  

// en el array guardamos los resultados de la busqueda para despues mostrarlos
$clientes = [];
$nombreBuscar = "";

// antes de nada revisamos que el nombre llegó con el post
if (isset($_POST['txtNombre'])) {
    $nombreBuscar = trim($_POST['txtNombre']);

    // SQL para buscar por nombre aunque no esté exactamente igual.
    $sql = "SELECT c.id_customers, c.phone, c.customer_name, c.customer_active, c.birthdate, cu.currency_name
            FROM customers c
            LEFT JOIN currency cu ON c.currency_id_FK = cu.currency_id
            WHERE c.customer_name LIKE ?
            ORDER BY c.id_customers ASC";
    $stmt = mysqli_prepare($conexion, $sql); 
    $patron = "%$nombreBuscar%";
    mysqli_stmt_bind_param($stmt, "s", $patron); 
    mysqli_stmt_execute($stmt); 
    $result = mysqli_stmt_get_result($stmt); 

    while ($fila = mysqli_fetch_assoc($result)) {
        $clientes[] = $fila;
    }
}

include_once("cabecera.html"); 
?>

<div class="container mt-4">
    <h2>Buscar cliente por nombre</h2>
    <!-- El formulario vuelve a postear aquí para permitir nuevas búsquedas -->
    <form class="mb-3" method="post" action="proceso_buscar_cliente.php">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="txtNombre" class="col-form-label">Nombre:</label>
            </div>
            <div class="col-auto">
                <!-- Rellena el value con el último nombre buscado -->
                <input type="text" class="form-control" name="txtNombre" id="txtNombre"
                    value="<?php echo htmlspecialchars($nombreBuscar); ?>" required>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </div>
    </form>
    <?php if (isset($_POST['txtNombre'])): ?> 
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Activo</th>
                    <th>Fecha nacimiento</th>
                    <th>Moneda</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($clientes) == 0) {
                    echo "<tr><td colspan='6'>No se encontraron clientes con ese nombre.</td></tr>";
                } else {
                    foreach ($clientes as $fila) {
                        echo "<tr>";
                        echo "<td>" . $fila['id_customers'] . "</td>";
                        echo "<td>" . $fila['customer_name'] . "</td>";
                        echo "<td>" . $fila['phone'] . "</td>";
                        echo "<td>" . ($fila['customer_active'] ? 'Sí' : 'No') . "</td>";
                        echo "<td>" . $fila['birthdate'] . "</td>";
                        echo "<td>" . $fila['currency_name'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
