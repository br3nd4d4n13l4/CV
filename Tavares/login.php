<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $bdname = "tavares";

    $conn = new mysqli($servername, $username, $password, $bdname);

    if($conn->connect_error){
        die("Conexion fallida: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
        $contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

        // Escapar los valores para prevenir inyección SQL
        $usuario = $conn->real_escape_string($usuario);
        $contraseña = $conn->real_escape_string($contraseña);

        if(!empty($usuario) && !empty($contraseña)){
            // Consulta SQL para verificar el usuario y contraseña
            $sql = "SELECT * FROM login WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Usuario autenticado correctamente
                session_start(); // Iniciar sesión
                $_SESSION['usuario'] = $usuario; // Guardar el nombre de usuario en la sesión

                // Redirigir a la página inicio.php
                header("Location: inicio.php");
                exit; // Asegurar que el script se detenga después de la redirección
            } else {
                echo "<p>Usuario o contraseña incorrectos</p>";
            }
        } else {
            echo "<p>Llene los datos correctamente</p>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Veruete Hernandez Bryan David">
    <title>Login</title>
    <style>
        body {
            background-image: url('identidad_grafica_autentico[1]_page-003.jpg');
            background-size: cover; /* Asegura que la imagen cubra el fondo */
            background-position: center; /* Centra la imagen en el fondo */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            margin: 0;
            padding: 0;
        }
        .container {
            text-align: center;
            background-color: rgb(144, 238, 144);
            font-size: medium;
            border: 2px solid gold; /* Establecer borde sólido de 2px de ancho y color dorado */
            padding: 20px;
            margin: 0 auto;
            width: 300px;
            max-width: 80%; /* Ajustar el ancho máximo para que sea responsivo */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Sombra ligera para resaltar el contenedor */
            border-radius: 10px; /* Opcional: Bordes redondeados para el contenedor */
        }
        header {
            text-align: center;
            margin-top: 20px;
        }
        h1 {
            color: #333; /* Color del texto para contraste */
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            margin-bottom: 5px;
        }
        input {
            margin-bottom: 15px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 80%; /* Ajustar el ancho de los campos de entrada */
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <div class="container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario">
            <label for="contraseña">Contraseña: </label>
            <input type="password" name="contraseña" id="contraseña">
            <button type="submit">Iniciar Sesión</button>
             <a href="registrarse.php">Registrarse</a>
        </form>
    </div>
</body>
</html>
