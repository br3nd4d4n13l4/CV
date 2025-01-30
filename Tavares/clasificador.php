<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clasificador</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #333;
        }

        .menu {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .menu-item {
            position: relative;
        }

        .menu-link {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
        }

        .menu-link:hover {
            background-color: #575757;
        }

        .submenu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #444;
            list-style: none;
            margin: 0;
            padding: 0;
            width: 400px; /* Ajusta según el ancho deseado */
            column-count: 2; /* Divide en dos columnas */
            column-gap: 0; /* Espacio entre columnas */
        }

        .submenu-link {
            display: block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
        }

        .submenu-link:hover {
            background-color: #555;
        }

        .dropdown:hover .submenu {
            display: block;
        }

        iframe {
            width: 100%;
            height: 600px; /* Ajusta según el tamaño deseado */
            border: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <ul class="menu">
            <li class="menu-item">
                <a href="inicio.php" class="menu-link">Inicio</a>
            </li>
            <li class="menu-item dropdown">
                <a href="#" class="menu-link">Sección</a>
                <ul class="submenu">
                    <li><a href="Ultima-hora.php" class="submenu-link">Última hora</a></li>
                    <li><a href="desarrollo.php" class="submenu-link">Desarrollo</a></li>
                    <li><a href="locales.php" class="submenu-link">Locales</a></li>
                    <li><a href="nacionales.php" class="submenu-link">Nacionales</a></li>
                    <li><a href="internacionales.php" class="submenu-link">Internacionales</a></li>
                    <li><a href="politicas.php" class="submenu-link">Políticas</a></li>
                    <li><a href="economicas.php" class="submenu-link">Económicas</a></li>
                    <li><a href="entretenimiento.php" class="submenu-link">Entretenimiento</a></li>
                    <li><a href="deportivas.php" class="submenu-link">Deportivas</a></li>
                    <li><a href="ciencia-tecnologia.php" class="submenu-link">Científica y tecnológica</a></li>
                    <li><a href="salud.php" class="submenu-link">Salud</a></li>
                    <li><a href="sociedad.php" class="submenu-link">Sociedad</a></li>
                    <li><a href="medio-ambiente.php" class="submenu-link">Medio ambiente</a></li>
                    <li><a href="opinion.php" class="submenu-link">Opinión y editorial</a></li>
                    <li><a href="investigativas.php" class="submenu-link">Investigativas</a></li>
                    <li><a href="cronicas.php" class="submenu-link">Crónicas</a></li>
                    <li><a href="adultosMayores.php" class="submenu-link">Adultos Mayores</a></li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="contacto.php" class="menu-link">Contacto</a>
            </li>
        </ul>
    </nav>
    <script src="scripts.js"></script>
</body>
</html>
