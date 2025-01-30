<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Proyecto de base de datos"/>
    <meta name="author" content="Matias Medina Danna Lizbeth"/>
    <meta name="keywords" content="HTML, CSS, JS, SQL, PHP"/>
    <title>Recepcionista</title>
</head>
<body>
<style>
    body {
        background-image: url("https://th.bing.com/th/id/OIP.T7IkVBvQX9JI6FCpWfk-YgHaEK?rs=1&pid=ImgDetMain");
    }
    .logo {
        text-align: left;
    }
    .logo1 {
        text-align: right;
        margin-top: -150px;
    }
    .vertical-menu {
        width: 200px; /* Set a width if you like */
    }
    .vertical-menu a {
        background-color: #0074D9; /* Blue background color */
        color: black; /* Black text color */
        display: block; /* Make the links appear below each other */
        padding: 12px; /* Add some padding */
        text-decoration: none; /* Remove underline from links */
    }
    .vertical-menu a:hover {
        background-color: #0056b3; /* Darker blue background on mouse-over */
    }
    .vertical-menu a.active {
        background-color: #0056b3; /* Add a darker blue color to the "active/current" link */
        color: white;
    }
</style>

    <marquee behavior="Recepcionista" direction="none">Recepcionista</marquee>
    <div class="logo">
        <img src="https://th.bing.com/th/id/R.66ed710b6eea83b6318eac012d00b895?rik=eSUujkoiHfByHg&pid=ImgRaw&r=0" height="150px" width="150px">
    </div>
    <div class="logo1">
        <img src="https://th.bing.com/th/id/R.0c1aa4b4604477699b19fe30bbc31e2e?rik=Gz0yTO8hKzj0Cg&riu=http%3a%2f%2f3.bp.blogspot.com%2f-f95KcV8jNhQ%2fT80lRb3Ss0I%2fAAAAAAAAAAg%2f26tRs1RuKXM%2fs1600%2fescom_logo.jpg&ehk=9p%2b10xgcmPl4aDL8%2fG6IzAopIcU1ACqK8dn6n19leLc%3d&risl=&pid=ImgRaw&r=0" height="150px" width="150px">
    </div>
    <div class="content">
        <br>
            <div class="vertical-menu">
                <a href="doctores.php" class="active">Doctores</a>
                <a href="consultorios.php">Consultorios</a>
                <a href="pacientes.php">Pacientes</a>
                <a href="citas.php">Citas</a>
                <a href="extras.php">Servicios extras</a>
                <a href="farmacia.php">Farmacia</a>
                <a href="tickets.php">Tickets</a>
                <a href="ver_historial.php">Historial medico</a>
            </div>
    </div>
</body>
</html>