<?php 
  session_start();
  if (!isset($_SESSION['usuario'])) {
    header("location:login.php");
    exit(0);  
  }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <meta charset="UTF-8">
    <title>Sistema de Gestión de Citas con Profesores</title>
    <link rel="stylesheet" type="text/css" href="estilos/home.css">
    <script src="js/bootstrap.min.js"></script>

</head>
<body>
    <header>
        <h1>Programacion de citas I.E.D. Jorge Isaacs</h1>
        <nav>
            <ul>
                <li><a href="#">Profesores</a></li>
                <li><a href="#">Mis Citas</a></li>
                <li><a href="#">Mi Perfil</a></li>
                <li><a href="#">Sobre este sitio</a></li>

                <li><small style="float:right"> <a href="cerrar_sesion.php">Cerrar Sesion</a> </small></li>

            </ul>
        </nav>
    </header>
    

    <section class="profesores">
        <div class="profesor-card">
            <img src="imagenes/predeterminada.png" height="50" width="80" alt="Profesor 1">
            <h2>Profesor de Matemáticas</h2>
            <a class="btn btn-primary" href="calendario_usuarios.php">Ver disponibilidad</a>
        </div>
        <div class="profesor-card">
            <img src="imagenes/predeterminada.png" height="50" width="80" alt="Profesor 2">
            <h2>Profesor de Historia</h2>
            <a class="btn btn-primary" href="calendario_usuarios.php">Ver disponibilidad</a>
        </div>
        <div class="profesor-card">
            <img src="imagenes/predeterminada.png" height="50" width="80" alt="Profesor 3">
            <h2>Profesor de Español</h2>
            <a class="btn btn-primary" href="calendario_usuarios.php">Ver disponibilidad</a>
        </div>
        <div class="profesor-card">
            <img src="imagenes/predeterminada.png" height="50" width="80" alt="Profesor 4">
            <h2>Profesor de Fisica</h2>
            <a class="btn btn-primary" href="calendario_usuarios.php">Ver disponibilidad</a>
        </div>
        <div class="profesor-card">
            <img src="imagenes/predeterminada.png" height="50" width="80" alt="Profesor 4">
            <h2>Profesor de Quimica</h2>
            <a class="btn btn-primary" href="calendario_usuarios.php">Ver disponibilidad</a>
        </div>
    </section>

    <footer>
        <p>Contacto: info@iedjorgeisaacs.edu.co</p>
        <p><a href="politica-privacidad.html">Política de Privacidad</a> | <a href="terminos-servicio.html">Términos de Servicio</a></p>
    </footer>
</body>
</html>
