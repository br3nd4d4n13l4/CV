<?php
// ver_historial.php

// Verificar si se ha proporcionado un ID válido a través de la URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID de cita inválido.";
    exit;
}

$id_cita = $_GET['id'];

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar la información de la cita seleccionada
$sql = "SELECT * FROM citas WHERE id = $id_cita";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Mostrar información de la cita
    echo "<h1>Historial Clínico - Cita ID: {$row['id']}</h1>";
    echo "<p>Nombre: {$row['nombre']}</p>";
    echo "<p>Apellido Paterno: {$row['Apellido_Paterno']}</p>";
    echo "<p>Apellido Materno: {$row['Apellido_Materno']}</p>";
    echo "<p>Correo: {$row['correo']}</p>";
    echo "<p>Fecha de la cita: {$row['cita_dia']} {$row['cita_hora']}</p>";

    // Formulario para agregar datos al historial clínico
    echo "<h2>Agregar Datos al Historial Clínico</h2>";
    echo "<form action='guardar_historial.php' method='post'>";
    echo "<input type='hidden' name='id_cita' value='{$row['id']}'>";
    echo "<textarea name='descripcion' placeholder='Descripción del evento clínico'></textarea><br>";
    echo "<textarea name='Alergias' placeholder='Alergias'></textarea><br>";
    echo "<textarea name='observaciones' placeholder='Observaciones'></textarea><br>";
    echo "<input type='submit' value='Agregar'>";
    echo "</form>";

    // Mostrar historial clínico existente si lo hubiera
    $sql_historial = "SELECT * FROM historial WHERE id_cita = $id_cita";
    $result_historial = $conn->query($sql_historial);

    if ($result_historial->num_rows > 0) {
        echo "<h2>Historial Clínico</h2>";
        echo "<ul>";
        while ($row_historial = $result_historial->fetch_assoc()) {
            echo "<li>{$row_historial['descripcion']}</li>";
            echo "<li><strong>Alergias:</strong> {$row_historial['Alergias']}</li>";
            echo "<li><strong>Observaciones:</strong> {$row_historial['observaciones']}</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No hay datos en el historial clínico.</p>";
    }

} else {
    echo "Cita no encontrada.";
}

$conn->close();
?>
