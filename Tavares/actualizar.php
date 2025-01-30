<?php
include 'db_connect.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id = $_GET['id'];
    $sql = "SELECT * FROM noticias WHERE id=$id";
    $result = $conn->query($sql);
    $news = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Noticia</title>
</head>
<body>
    <h1>Actualizar Noticia</h1>
    <form action="actualizar.php" method="post">
        <input type="hidden" name="id" value="<?php echo $news['id']; ?>">

        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo $news['titulo']; ?>" required>

        <label for="enlace">Enlace:</label>
        <input type="url" name="enlace" id="enlace" value="<?php echo $news['enlace']; ?>" required>

        <button type="submit">Actualizar Noticia</button>
    </form>
</body>
</html>

<?php
} elseif($_SERVER['REQUIEST_METHOD'] === "POST"){
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $enlace = $_POST['enlace'];
    $sql = "UPDATE noticias SET titulo='$titulo', enlace='$enlace' WHERE id=$id";

    if($conn->query($sql) === TRUE){
        echo "Noticia actualizada con exito";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>