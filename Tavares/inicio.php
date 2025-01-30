<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .cgob {
            display: flex;
            justify-content: left;
            align-items: left;
            height: 150px;
            background-color: rgb(0, 50, 0); 
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .cgob img {
            max-height: 100%;
            max-width: 100%;
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .identificacion {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .id {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
        }

        .id img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .id .id-info {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido</h1>
        <div class="cgob">
            <img src="cgob.jpg" alt="Imagen descriptiva">
        </div>
        <div class="identificacion">
            <div class="id">
                <img src="prueba.png" alt="Prueba">
                <div class="id-info">
                    <!-- Aquí puedes agregar texto adicional si es necesario -->
                    <p>Eduardo Tavares</p>
                    <p>Cargo</p>
                </div>
            </div>
        </div>
    </div>
    <a href="subir_noticia.php">Subir Noticia</a>
</body>
</html>
