<style>
.bi-trash {
  color: red; 
}
</style>

<?php
require_once("funcionesBD.php");

$conexion = obtenerConexion();

//todos los clientes (incluyendo su currency con join)
$sql = "SELECT c.id_customers, c.phone, c.customer_name, c.customer_active, c.birthdate, cu.currency_name
        FROM customers c
        LEFT JOIN currency cu ON c.currency_id_FK = cu.currency_id
        ORDER BY c.id_customers ASC";

$resultado = mysqli_query($conexion, $sql);

include_once("cabecera.html");
?>

<div class="container mt-4">
    <h2>Listado de Clientes</h2>
    <table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Activo</th>
            <th>Fecha nacimiento</th>
            <th>Moneda</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
    while($fila = mysqli_fetch_assoc($resultado)){
        echo "<tr>";
        echo "<td>" . $fila['id_customers'] . "</td>";
        echo "<td>" . $fila['customer_name'] . "</td>";
        echo "<td>" . $fila['phone'] . "</td>";
        echo "<td>" . ($fila['customer_active'] ? 'Sí' : 'No') . "</td>";
        echo "<td>" . $fila['birthdate'] . "</td>";
        echo "<td>" . $fila['currency_name'] . "</td>";
        echo "<td>
        <a href='editar_cliente.php?id=" . $fila['id_customers'] . "' class='bi bi-pencil-square'></a>
        <form method='post' action='proceso_borrar_cliente.php' style='display:inline; margin:0;'>
            <input type='hidden' name='id_cliente' value='" . $fila['id_customers'] . "'>
            <button type='submit' class='bi bi-trash' onclick='return confirm(\"¿Seguro que quieres borrar este cliente?\");'></button>
        </form>
      </td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
</div>
</body>
</html>
