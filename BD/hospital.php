<?php
    $host = "127.0.0.1";
    $usuario = "root";
    $password = "";
    $bd = "hospital";
    $conectar = mysqli_connect($host, $usuario, $password);
    if (!$conectar) {
        die("Error al conectar: " . mysqli_connect_error());
    }
    mysqli_select_db($conectar, $bd);

    // Leer operación CRUD desde la URL
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    // Operación de Crear
    if ($action == 'create') {
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $consulta = "INSERT INTO hospital (nombre_hospital, direccion_hospital) VALUES ('$nombre', '$direccion')";
        $query = mysqli_query($conectar, $consulta);
        if (!$query) {
            die("Error al crear registro: " . mysqli_error($conectar));
        }
    }

    // Operación de Actualizar
    if ($action == 'update') {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $consulta = "UPDATE hospital SET nombre_hospital='$nombre', direccion_hospital='$direccion' WHERE id_hospital='$id'";
        $query = mysqli_query($conectar, $consulta);
        if (!$query) {
            die("Error al actualizar registro: " . mysqli_error($conectar));
        }
    }

    // Operación de Eliminar
    if ($action == 'delete') {
        $id = $_GET['id'];
        $consulta = "DELETE FROM hospital WHERE id_hospital='$id'";
        $query = mysqli_query($conectar, $consulta);
        if (!$query) {
            die("Error al eliminar registro: " . mysqli_error($conectar));
        }
    }

    $consulta = "SELECT * FROM `hospital`";
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
    <h1>Datos de la tabla "Hospital"</h1>
    <table>
        <tr>
            <th>id_hospital</th>
            <th>nombre_hospital</th>
            <th>direccion_hospital</th>
            <th>Acciones</th>
        </tr>
        <?php
            while ($fila = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>" . $fila['id_hospital'] . "</td>";
                echo "<td>" . $fila['nombre_hospital'] . "</td>";
                echo "<td>" . $fila['direccion_hospital'] . "</td>";
                echo "<td>";
                echo "<a href='?action=delete&id=" . $fila['id_hospital'] . "'>Eliminar</a> | ";
                echo "<a href='update.php?id=" . $fila['id_hospital'] . "'>Actualizar</a>";
                echo "</td>";
                echo "</tr>";
            }
            mysqli_free_result($query);
            mysqli_close($conectar);
        ?>
    </table>
    <h2>Agregar nuevo hospital</h2>
    <form action="?action=create" method="post">
        Nombre: <input type="text" name="nombre"><br>
        Dirección: <input type="text" name="direccion"><br>
        <input type="submit" value="Agregar">
    </form>
</body>
</html>