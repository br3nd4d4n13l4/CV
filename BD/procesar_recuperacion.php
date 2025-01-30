<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar las contraseñas desde el formulario
    $contraseña_nueva = $_POST['contraseña_nueva'];
    $repetir_contraseña = $_POST['repetir_contraseña'];

    // Validar que las contraseñas coincidan
    if ($contraseña_nueva != $repetir_contraseña) {
        echo "Las contraseñas no coinciden. Por favor, inténtelo de nuevo.";
    } else {
        // Aquí puedes realizar la lógica para guardar la contraseña nueva en tu base de datos o sistema de autenticación
        echo "Contraseña cambiada exitosamente.";
    }
} else {
    // Redirigir o mostrar un mensaje de error si se intenta acceder directamente a este script sin usar POST
    echo "Acceso no autorizado.";
}
?>
