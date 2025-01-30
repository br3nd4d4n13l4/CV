<?php
include 'db_connect.php';

$id = $_GET['id'];

$sql = "DELETE FROM noticias WHERE id=$id";

if($conn->query($sql) === TRUE){
    echo "Noticia eliminada con exito";
}else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>