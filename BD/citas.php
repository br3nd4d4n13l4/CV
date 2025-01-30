<?php
$host = "localhost";
$usuario = "root";
$password = "";
$bd = "hospital";
$conectar = mysqli_connect($host, $usuario, $password, $bd);
if (!$conectar) {
    die("Error al conectar: " . mysqli_connect_error());
}

$query = null; // Inicializar la variable $query fuera del bloque if

// Obtener el ID del doctor desde el parámetro GET
if(isset($_GET['id'])) {
    $idDoctor = $_GET['id'];

    // Consultar las citas para el doctor específico
    // Importante: Escapar el valor de $idDoctor para evitar inyección SQL
    $consulta = "SELECT * FROM citas WHERE doctor='$idDoctor'"; // Ajusta el nombre de la tabla y la columna según tu base de datos
    $query = mysqli_query($conectar, $consulta);
    if (!$query) {
        die("Error en la consulta: " . mysqli_error($conectar));
    }
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
    <title>Citas del Doctor</title>
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
    <h1>Citas del Doctor</h1>
    
    <?php if($query && mysqli_num_rows($query) > 0): ?>
    <!-- Tabla para mostrar las citas del doctor -->
    <table>
        <tr>
            <th>Fecha de la Cita</th>
            <th>Hora de la Cita</th>
            <th>Paciente</th>
            <!-- Agrega más columnas según la información que deseas mostrar -->
        </tr>
        <?php
        while ($fila = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>" . $fila['cita_dia'] . "</td>"; // Cambia 'cita_dia' por el nombre real de la columna de fecha
            echo "<td>" . $fila['cita_hora'] . "</td>"; // Cambia 'cita_hora' por el nombre real de la columna de hora
            echo "<td>" . $fila['nombre'] . " " . $fila['Apellido_Paterno'] . " " . $fila['Apellido_Materno'] . "</td>"; // Concatena nombre completo del paciente
            // Agrega más <td> según la información de las citas
            echo "</tr>";
        }
        ?>
    </table>
    <?php else: ?>
    <p>No hay citas registradas para este doctor.</p>
    <?php endif; ?>
    
</body>
</html>

<?php
// Cerrar la conexión
mysqli_close($conectar);
?>
