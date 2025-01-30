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

$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$contraseña = isset($_POST['contraseña']) ? md5($_POST['contraseña']) : '';

if (!empty($usuario) && !empty($contraseña)) {
    $sql = "SELECT * FROM pacientes WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['tipo_usuario'] = 3; // Tipo de usuario para pacientes

        header("Location: paciente.php"); // Redirigir al panel de control del paciente
        exit;
    } else {
        echo "Usuario o contraseña incorrectos";
    }
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
    <title>Login Paciente</title>
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
        .login-container input[type="submit"] {
            background-color: #235284;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 0 auto; /* Centrar el botón */
        }
        .login-container input[type="submit"]:hover {
            background-color: #3982b8;
        }
        .login-container a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #333;
        }
        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="login.php" method="POST">
            <h2>Iniciar sesión como Paciente</h2>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required><br><br>
            
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required><br><br>
            
            <input type="submit" value="Iniciar sesión">
            <br><br>
        </form>
    </div>
</body>
</html>
