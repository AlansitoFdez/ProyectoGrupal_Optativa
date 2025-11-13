<?php 
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Recuperar parámetro
$nombre_cartera = $_GET['txtNombreCartera'];
$nombre_stock = $_GET['txtNombreStock'];

// Construimos la consulta con los joins adecuados y filtro por nombre cartera y stock
$sql = "
    SELECT s.*, st.stock_type_name AS tipo_stock, w.wallet_name AS nombre_cartera
    FROM stocks s
    JOIN wallet w ON s.wallet_id_FK = w.id_wallet
    JOIN stock_type st ON s.stock_type_id_FK = st.stock_type_id
    WHERE w.wallet_name LIKE '%$nombre_cartera%'
    AND s.stock_name LIKE '%$nombre_stock%'
";

$resultado = mysqli_query($conexion, $sql);

if(mysqli_num_rows($resultado) > 0 ) { // Mostrar tabla de datos, hay datos

    $mensaje = "<h2 class='text-center'>Stocks localizados</h2>";
    $mensaje .= "<table class='table'>";
    $mensaje .= "<thead><tr>
        <th>NOMBRE DEL STOCK</th>
        <th>CANTIDAD</th>
        <th>FECHA DE INGRESO</th>
        <th>NOMBRE CARTERA</th>
        <th>TIPO DE STOCK</th>
        <th>ACCIONES</th>
    </tr></thead>";
    $mensaje .= "<tbody>";

    while($fila = mysqli_fetch_assoc($resultado)){
        $mensaje .= "<tr>";
        $mensaje .= "<td>" . $fila['stock_name'] . "</td>";
        $mensaje .= "<td>" . $fila['quantity'] . "</td>";
        $mensaje .= "<td>" . $fila['added_date'] . "</td>";
        $mensaje .= "<td>" . $fila['nombre_cartera'] . "</td>";
        $mensaje .= "<td>" . $fila['tipo_stock'] . "</td>";

        // Formulario en la celda para procesar borrado del stock
        $mensaje .= "<td><form action='proceso_borrar_stock.php' method='post'>";
        $id_stock = $fila['idstocks'];
        $mensaje .= "<input type='hidden' name='id_stock' value='$id_stock' />";  
        $mensaje .= "<button type='submit' name='btnBorrar' class='btn btn-primary'><i class='bi bi-trash'></i></button> </form> </td>";

        $mensaje .= "</tr>";
    }

    $mensaje .= "</tbody></table>"; 
} else { // No hay datos
   $mensaje = "<h2 class='text-center mt-5'>No se encontraron stocks con esos criterios</h2>";
}

// Insertamos cabecera
include_once("cabecera.html");

// Mostrar mensaje calculado antes
echo $mensaje;

?>