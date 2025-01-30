<?php
session_start();

// Verificar si existe la sesión de carrito
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Función para agregar un producto al carrito
function agregarAlCarrito($nombre, $precio) {
    $_SESSION['carrito'][] = array(
        'nombre' => $nombre,
        'precio' => $precio
    );
}

// Verificar si se recibió una solicitud para agregar al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['producto']) && isset($_POST['precio'])) {
        agregarAlCarrito($_POST['producto'], $_POST['precio']);
    }
}

// Mostrar el contenido del carrito como un ticket de compra
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Proyecto de base de datos"/>
    <meta name="author" content="Matias Medina Danna Lizbeth"/>
    <meta name="keywords" content="HTML, CSS, JS, SQL, PHP"/>
    <title>Ticket de Compra</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Ticket de Compra</h1>
    </header>
    <div class="container-ticket">
        <h2>Productos en el carrito:</h2>
        <ul>
            <?php foreach ($_SESSION['carrito'] as $producto): ?>
                <li><?php echo $producto['nombre']; ?> - $<?php echo $producto['precio']; ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="index.html" class="btn">Volver al inicio</a>
    </div>
</body>
</html>
