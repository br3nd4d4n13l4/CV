<?php
include 'db_connect.php';

$sql = "SELECT * FROM noticias";
$result = $conn->query($sql);

if($result->num_rows > 0){
    echo "<h1>Lista de Noticias</h1>";
    echo "<table>";
    echo "<tr><th>Título</th><th>Enlace</th><th>Acciones</th></tr>";
    while($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["titulo"]) . "</td>";
        echo "<td><a href='". htmlspecialchars($row["enlace"]) ."'>" . htmlspecialchars($row["enlace"]) . "</a></td>";
        echo "<td><a href='actualizar.php?id=" . urldecode($row["id"]) . "'>Actualizar</a> | <a href='eliminar.php?id=" . urldecode($row["id"]) . "'>Eliminar</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}else{
    echo "0 resultados";
}
$conn->close();
?>
