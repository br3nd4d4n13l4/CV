<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <style>
        .formulario {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: medium;
            border-radius: 2px;
            padding: 20px;
        }
        .formulario input, 
        .formulario select {
            margin: 5px 0;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .formulario button {
            text-decoration: none;
            font-size: medium;
            text-align: center;
            border: none;
            border-radius: 40px;
            padding: 10px 20px;
            background-color: #4CAF50; /* Color verde */
            color: white;
            cursor: pointer;
        }
        .formulario button:hover {
            background-color: #45a049; /* Color verde más oscuro */
        }
    </style>
</head>
<body>
    <div class="formulario">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" required>
            <br>
            <label for="Apellido_Paterno">Apellido Paterno: </label>
            <input type="text" name="Apellido_Paterno" id="Apellido_Paterno" required>
            <br>
            <label for="Apellido_Materno">Apellido Materno: </label>
            <input type="text" name="Apellido_Materno" id="Apellido_Materno" required>
            <br>
            <label for="sexo">Sexo: </label>
            <select name="sexo" id="sexo">
                <option value="Hombre">Hombre</option>
                <option value="Mujer">Mujer</option>
                <option value="otro">Otro</option>
            </select>
            <br>
            <label for="telefono">Telefono: </label>
            <input type="tel" name="telefono" id="telefono" maxlength="10" required>
            <br>
            <label for="correo">Correo Electronico: </label>
            <input type="email" name="correo" id="correo" required>
            <br><br>
            <button type="submit">Enviar</button>
        </form>
    </div>
    <script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-app.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyAUWaixdE0zn_2XcJgRjWE_1w4c-JB_YYs",
    authDomain: "registrarse-3e46c.firebaseapp.com",
    projectId: "registrarse-3e46c",
    storageBucket: "registrarse-3e46c.appspot.com",
    messagingSenderId: "450924697707",
    appId: "1:450924697707:web:43e05fdf91cbbb08d7f92e"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  
  async function handleSubmit(event){
    event.preventDefault();

    const nombre = document.getElementById('nombre').value;
    const Apellido_Paterno = document.getElementById('Apellido_Paterno').value;
    const Apellido_Materno = document.getElementById('Apellido_Materno').value;
    const sexo = document.getElementById('sexo').value;
    const telefono = document.getElementById('telefono').value;
    const correo = document.getElementById('correo_electronico').value;

    try{
        await addDoc(collection(db, "usuarios"), {
            nombre: nombre,
            Apellido_Paterno: Apellido_Paterno,
            Apellido_Materno: Apellido_Materno,
            sexo: sexo,
            telefono: telefono,
            correo: correo
        });
        alert("Registro exitoso");
    } catch (e) {
        console.error("Error añadiendo documento: ", e);
    }
  }
</script>
</body>
</html>
