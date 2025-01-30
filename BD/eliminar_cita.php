<?php
// eliminar_cita.php

// Verificar si se ha enviado el formulario por método POST y si está presente el ID de la cita
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $cita_id = $_POST['id'];

    // Incluir el archivo de conexión a la base de datos o establecer la conexión aquí mismo
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

    // Consulta para eliminar la cita de la base de datos
    $sql = "DELETE FROM citas WHERE id = $cita_id";

    if ($conn->query($sql) === TRUE) {
        echo "La cita ha sido eliminada correctamente.";
    } else {
        echo "Error al eliminar la cita: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();

    // Redirigir a la página principal de citas después de la eliminación
    header("Location: citas.php");
    exit();
} else {
    echo "Acceso no autorizado.";
}
?>
