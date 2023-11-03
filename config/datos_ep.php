<?php
header('Content-Type: application/json');

require("conexion.php");

$conexion = regresarConexion();

switch ($_GET['accion']) {
    case 'listar':
        $datos = mysqli_query($conexion, "SELECT id_evento,titulo,horainicio,horafin,colortexto,colorfondo FROM eventospredefinidos");
        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        echo json_encode($resultado);
    break;

    case 'agregar':
        $respuesta = mysqli_query($conexion, "INSERT INTO eventospredefinidos (titulo,horainicio,horafin,colortexto,colorfondo) VALUES ('$_POST[titulo]', '$_POST[horainicio]', '$_POST[horafin]', '$_POST[colortexto]', '$_POST[colorfondo]')");
        echo json_encode($respuesta);
    break;

    case 'borrar':
        $respuesta = mysqli_query($conexion, "DELETE FROM eventospredefinidos WHERE id_evento=$_POST[id_evento]");
        echo json_encode($respuesta);
    break;
}
?>