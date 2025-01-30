<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = new mysqli("localhost", "root", "", "hospital");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $Nombre = $_POST["Nombre"];
    $Apellido_Paterno = $_POST["Apellido_Paterno"];
    $Apellido_Materno = $_POST["Apellido_Materno"];
    $Edad = $_POST["Edad"];
    $Sexo = $_POST["Sexo"];
    $Correo = $_POST["Correo"];
    $usuario = $_POST['usuario'];
    $contraseña = md5($_POST["contraseña"]);
    $ConfirmaContraseña = md5($_POST["ConfirmaContraseña"]);

    if ($contraseña !== $ConfirmaContraseña) {
        die("Error: Las contraseñas no coinciden.");
    }

    // Corrige la sentencia SQL para que coincida con los campos de la tabla pacientes
    $stmt = $conexion->prepare("INSERT INTO pacientes (Nombre, Apellido_Paterno, Apellido_Materno, Edad, Sexo, Correo, usuario, contraseña) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiisss", $Nombre, $Apellido_Paterno, $Apellido_Materno, $Edad, $Sexo, $Correo, $usuario, $contraseña);

    if ($stmt->execute()) {
        // Redirigir al login específico para pacientes
        header("Location: login_paciente.php");
        exit;
    } else {
        echo "Error al registrar usuario: " . $stmt->error;
    }

    $stmt->close();
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
    <title>Registrarse</title>
    <style>
        .registro {
            text-align: center;
            border: 1px solid black; /* Corregido: una línea de borde */
            padding: 20px; /* Añadido: espacio interno para mejor apariencia */
            max-width: 400px; /* Añadido: limitar el ancho del formulario */
            margin: 0 auto; /* Añadido: centrar el formulario horizontalmente */
            border-radius: 10px; /* Añadido: bordes redondeados */
        }
        .registro input[type="text"],
        .registro input[type="email"],
        .registro input[type="number"],
        .registro input[type="password"],
        .registro select {
            width: calc(100% - 20px); /* Ajuste para el ancho de los inputs */
            padding: 10px; /* Espacio interno para los inputs */
            margin-bottom: 10px; /* Espacio entre elementos */
        }
        .registro input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #235284;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="registro">
        <form method="post" action="registrarse.php">
            <label for="Nombre">Nombre:</label>
            <input type="text" name="Nombre" required placeholder="Patricia">
            <br><br>
            <label for="Apellido_Paterno">Apellido Paterno:</label>
            <input type="text" name="Apellido_Paterno" required placeholder="Torrez">
            <br><br>
            <label for="Apellido_Materno">Apellido Materno:</label>
            <input type="text" name="Apellido_Materno" required placeholder="Magon">
            <br><br>
            <label for="Correo">Correo:</label>
            <input type="email" name="Correo" required placeholder="Patricia@...">
            <br><br>
            
            <label for="Edad">Edad:</label>
            <input type="number" name="Edad" required placeholder="18">
            <br><br>
            <label for="Sexo">Sexo:</label>
            <select name="Sexo" id="sexo">
                <option value="H">Hombre</option>
                <option value="M">Mujer</option>
            </select>
            <br><br>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario">
            <br><br>
            <label for="contraseña">Contraseña:</label>
            <input type="password" name="contraseña" required>
            <br><br>
            <label for="ConfirmaContraseña">Confirmar Contraseña:</label>
            <input type="password" name="ConfirmaContraseña" required>
            <br><br>
            <input type="submit" value="Registrarse">
        </form>
    </div>
</body>
</html>