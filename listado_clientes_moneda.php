<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

$sqlMonedas = "SELECT currency_id, currency_name FROM currency";
$resultMonedas = mysqli_query($conexion, $sqlMonedas);

//cogemos el id de la moneda seleccionada y buscamos a todos los customers que su fk de currency sea igual a ese id.
$clientes = [];
$currencySeleccionada = "";
if (isset($_POST['lstMoneda'])) {
    $currencySeleccionada = $_POST['lstMoneda'];
    $sqlClientes = "SELECT c.id_customers, c.phone, c.customer_name, c.customer_active, c.birthdate, cu.currency_name
                    FROM customers c
                    LEFT JOIN currency cu ON c.currency_id_FK = cu.currency_id
                    WHERE c.currency_id_FK = ?
                    ORDER BY c.id_customers ASC";
    $stmt = mysqli_prepare($conexion, $sqlClientes);
    mysqli_stmt_bind_param($stmt, "i", $currencySeleccionada);
    mysqli_stmt_execute($stmt);
    $resultClientes = mysqli_stmt_get_result($stmt);
    while ($fila = mysqli_fetch_assoc($resultClientes)) {
        $clientes[] = $fila;
    }
}

include_once("cabecera.html");
?>

<div class="container mt-4">
    <h2>Listado de clientes por moneda</h2>
    <form method="post" class="mb-3">
        <label for="lstMoneda">Selecciona moneda:</label>
        <select name="lstMoneda" id="lstMoneda" class="form-select" required>
            <option value="">Tipos de Moneda</option>
            <?php
            while ($m = mysqli_fetch_assoc($resultMonedas)) {
                $selected = ($currencySeleccionada == $m['currency_id']) ? "selected" : "";
                echo "<option value='{$m['currency_id']}' $selected>{$m['currency_name']}</option>";
            }
            ?>
        </select>
        <button type="submit" class="btn btn-primary mt-2">Ver clientes</button>
    </form>

    <?php if (isset($_POST['lstMoneda'])): ?>
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
                echo "<tr><td colspan='6'>No hay clientes con esa moneda.</td></tr>";
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
