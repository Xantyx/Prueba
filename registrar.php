    <!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Gabarito&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="imagenes/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="estilos/stile.css">
        <link href="config/conexion.php">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Citas I.E.D. Jorge Isaacs</title>

    </head>
    <body>
        <h2>¡Bienvenido al programa de agendacion de citas del I.E.D. Jorge Isaacs! </h2>
    <div class="container" style="margin-top: 1%;">
        <form method="POST" action="">
            <p>Por favor, diligencie todos los campos de este formulario.</p>
            
        <div class= "form">
            <label for="Name">Nombre</label>
            <input class="input" type="text" name="Name" placeholder="Ingrese su nombre"  required>
        </div>
        
        <div class= "form">
            <label for="LastName">Apellido</label>
            <input class="input" type="text" name="LastName" placeholder="Ingrese su apellido"  required>
        </div>
        
        <div class= "form">
            <label for="Correo">Correo</label>
            <input class="input" type="email" name="Correo" placeholder="Ingrese su correo"  required>
        </div>
        <div class= "form">
            <label for="Curso">Telefono</label>
            <input class="input" inputmode="numeric" type="number" name="Tel" placeholder="Ingrese su telefono"  required>
        </div>
        <div class="form">
            <label for="birthday">Fecha de nacimiento</label>
            <input class="input" type="date" id="birthday" name="birthday">
        </div>
        <div class="form">
            <label for="birthday">Nombre de Usuario</label>
            <input class="input" type="text" id="usuario" name="usuario">
        </div>
        <div class= "form">
            <label for="Correo">Contraseña</label>
            <input class="input" type="password" name="password" placeholder="Cree una contraseña"  required>
        </div>
        <div class="form">
            <input class="btn btn-success" type="submit" value="Enviar">
            <a href="index.html" class="btn btn-success">Regresar al inicio</a>
        </div>
        </form>
        <?php
        require('config/conexion.php'); // Asegúrate de que la ruta al archivo de conexión sea correcta.
        
        if ($_POST) {
            $conexion = regresarConexion(); // Llama a la función para obtener la conexión.
        
            $nom = $_POST['Name'];
            $ape = $_POST['LastName'];
            $correo = $_POST['Correo'];
            $birthday = $_POST['birthday'];
            $tel = $_POST['Tel'];
            $user = $_POST['usuario'];
            $pass = $_POST['password'];
        
            $sql = 'INSERT INTO usuarios (nombre, apellido, correo, fe_nac, telefono, usuario, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?)';
        
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ssssdss", $nom, $ape, $correo, $birthday, $tel, $user, $pass);
        
            if ($stmt->execute()) {
                echo "<script> alert('Registrado con éxito');</script>";
            } else {
                echo "<script> alert('Error al registrar');</script>";
            }
        
            $stmt->close();
            $conexion->close();
        }
        ?>
        

<style>
        body{
            background-image: url(imagenes/Agendacion.jpg);
            background-size: cover;
        }
    </style>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
    </html>