<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellido_Materno = $_POST['apellido_Materno'];
    $apellido_Paterno = $_POST['apellido_Paterno'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    // Datos de conexión a la base de datos
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

    // Insertar datos en la tabla
    $sql = "INSERT INTO clientes (nombre, apellido_Materno, apellido_Paterno, fecha_nacimiento, direccion, telefono)
            VALUES ('$nombre', '$apellido_Materno', '$apellido_Paterno' '$fecha_nacimiento', '$direccion', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo cliente registrado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>