<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se ha enviado el formulario
    include("config/conexion.php"); // Incluye el archivo de conexión

    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    if (!empty($usuario) && !empty($contrasena)) {
        $conexion = regresarConexion(); // Establece la conexión a la base de datos

        if ($conexion) {
            // Evita posibles ataques de inyección SQL utilizando sentencias preparadas
            $query = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?");
            $query->bind_param("ss", $usuario, $contrasena);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows === 1) {
                // Inicio de sesión exitoso
                $_SESSION['usuario'] = $usuario;
                header("location: home_usuarios.php");
                exit();
            } else {
                echo '<script>alert("Credenciales incorrectas. Por favor, intenta de nuevo.");</script>';
            }

            $query->close();
            $conexion->close();
        } else {
            echo "Error en la conexión a la base de datos.";
        }
    } else {
        echo "Los campos de usuario y contraseña son requeridos.";
    }
}
?>
