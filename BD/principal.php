<?php
session_start();

// Verifica si el usuario está autenticado, si no, redirige a la página de inicio de sesión
if(!isset($_SESSION["IdNumUsuario"])) {
    header("Location: iniciar_sesion.php");
    exit;
}

// Obtener el nombre de usuario de la sesión
$Usuario = $_SESSION["IdNumUsuario"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Proyecto de base de datos"/>
    <meta name="author" content="Matias Medina Danna Lizbeth"/>
    <meta name="keywords" content="HTML, CSS, JS, SQL, PHP"/>
    <title>Página Principal</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $IdNumUsuario; ?></h2>
    <form action="cerrar_sesion.php" method="post">
        <input type="submit" value="Cerrar Sesión">
    </form>
</body>
</html>
