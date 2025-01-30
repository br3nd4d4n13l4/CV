<?php
    $host = "127.0.0.1";
    $usuario = "root";
    $password = "";
    $bd = "hospital";
    $conectar = mysqli_connect($host, $usuario, $password, $bd); // Establecer la conexión y seleccionar la base de datos
    if (!$conectar) {
        die("Error al conectar: " . mysqli_connect_error());
    }

    // Leer operación CRUD desde la URL
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    // Operación de Crear
    if ($action == 'create') {
        // Recibir datos del formulario
        $id_Pac = $_POST['id_Pac'];
        $id_Usuario = $_POST['id_Usuario'];
        $Telefono = $_POST['Telefono'];
        $Nombre = $_POST['Nombre'];
        $Apellido_Materno = $_POST['Apellido_Materno'];
        $Apellido_Paterno = $_POST['Apellido_Paterno'];
        $Correo = $_POST['Correo'];
        $Edad = $_POST['Edad'];
        $Sexo = $_POST['Sexo'];
        $usuario = $_POST['usuario'];

        // Insertar datos en la tabla de pacientes
        $consulta = "INSERT INTO pacientes (id_Pac, id_Usuario, Telefono, Nombre, Apellido_Materno, Apellido_Paterno, Correo, Edad, Sexo, usuario) VALUES ('$id_Pac', '$id_Usuario', '$Telefono', '$Nombre', '$Apellido_Materno', '$Apellido_Paterno', '$Correo', '$Edad', '$Sexo', '$usuario')";
        $query = mysqli_query($conectar, $consulta);
        if (!$query) {
            die("Error al crear registro: " . mysqli_error($conectar));
        }
    }

    // Operación de Eliminar
    if ($action == 'delete') {
        $id = $_GET['id'];
        $consulta = "DELETE FROM pacientes WHERE id_Pac='$id'";
        $query = mysqli_query($conectar, $consulta);
        if (!$query) {
            die("Error al eliminar registro: " . mysqli_error($conectar));
        }
    }

    $consulta = "SELECT * FROM `pacientes`";
    $query = mysqli_query($conectar, $consulta);
    if (!$query) {
        die("Error en la consulta: " . mysqli_error($conectar));
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
    <title>Mostrar Datos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Datos de la tabla "Paciente"</h1>
    <table>
        <tr>
            <th>id_Pac</th>
            <th>id_Usuario</th>
            <th>Telefono</th>
            <th>Nombre</th>
            <th>Apellido_Materno</th>
            <th>Apellido_Paterno</th>
            <th>Correo</th>
            <th>Edad</th>
            <th>Sexo</th>
            <th>usuario</th>
            <th>Acciones</th>
        </tr>
        <?php
            while ($fila = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>" . $fila['id_Pac'] . "</td>";
                echo "<td>" . $fila['id_Usuario'] . "</td>";
                echo "<td>" . $fila['Telefono'] . "</td>";
                echo "<td>" . $fila['Nombre'] . "</td>";
                echo "<td>" . $fila['Apellido_Materno'] . "</td>";
                echo "<td>" . $fila['Apellido_Paterno'] . "</td>";
                echo "<td>" . $fila['Correo'] . "</td>";
                echo "<td>" . $fila['Edad'] . "</td>";
                echo "<td>" . $fila['Sexo'] . "</td>";
                echo "<td>" . $fila['usuario'] . "</td>";
                echo "<td>";
                echo "<a href='?action=delete&id=" . $fila['id_Pac'] . "'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            mysqli_free_result($query);
            mysqli_close($conectar);
        ?>
    </table>
    <h2>Agregar nuevo paciente</h2>
    <form action="?action=create" method="post">
        Tipo_de_sangre: <input type="text" name="Tipo_de_sangre"><br>
        Altura: <input type="number" name="Altura"><br>
        Peso: <input type="number" name="Peso"><br>
        Telefono_Pac: <input type="number" name="Telefono_Pac"><br>
        Direccion_Pac: <input type="text" name="Direccion_Pac"><br>
        CURP_Pac: <input type="text" name="CURP_Pac"><br>
        Nombre_Pac: <input type="text" name="Nombre_Pac"><br>
        Apellido_Materno: <input type="text" name="Apellido_Materno"><br>
        Apellido_Paterno: <input type="text" name="Apellido_Paterno"><br>
        <input type="submit" value="Agregar">
    </form>
</body>
</html>
