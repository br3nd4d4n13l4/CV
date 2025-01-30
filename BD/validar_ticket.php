<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Suponiendo que tienes variables para el nombre y el precio del producto
$nombre = "Paracetamol";
$precio = 10.50;

// Consulta SQL para insertar un nuevo producto
$sql_producto = "INSERT INTO productos (nombre, precio) VALUES ('$nombre', $precio)";

if (mysqli_query($conn, $sql_producto)) {
    echo "Nuevo producto insertado correctamente.";
} else {
    echo "Error al insertar el producto: " . mysqli_error($conn);
}

// Suponiendo que tienes el id del producto asociado al ticket
$id_producto = 1; // Aquí deberías obtener el id del producto de alguna manera
$MontoTicket = 100.50; // Suponiendo un valor para MontoTicket

// Consulta SQL para insertar un nuevo ticket asociado a un producto
$sql_ticket = "INSERT INTO ticket (id_producto, MontoTicket) VALUES ($id_producto, $MontoTicket)";

if (mysqli_query($conn, $sql_ticket)) {
    echo "Nuevo ticket insertado correctamente.";
} else {
    echo "Error al insertar el ticket: " . mysqli_error($conn);
}

// Cerrar conexión
mysqli_close($conn);
?>
