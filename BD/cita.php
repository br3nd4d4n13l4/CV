<?php
     echo "<script>alert('¡No puedes realizar una cita dentro de 48 horas!');</script>";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Proyecto de base de datos"/>
    <meta name="author" content="Matias Medina Danna Lizbeth"/>
    <meta name="keywords" content="HTML, CSS, JS, SQL, PHP"/>
    <title>Agendar citas</title>
</head>
<body>
    <h1>Agenda una cita</h1>
    <form action="enviar_cita.php" method="post">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="Apellido_Paterno">Apellido Paterno:</label><br>
        <input type="text" id="Apellido_Paterno" name="Apellido_Paterno" required><br><br>
        
        <label for="Apellido_Materno">Apellido Materno:</label><br>
        <input type="text" id="Apellido_Materno" name="Apellido_Materno" required><br><br>
        
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br><br>
        
        <label for="telefono">Telefono:</label><br>
        <input type="text" id="telefono" name="telefono" required><br><br>
        
        <label for="cita_dia">Día:</label><br>
        <input type="date" id="cita_dia" name="cita_dia" required><br><br>
        
        <label for="cita_hora">Hora:</label><br>
        <input type="time" id="cita_hora" name="cita_hora" required><br><br>
        
        <label for="CURP">CURP:</label><br>
        <input type="text" id="CURP" name="CURP" required><br><br>

        <label for="especialidad">Especialidad:</label>
        <select name="especialidad" id="especialidad" required>
            <option value="">Selecciona una especialidad</option>
            <option value="cardiologia">Cardiología</option>
            <option value="traumatologia">Traumatología</option>
            <option value="cirugia">Cirugía</option>
            <option value="neurologia">Neurología</option>
            <option value="nutriologia">Nutriología</option>
            <option value="ginecologia">Ginecología</option>
            <option value="cirujano_plastico">Cirujano Plástico</option>
            <option value="medico_general">Médico General</option>
            <option value="ornitoralingologo">Otorrinolaringólogo</option>
            <option value="anestesiologia">Anestesiología</option>
        </select><br><br>

        <label for="Doctor">Doctor:</label>
        <select name="doctor" id="Doctor" required>
            <option value="">Selecciona un doctor</option>
            <!-- Opciones de doctor se añadirán dinámicamente -->
        </select><br><br>

        <label for="consultorio">Consultorio:</label>
        <select name="consultorio" id="consultorio" required>
            <option value="">Selecciona un consultorio</option>
            <!-- Opciones de consultorios se añadirán dinámicamente -->
        </select><br><br>

        <script type="text/javascript" charset="utf-8">
            // Obtener referencia a los elementos select
            const especialidadSelect = document.getElementById('especialidad');
            const doctorSelect = document.getElementById('Doctor');
            const consultorioSelect = document.getElementById('consultorio');

            // Opciones de doctores por especialidad
            const doctoresPorEspecialidad = {
                cardiologia: ["Juan Perez", "Ana Martinez", "Carlos Gomez"],
                traumatologia: ["Pedro Sanchez", "Laura Fernandez"],
                cirugia: ["Jorge Lopez", "Carmen Garcia"],
                neurologia: ["Luis Ramirez"],
                nutriologia: ["Sofia Gonzalez"],
                ginecologia: ["Maria Rodriguez"],
                cirujano_plastico: ["Pedro Sanchez"],
                medico_general: ["Ana Martinez"],
                ornitoralingologo: ["Carlos Gomez"],
                anestesiologia: ["Sofia Gonzalez"]
            };

            // Opciones de consultorios por especialidad
            const consultoriosPorEspecialidad = {
                cardiologia: ["Consultorio 1", "Consultorio 2", "Consultorio 3"],
                traumatologia: ["Consultorio A", "Consultorio B"],
                cirugia: ["Consultorio C", "Consultorio D"],
                neurologia: ["Consultorio X"],
                nutriologia: ["Consultorio Y"],
                ginecologia: ["Consultorio Z"],
                cirujano_plastico: ["Consultorio 4"],
                medico_general: ["Consultorio 5"],
                ornitoralingologo: ["Consultorio 6"],
                anestesiologia: ["Consultorio 7"]
            };

            // Función para actualizar opciones de doctores y consultorios según la especialidad seleccionada
            function actualizarDoctoresYConsultorios() {
                // Obtener el valor seleccionado de especialidad
                const especialidadSeleccionada = especialidadSelect.value;

                // Limpiar opciones actuales de doctores y consultorios
                doctorSelect.innerHTML = '<option value="">Selecciona un doctor</option>';
                consultorioSelect.innerHTML = '<option value="">Selecciona un consultorio</option>';

                // Si se selecciona una especialidad válida, añadir opciones correspondientes de doctores y consultorios
                if (especialidadSeleccionada && doctoresPorEspecialidad[especialidadSeleccionada]) {
                    doctoresPorEspecialidad[especialidadSeleccionada].forEach(function (doctor) {
                        const option = document.createElement('option');
                        option.textContent = doctor;
                        option.value = doctor;
                        doctorSelect.appendChild(option);
                    });

                    consultoriosPorEspecialidad[especialidadSeleccionada].forEach(function (consultorio) {
                        const option = document.createElement('option');
                        option.textContent = consultorio;
                        option.value = consultorio;
                        consultorioSelect.appendChild(option);
                    });

                    // Habilitar los select de doctores y consultorios
                    doctorSelect.disabled = false;
                    consultorioSelect.disabled = false;
                } else {
                    // Deshabilitar los select de doctores y consultorios si no hay especialidad seleccionada
                    doctorSelect.disabled = true;
                    consultorioSelect.disabled = true;
                }
            }

            // Escuchar cambios en la especialidad seleccionada
            especialidadSelect.addEventListener('change', actualizarDoctoresYConsultorios);

            // Llamar a la función inicialmente para establecer el estado inicial
            actualizarDoctoresYConsultorios();
        </script>

        <br>
        <input type="submit" value="Agendar cita">
    </form>
</body>
</html>
