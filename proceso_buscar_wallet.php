<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Recuperar parámetro
$telefono_cliente = $_GET['txtTelefonoCliente'];

$sql = "SELECT w.*, wt.wallet_type_name AS tipo_wallet, c.customer_name AS nombre_cliente, c.phone AS telefono_cliente FROM wallet w, customers c, wallet_type wt
WHERE w.customers_id_FK = c.id_customers
AND w.wallet_type_id_FK = wt.wallet_type_id
AND c.phone LIKE '%$telefono_cliente%'";

$resultado = mysqli_query($conexion, $sql);

if(mysqli_num_rows($resultado) > 0 ){ // Mostrar tabla de datos, hay datos

    $mensaje = "<h2 class='text-center'>Cliente localizado</h2>";
    $mensaje .= "<table class='table'>";
    $mensaje .= "<thead><tr><th>ID WALLET</th><th>NOMBRE DEL CLIENTE</th><th>TELEFONO DEL CLIENTE</th><th>CANTIDAD DE DINERO</th><th>FECHA DE CREACIÓN</th><th>TIPO</th><th>DESCIPCION</th><th>ACCIÓN</th></tr></thead>";
    $mensaje .= "<tbody>";
    
    while($fila = mysqli_fetch_assoc($resultado)){
        $mensaje .= "<tr>";
        $mensaje .= "<td>" . $fila['id_wallet'] . "</td>";
        $mensaje .= "<td>" . $fila['nombre_cliente'] . "</td>";
        $mensaje .= "<td>" . $fila['telefono_cliente'] . "</td>";
        $mensaje .= "<td>" . $fila['money_amount'] . "</td>";
        $mensaje .= "<td>" . $fila['creation_date'] . "</td>";
        $mensaje .= "<td>" . $fila['tipo_wallet'] . "</td>";
        $mensaje .= "<td>" . $fila['description'] . "</td>";

        // Formulario en la celda para procesar borrado del registro
        $mensaje .= "<td><form action='proceso_borrar_wallet.php' method='post'>";
        // input hidden para enviar idcomponente a borrar
        $idcomponente = $fila['id_wallet'];
        $mensaje .= "<input type='hidden' name='id_wallet' value='$id_wallet' />";  
        $mensaje .= "<button type='submit' name='btnBorrar' class='btn btn-primary'><i class='bi bi-trash'></i></button> </form> </td>";

        $mensaje .= "</tr>";
    }
    
    $mensaje .= "</tbody></table>"; 
} else { // No hay datos
   $mensaje = "<h2 class='text-center mt-5'>No hay clientes con telefono $telefono_cliente</h2>";
}

// Insertamos cabecera
include_once("cabecera.html");

// Mostrar mensaje calculado antes
echo $mensaje;

?>
