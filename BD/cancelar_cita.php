<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hospital";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM citas WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $fecha_creacion = strtotime($row['creada_por']);
        $ahora = time();
        $horas_transcurridas = ($ahora - $fecha_creacion) / (60 * 60);

        $costo_cita = isset($row['costo']) ? $row['costo'] : 0; // Adjust for undefined costo
        $comision = 0;
        $mensaje_cobro = "";

        if ($horas_transcurridas >= 24) {
            $comision = 0.15 * $costo_cita;
            $mensaje_cobro = "Se aplicó una comisión del 15% ($" . number_format($comision, 2) . ") por la cancelación.";
        } else {
            $mensaje_cobro = "No se aplica comisión por la cancelación.";
        }

        $sql_update = "UPDATE citas SET cancelada = 1, mensaje_cobro = '$mensaje_cobro' WHERE id = $id";

        if ($conn->query($sql_update) === TRUE) {
            $_SESSION['mensaje_cita'] = "La cita ha sido cancelada correctamente.";
            header("Location: ver_citas.php");
            exit();
        } else {
            $_SESSION['mensaje_cita'] = "Error al cancelar la cita: " . $conn->error;
        }
    } else {
        $_SESSION['mensaje_cita'] = "No se encontró la cita con ID: $id";
    }

    $conn->close();
} else {
    header("Location: ver_citas.php");
    exit();
}
?>
