<?php
include("db.php");
header("Content-Type: application/json");
$consultaBusqueda = $_POST['valorBusqueda'];


$json = "";

if (isset($consultaBusqueda)) {

    /* $consulta = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE rut LIKE '%$consultaBusqueda%'"); */
    
    $consulta = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE rut = '$consultaBusqueda' ");

    $filas = mysqli_num_rows($consulta);

    if ($filas === 0) {
        $json = $filas;
    } else {
        while ($resultados = mysqli_fetch_array($consulta)) {
            $id = $resultados['id'];
            $nombres = $resultados['nombres'];
            $apellidos = $resultados['apellidos'];
            $correo = $resultados['correo'];
            $telefono = $resultados['contacto'];
            $estado = $resultados['estado'];

            $datos = [$id, $nombres, $apellidos, $correo, $telefono, $estado];
            $json = json_encode($datos);
        };
    };
};
echo $json;
