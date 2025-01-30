<?php
// guardar_historial.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar el formulario de agregar datos al historial clínico

    // Validar datos recibidos
    $id_cita = $_POST['id_cita'];
    $descripcion = $_POST['descripcion'];
    $Alergias = $_POST['Alergias']; // Corregido aquí
    $observaciones = $_POST['observaciones'];

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hospital";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para insertar datos en el historial clínico
    $sql = "INSERT INTO historial (id_cita, descripcion, Alergias, observaciones) VALUES ($id_cita, '$descripcion', '$Alergias', '$observaciones')"; // Corregido aquí

    if ($conn->query($sql) === TRUE) {
        echo "Datos agregados al historial clínico correctamente.";
    } else {
        echo "Error al agregar datos: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Acceso no autorizado.";
}
?>
