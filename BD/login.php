<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$maxIntentos = 3;
$tiempoBloqueo = 60;

$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

if (!empty($usuario) && !empty($contraseña)) {
    if (isset($_SESSION['intentos']) && $_SESSION['intentos'] >= $maxIntentos && (time() - $_SESSION['tiempo_ultimo_intento']) < $tiempoBloqueo) {
        echo "Tu cuenta ha sido bloqueada temporalmente debido a múltiples intentos fallidos. Inténtalo de nuevo más tarde.";
    } else {
        $sql = "SELECT * FROM login WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['contraseña'] = $row['contraseña'];
            $_SESSION['tipo_usuario'] = $row['tipo_usuario'];

            unset($_SESSION['intentos']);
            unset($_SESSION['tiempo_ultimo_intento']);

            switch ($row['tipo_usuario']) {
                case 0:
                    header("Location: administrador.php");
                    break;
                case 1:
                    header("Location: recepcionista.php");
                    break;
                case 2:
                    header("Location: doctor.php");
                    break;
                case 3:
                    header("Location: paciente.php");
                    break;
                default:
                    header("Location: index.php");
                    break;
            }
        } else {
            if (!isset($_SESSION['intentos'])) {
                $_SESSION['intentos'] = 1;
            } else {
                $_SESSION['intentos']++;
            }
            $_SESSION['tiempo_ultimo_intento'] = time();

            echo "Usuario o contraseña incorrectos";

            if ($_SESSION['intentos'] >= $maxIntentos) {
                echo " Tu cuenta ha sido bloqueada temporalmente debido a múltiples intentos fallidos. Inténtalo de nuevo más tarde.";
            }
        }
    }
} else {
     // Mostrar mensaje si el formulario no está completo
    
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Proyecto de base de datos"/>
    <meta name="author" content="Matias Medina Danna Lizbeth"/>
    <meta name="keywords" content="HTML, CSS, JS, SQL, PHP"/>
    <title>Login</title>
    <style>
        body {
            background-image: url("https://static.vecteezy.com/system/resources/previews/000/656/903/original/vector-set-of-doctor-cartoon-characters-medical-staff-team-concept.jpg");
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .login-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .login-container input[type="submit"],
        .login-container a {
            width: calc(100% - 40px); /* Ajuste para compensar el padding */
            display: block;
            text-align: center;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            color: white;
            text-decoration: none;
            margin: 0 auto; /* Centrar horizontalmente */
        }
        .login-container input[type="submit"] {
            background-color: #235284;
            margin-bottom: 10px; /* Espacio entre botón y enlace */
        }
        .login-container input[type="submit"]:hover,
        .login-container a:hover {
            background-color: #3982b8;
        }
        .login-container a {
            background-color: #235284; /* Color de fondo para el enlace */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="login.php" method="POST">
            <h2>Iniciar sesión</h2>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required><br><br>
            
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required><br><br>
            
            <input type="submit" value="Iniciar sesión">
            <a href="registrarse.php">Regístrate</a>
            <br><br>
        </form>
    </div>
</body>
</html>
