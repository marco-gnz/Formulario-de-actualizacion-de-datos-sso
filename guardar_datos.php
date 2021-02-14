<?php
include('db.php'); //mysqli

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if (isset($_POST['guardar_datos'])) {
    $rut = $_POST['rut'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    /* $sql = "SELECT * FROM usuarios WHERE rut = '" . $rut . "' OR correo = '" . $email . "' OR telefono = '" . $telefono . "'";
    $select = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($select); */
    $sql = "UPDATE usuarios ";

    if ($row > 0) {
        $error = 'El dato ya existe'; 
    } else {
        $query = "UPDATE INTO usuarios (rut, nombres, apellidos, correo ,telefono) VALUES ('$rut', '$nombres', '$apellidos', '$email', '$telefono')";
        $result = mysqli_query($mysqli, $query);
        header("Location: https://ssosorno.cl/");
    }
}
