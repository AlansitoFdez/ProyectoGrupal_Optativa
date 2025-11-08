<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Verifico si ha llegado el parametro de tipo 
if (isset($_GET['lstTipo'])) {
    // Recuperar parámetro
    $idtipo = $_GET['lstTipo'];

    $sql = "SELECT w.*, c.customer_name, wt.wallet_type_name AS wallet_type_name FROM wallet w, wallet_type wt, customers c
            WHERE w.wallet_type_id_FK = wt.wallet_type_id AND w.id_customers_FK = c.id_customers AND wt.wallet_type_id = $idtipo ORDER BY id_wallet ASC;";

} else { // No recibo idtipo para filtrar
    $sql = "SELECT w.*, c.customer_name, wt.wallet_type_name AS wallet_type_name FROM wallet w, wallet_type wt, customers c
            WHERE w.wallet_type_id_FK = wt.wallet_type_id AND w.id_customers_FK = c.id_customers;";

}

// Ejecutar consulta
$resultado = mysqli_query($conexion, $sql);

// Montar tabla
$mensaje = "<h2 class='text-center'>Listado de Wallets</h2>";
$mensaje .= "<table class='table table-striped'>";
$mensaje .= "<thead><tr><th>ID WALLET</th><th>NOMBRE DEL CLIENTE</th><th>CANTIDAD DE DINERO</th><th>NOMBRE</th><th>FECHA DE CREACIÓN</th><th>TIPO</th><th>DESCIPCION</th><th>ACCIÓN</th></tr></thead>";
$mensaje .= "<tbody>";

// Recorrer filas mientras $fila != null
// OJO: es una asignación a la variable $fila y después se evalua $fila != null
while ($fila = mysqli_fetch_assoc($resultado)) {
    $mensaje .= "<tr><td>" . $fila['id_wallet'] . "</td>";
    $mensaje .= "<td>" . $fila['customer_name'] . "</td>";
    $mensaje .= "<td>" . $fila['money_amount'] . "</td>";
    $mensaje .= "<td>" . $fila['wallet_name'] . "</td>";
    $mensaje .= "<td>" . $fila['creation_date'] . "</td>";
    $mensaje .= "<td>" . $fila['wallet_type_name'] . "</td>";
    $mensaje .= "<td>" . $fila['descripcion'] . "</td>";

    $mensaje .= "<td><form class='d-inline me-1' action='editar_cartera.php' method='post'>";
    $mensaje .= "<input type='hidden' name='wallet' value='" . htmlspecialchars(json_encode($fila),ENT_QUOTES) . "' />";
    $mensaje .= "<button name='Editar' class='btn btn-primary'><i class='bi bi-pencil-square'></i></button></form>";

    $mensaje .= "<form class='d-inline' action='proceso_borrar_wallet.php' method='post'>";
    $mensaje .= "<input type='hidden' name='id_wallet' value='" . $fila['id_wallet']  . "' />";
    $mensaje .= "<button name='Borrar' class='btn btn-danger'><i class='bi bi-trash'></i></button></form>";

    $mensaje .= "</td></tr>";
    
}

// Cerrar tabla
$mensaje .= "</tbody></table>";

// Insertamos cabecera
include_once("cabecera.html");

// Mostrar mensaje calculado antes
echo $mensaje;


