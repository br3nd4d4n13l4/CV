<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener citas ordenadas
$sql = "SELECT *, TIMESTAMPDIFF(HOUR, NOW(), CONCAT(cita_dia, ' ', cita_hora)) AS horas_hasta_cita FROM citas ORDER BY cita_dia, cita_hora";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1><center>Citas</center></h1>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Día de la consulta</th>
                <th>Hora</th>
                <th>CURP</th>
                <th>Doctor</th>
                <th>Especialidad</th>
                <th>Día de creación</th>
                <th>Estado</th>
                <th>Acciones</th> <!-- Nueva columna para acciones -->
            </tr>";
    while ($row = $result->fetch_assoc()) {
        // Determinar si la cita fue cancelada y mostrar mensaje adecuado
        $cancelada = $row['cancelada']; // Asignar valor de la columna 'cancelada'
        $estado_cita = $cancelada ? "Cancelada" : "Activa"; // Usar $cancelada aquí

        if ($cancelada) {
            $horas_hasta_cita = $row['horas_hasta_cita'];
            if ($horas_hasta_cita <= -48) {
                $mensaje_cobro = "Se cobrará por la cancelación (más de 48 horas antes).";
            } else {
                $mensaje_cobro = "No hay cargos por la cancelación (menos de 48 horas antes).";
            }
        } else {
            $mensaje_cobro = ""; // No mostrar mensaje de cobro si la cita no está cancelada
        }

        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['Apellido_Paterno']}</td>
                <td>{$row['Apellido_Materno']}</td>
                <td>{$row['correo']}</td>
                <td>{$row['telefono']}</td>
                <td>{$row['cita_dia']}</td>
                <td>{$row['cita_hora']}</td>
                <td>{$row['CURP']}</td>
                <td>{$row['doctor']}</td>
                <td>{$row['especialidad']}</td>
                <td>{$row['creada_por']}</td>
                <td>{$estado_cita}</td>";
                

        echo "<td>";

        // Botón Ver
        echo "<a href='ver_historial.php?id={$row['id']}'>Historial Clínico</a> ";

        // Botón Editar
        echo "<a href='editar_cita.php?id={$row['id']}'>Editar cita</a> ";

        // Botón Cancelar
        if (!$cancelada) { // Mostrar botón solo si la cita no está cancelada
            echo "<form action='cancelar_cita.php' method='post' style='display: inline-block;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='submit' value='Cancelar' onclick='return confirm(\"¿Estás seguro de que quieres cancelar esta cita?\");'>
                  </form>";
        }

        // Enlace para generar y enviar la receta

        echo "</td>";
        echo "</tr>";

        // Mostrar mensaje de cobro si la cita fue cancelada
        if ($cancelada) {
            echo "<tr><td colspan='14'><strong>Mensaje:</strong> {$mensaje_cobro}</td></tr>";
        }
    }
    echo "</table>";
} else {
    echo "No hay citas agendadas";
}
$conn->close();
?>
