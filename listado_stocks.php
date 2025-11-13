<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

$sql = "
    SELECT s.*, st.stock_type_name AS tipo_stock, w.wallet_name AS nombre_cartera
    FROM stocks s
    JOIN wallet w ON s.wallet_id_FK = w.id_wallet
    JOIN stock_type st ON s.stock_type_id_FK = st.stock_type_id
    ORDER BY s.id_stocks DESC
";

$resultado = mysqli_query($conexion, $sql);

if(!$resultado) {
    $num_error = $conexion->errno;
    $descr_error = $conexion->error;
    $mensaje = "<h2 class='text-center mt-5'>Se ha producido un error $num_error: $descr_error</h2>";
} else {
    if(mysqli_num_rows($resultado) > 0 ) { // Mostrar tabla de datos, hay datos

        $mensaje = "<h2 class='text-center'>Listado de Stocks</h2>";
        $mensaje .= "<table class='table'>";
        $mensaje .= "<thead><tr>
            <th>ID STOCK</th>
            <th>NOMBRE DEL STOCK</th>
            <th>CANTIDAD</th>
            <th>FECHA DE INGRESO</th>
            <th>CARTERA</th>
            <th>TIPO DE STOCK</th>
            <th>ACCIONES</th>
        </tr></thead>";
        $mensaje .= "<tbody>";

        while($fila = mysqli_fetch_assoc($resultado)){
            $mensaje .= "<tr>";
            $mensaje .= "<td>" . $fila['id_stocks'] . "</td>";
            $mensaje .= "<td>" . $fila['stock_name'] . "</td>";
            $mensaje .= "<td>" . $fila['quantity'] . "</td>";
            $mensaje .= "<td>" . $fila['added_date'] . "</td>";
            $mensaje .= "<td>" . $fila['nombre_cartera'] . "</td>";
            $mensaje .= "<td>" . $fila['tipo_stock'] . "</td>";


            $id_stock = $fila['id_stocks'];
            $mensaje .= "<td><form action='editar_stock.php' method='post' style='display:inline-block; margin-right:5px;'>";
            $mensaje .= "<input type='hidden' name='stock' value='" . htmlspecialchars(json_encode($fila), ENT_QUOTES) . "'/>";
            $mensaje .= "<button type='submit' name='btnEditar' class='btn btn-warning'>";
            $mensaje .= "<i class='bi bi-pencil'></i></button></form>";

            // Formulario para borrar stock
            $mensaje .= "<form action='proceso_borrar_stock.php' method='post' style='display:inline-block; margin-left:5px;'>";
            $mensaje .= "<input type='hidden' name='id_stock' value='$id_stock' />";
            $mensaje .= "<button type='submit' name='btnBorrar' class='btn btn-primary'><i class='bi bi-trash'></i></button></form></td>";

            $mensaje .= "</tr>";
        }

        $mensaje .= "</tbody></table>";
    } else {
        $mensaje = "<h2 class='text-center mt-5'>No hay stocks disponibles</h2>";
    }
}

// Insertamos cabecera
include_once("cabecera.html");

// Mostrar mensaje calculado antes
echo $mensaje;
?>