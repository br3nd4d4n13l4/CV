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
    $Nombre = limpiar_entrada($_POST['nombre']);
    $ApellidoPaterno = limpiar_entrada($_POST['ApellidoPaterno']);
    $ApellidoMaterno = limpiar_entrada($_POST['ApellidoMaterno']);
    $Telefono = limpiar_entrada($_POST['Telefono']);
    $Turno = limpiar_entrada($_POST['Turno']);
    $NombreUsuario = limpiar_entrada($_POST['NombreUsuario']);
    $Doctor = limpiar_entrada($_POST['Doctor']);
    $Especialidad = limpiar_entrada($_POST['Especialidad']);
    $Consultorio = limpiar_entrada($_POST['Consultorio']);
    $Horario = limpiar_entrada($_POST['Horario']);
    $CURP = limpiar_entrada($_POST['CURP']);
    $consulta = "INSERT INTO cita (nombre, ApellidoPaterno, ApellidoPaterno, Telefono, Turno, NombreUsuario, Doctor, Especialidad, Consultorio, Horario, CURP) VALUES ('$Nombre', '$ApellidoPaterno', '$ApellidoMaterno0', '$Telefono', '$Turno', '$NombreUsuario', '$Doctor', '$Especialidad', '$Consultorio', '$Horario', '$CURP')";
    if(mysqli_query($conectar, $consulta)) {
        echo "Cita agregada correctamente.";
    } else {
        echo "Error al agregar doctor: " . mysqli_error($conectar);
    }
}

// Eliminar doctor
if(isset($_GET['eliminar'])) {
    $idDoc = $_GET['eliminar'];
    $consulta = "DELETE FROM cita WHERE idCita=$idCita"; 
    if(mysqli_query($conectar, $consulta)) {
        echo "Doctor eliminado correctamente.";
    } else {
        echo "Error al eliminar doctor: " . mysqli_error($conectar);
    }
}

// Mostrar doctores existentes
$consulta = "SELECT * FROM cita"; // Corregido el nombre de la tabla
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
    <title>CRUD de cita</title>
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
    <h1>CRUD de cita</h1>
    
    <!-- Formulario para agregar nuevo doctor -->
    <h2>Agregar Nueva Consulta</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nonbre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="Apellido Materno">Apellido Materno:</label> <!-- Corregido el id -->
        <input type="text" id="Apellido Materno" name="Apellido Materno">
        <label for="Apellido Paterno">Apellido Paterno:</label>
        <input type="text" id="Apellido Paterno" name="Apellido Paterno" required>
        <label for="horario">Telefono:</label>
        <input type="number" id="Telefono" name="Telefono" required>
        <label for="direccion">Correo:</label>
        <input type="email" id="Correo" name="Correo" required>
        <label for="correo">Turno:</label>
        <input type="text" id="Turno" name="Turno" required>
        <label for="cedula">Nombre Usuario:</label>
        <input type="text" id="Nombre Usuario" name="Nombre Usuario" required>
        <label for="cedula">Doctor:</label>
        <input type="text" id="Doctor" name="Doctor" required>
        <label for="cedula">Especialidad:</label>
        <input type="text" id="Especialidad" name="Especialidad" required>
        <label for="cedula">Consultorio:</label>
        <input type="text" id="Consultorio" name="Consultorio" required>
        <label for="cedula">Horario:</label>
        <input type="number" id="Horario" name="Horario" required>
        <label for="cedula">CURP:</label>
        <input type="text" id="CURP" name="CURP" required>
        <input type="submit" name="agregar" value="Agregar Doctor">
    </form>
    
    <!-- Tabla para mostrar citas existentes -->
    <h2>Citas Registradas</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellido Materno</th>
            <th>Apellido Paterno</th>
            <th>Telefono</th>
            <th>Correo Electronico</th>
            <th>Turno</th>
            <th>Nombre Usuario</th>
            <th>Doctor</th>
            <th>Especialidad</th>
            <th>Consultorio</th>
            <th>Horario</th>
            <th>CURP</th>
        </tr>
        <?php
        while ($fila = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>" . $fila['Nombre'] . "</td>"; // Corregido el nombre de las columnas
            echo "<td>" . $fila['Apellido Materno'] . "</td>";
            echo "<td>" . $fila['Apellido Paterno'] . "</td>";
            echo "<td>" . $fila['Telefono'] . "</td>";
            echo "<td>" . $fila['Correo Electronico'] . "</td>";
            echo "<td>" . $fila['Turno'] . "</td>";
            echo "<td>" . $fila['Nombre Usuario'] . "</td>";
            echo "<td>" . $fila['Doctor'] . "</td>";
            echo "<td>" . $fila['Especialidad'] . "</td>";
            echo "<td>" . $fila['Consultorio'] . "</td>";
            echo "<td>" . $fila['Horario'] . "</td>";
            echo "<td>" . $fila['Curp'] . "</td>";
            echo "<td><a href='?eliminar=" . $fila['idCita'] . "'>Eliminar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Liberar el resultado y cerrar la conexión
mysqli_free_result($query);
mysqli_close($conectar);
?>
