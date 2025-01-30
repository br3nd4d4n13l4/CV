<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos del formulario
    $nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
    $apellidoPaterno = isset($_POST['apellidoPaterno']) ? htmlspecialchars($_POST['apellidoPaterno']) : '';
    $apellidoMaterno = isset($_POST['apellidoMaterno']) ? htmlspecialchars($_POST['apellidoMaterno']) : '';
    $correo = isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : '';
    $especialidad = isset($_POST['especialidad']) ? htmlspecialchars($_POST['especialidad']) : '';
    $doctor = isset($_POST['doctor']) ? htmlspecialchars($_POST['doctor']) : '';
    $citaDia = isset($_POST['citaDia']) ? htmlspecialchars($_POST['citaDia']) : '';
    $citaHora = isset($_POST['citaHora']) ? htmlspecialchars($_POST['citaHora']) : '';

    // Verificar que todas las variables necesarias tengan datos
    if (!empty($nombre) && !empty($apellidoPaterno) && !empty($apellidoMaterno) &&
        !empty($correo) && !empty($especialidad) && !empty($doctor) &&
        !empty($citaDia) && !empty($citaHora)) {

        // Construir el mensaje de correo
        $destinatario = $correo;
        $asunto = 'Receta Médica';

        $mensaje = "Receta Médica\n\n";
        $mensaje .= "Nombre: $nombre $apellidoPaterno $apellidoMaterno\n";
        $mensaje .= "Correo: $correo\n";
        $mensaje .= "Especialidad: $especialidad\n";
        $mensaje .= "Doctor: $doctor\n";
        $mensaje .= "Fecha de la cita: $citaDia $citaHora\n";

        // Headers del correo electrónico
        $headers = "From: tuemail@tudominio.com\r\n";
        $headers .= "Reply-To: tuemail@tudominio.com\r\n";

        // Función para enviar el correo
        if (mail($destinatario, $asunto, $mensaje, $headers)) {
            echo "Receta enviada correctamente por correo electrónico.";
        } else {
            echo "Error al enviar la receta por correo electrónico.";
        }

    } else {
        echo "No se han definido todos los datos necesarios para enviar la receta por correo electrónico.";
    }
}
?>
