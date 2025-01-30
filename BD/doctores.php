<?php
// Conexión a la base de datos
$host = "127.0.0.1";
$usuario = "root";
$password = "";
$bd = "hospital";
$conectar = mysqli_connect($host, $usuario, $password, $bd);
if (!$conectar) {
    die("Error al conectar: " . mysqli_connect_error());
}

// Función para limpiar y validar los datos del formulario
function limpiar_entrada($dato) {
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}

// Agregar nuevo doctor
if(isset($_POST['agregar'])) {
    $NombreDoc = limpiar_entrada($_POST['NombreDoc']);
    $Apellido_Materno = limpiar_entrada($_POST['Apellido_Materno']);
    $Apellido_Paterno = limpiar_entrada($_POST['Apellido_Paterno']);
    $TelDoc = limpiar_entrada($_POST['TelDoc']);
    $CURPDoc = limpiar_entrada($_POST['CURPDoc']);
    $DireccionDoc = limpiar_entrada($_POST['DireccionDoc']);
    $CorreoDoc = limpiar_entrada($_POST['CorreoDoc']);
    $CedulaDoc = limpiar_entrada($_POST['CedulaDoc']);

    // Verificar si ya existe un doctor con el mismo nombre
    $consulta_verificacion = "SELECT COUNT(*) as total FROM doctor WHERE NombreDoc='$NombreDoc'";
    $resultado_verificacion = mysqli_query($conectar, $consulta_verificacion);
    $fila_verificacion = mysqli_fetch_assoc($resultado_verificacion);
    $total_doctores = $fila_verificacion['total'];

    if($total_doctores > 0) {
        echo "<script>alert('Ya existe un doctor con el mismo nombre.');</script>";
    } else {
        // Insertar el nuevo doctor si no existe otro con el mismo nombre
        $consulta = "INSERT INTO doctor (NombreDoc, Apellido_Materno, Apellido_Paterno, TelDoc, CURPDoc, DireccionDoc, CorreoDoc, CedulaDoc) VALUES ('$NombreDoc', '$Apellido_Materno', '$Apellido_Paterno', '$TelDoc', '$CURPDoc', '$DireccionDoc', '$CorreoDoc', '$CedulaDoc')";
        if(mysqli_query($conectar, $consulta)) {
            echo "<script>alert('Doctor agregado correctamente.');</script>";
        } else {
            echo "Error al agregar doctor: " . mysqli_error($conectar);
        }
    }
}


// Eliminar doctor
if(isset($_GET['eliminar'])) {
    $idDoc = $_GET['eliminar'];
    $consulta = "DELETE FROM doctor WHERE idDoc=$idDoc"; // Corregido el nombre de la tabla
    if(mysqli_query($conectar, $consulta)) {
        echo "Doctor eliminado correctamente.";
    } else {
        echo "Error al eliminar doctor: " . mysqli_error($conectar);
    }
}

// Mostrar doctores existentes
$consulta = "SELECT * FROM doctor"; // Corregido el nombre de la tabla
$query = mysqli_query($conectar, $consulta);
if (!$query) {
    die("Error en la consulta: " . mysqli_error($conectar));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Proyecto de base de datos"/>
    <meta name="author" content="Matias Medina Danna Lizbeth"/>
    <meta name="keywords" content="HTML, CSS, JS, SQL, PHP"/>
    <title>CRUD de Doctores</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>CRUD de Doctores</h1>
    
    <!-- Formulario para agregar nuevo doctor -->
    <h2>Agregar Nuevo Doctor</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="NombreDoc">Nombre Doctor:</label>
        <input type="text" id="NombreDoc" name="NombreDoc" required>
        <label for="Apellido_Materno">Apellido Materno:</label>
        <input type="text" id="Apellido_Materno" name="Apellido_Materno" required>
        <label for="Apellido_Paterno">Apellido Paterno:</label>
        <input type="text" id="Apellido_Paterno" name="Apellido_Paterno" required>
        <label for="TelDoc">Telefono Doctor:</label>
        <input type="text" id="TelDoc" name="TelDoc" required>
        <label for="CURPDoc">CURP Doctor:</label>
        <input type="text" id="CURPDoc" name="CURPDoc" required>
        <label for="DireccionDoc">Direccion Doctor:</label>
        <input type="text" id="DireccionDoc" name="DireccionDoc" required>
        <label for="CorreoDoc">Correo Doctor:</label>
        <input type="email" id="CorreoDoc" name="CorreoDoc" required>
        <label for="CedulaDoc">Cedula Doctor:</label>
        <input type="text" id="CedulaDoc" name="CedulaDoc" required>
        <input type="submit" name="agregar" value="Agregar Doctor">
    </form>
    
    <!-- Tabla para mostrar doctores existentes -->
    <h2>Doctores Registrados</h2>
    <table>
        <tr>
            <th>Nombre Doctor</th>
            <th>Apellido Materno</th>
            <th>Apellido Paterno</th>
            <th>Telefono Doctor</th>
            <th>CURP Doctor</th>
            <th>Direccion Doctor</th>
            <th>Correo Doctor</th>
            <th>Cedula Doctor</th>
            <th>Citas</th> <!-- Columna para Citas -->
            <th>Recetas</th> <!-- Nueva columna para Recetas -->
            <th>Acciones</th>
        </tr>
        <?php
        while ($fila = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>" . $fila['NombreDoc'] . "</td>";
            echo "<td>" . $fila['Apellido_Materno'] . "</td>";
            echo "<td>" . $fila['Apellido_Paterno'] . "</td>";
            echo "<td>" . $fila['TelDoc'] . "</td>";
            echo "<td>" . $fila['CURPDoc'] . "</td>";
            echo "<td>" . $fila['DireccionDoc'] . "</td>";
            echo "<td>" . $fila['CorreoDoc'] . "</td>";
            echo "<td>" . $fila['CedulaDoc'] . "</td>";
            echo "<td><a href='citas.php?id=" . $fila['idDoc'] . "'>Ver Citas</a></td>"; // Enlace a la página de citas
            echo "<td><a href='receta.php?id=" . $fila['idDoc'] . "'>Gestionar Recetas</a></td>"; // Enlace a la página de recetas
            echo "<td><a href='?eliminar=" . $fila['idDoc'] . "'>Eliminar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Cerrar la conexión
mysqli_close($conectar);
?>
