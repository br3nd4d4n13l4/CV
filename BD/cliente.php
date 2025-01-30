<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Proyecto de base de datos"/>
    <meta name="author" content="Matias Medina Danna Lizbeth"/>
    <meta name="keywords" content="HTML, CSS, JS, SQL, PHP"/>
    <title>Regsitro de clientes</title>
</head>
<body>
    <h2>Registro de clientes</h2>
    <form action="registro_cliente.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="apellido_Materno">apellido_Materno:</label>
        <input type="text" id="apellido_Materno" name="apellido_Materno" required>
        <label for="apellido_Paterno">apellido_Paterno:</label>
        <input type="text" id="apellido_Paterno" name="apellido_Paterno" required>
        <label for="fecha_nacimiento">fecha_nacimiento:</label>
        <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" required>
        <label for="direccion">direccion:</label>
        <input type="text" id="direccion" name="direccion" required>
        <label for="telefono">telefono:</label>
        <input type="number" id="telefono" name="telefono" required>
    <input type="submit" value="Registrar">
    </form>
</body>
</html>