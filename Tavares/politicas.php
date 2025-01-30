<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Noticias</title>
</head>
<style>
    body{
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }
    .container{
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1{
        text-align: center;
    }
    from{
        display: flex;
        flex-direction: column;
    }
    label{
        margin-bottom: 8px;
        font-weight: bold;
    }
    input[type="text"], input[type="url"]{
        margin-bottom: 12px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    button{
        padding: 10px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover{
        background-color: #218838;
    }
</style>
<body>
    <div class="container">
        <h1>Politicas</h1>
        <form action="submit_news.php" method="post">
            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" required>
            
            <label for="enlace">Enlace: </label>
            <input type="url" id="enlace" name="enlace" required>

            <button type="submit">Subir Noticia</button>
        </form>
    </div>
</body>
</html>