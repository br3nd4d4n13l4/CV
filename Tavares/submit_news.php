<?php
include 'db_connect.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $enlace = isset($_POST['enlace']) ? $_POST['enlace'] : '';

    $titulo = $conn->real_escape_string($titulo);
    $enlace = $conn->real_escape_string($enlace);

    if(!empty($titulo) && !empty($enlace)){
        $sql ="INSERT INTO noticias (titulo, enlace) VALUES ('$titulo', '$enlace')";

        if($conn->query($sql) == TRUE){
            echo "Noticia subida correctamente";
        }else{
            echo "Error: " . $sql . "<br>" .$conn->error;
        }
    }else{
        echo "Por favor, complete todos los campos.";
    }
}
$conn->close();
?>