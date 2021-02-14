<?php
include('db.php'); //mysqli

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if (isset($_POST['guardar_datos'])) {
    $id = $_POST['id'];
    $correo = $_POST['correo'];
    $contacto = $_POST['contacto'];

    echo $id;

     $sql = "SELECT * FROM usuarios WHERE rut = '" . $rut . "' OR correo = '" . $email . "' OR telefono = '" . $telefono . "'";
    $select = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($select); 
    mysql_query($mysqli, "UPDATE  usuarios SET correo = '$correo', contacto = '$contacto' WHERE id = '$id' "); 

     if ($row > 0) {
        $error = 'El dato ya existe'; 
    } else {
        $query = "UPDATE INTO usuarios (rut, nombres, apellidos, correo ,telefono) VALUES ('$rut', '$nombres', '$apellidos', '$email', '$telefono')";
        $result = mysqli_query($mysqli, $query);
        header("Location: https://ssosorno.cl/");
    }
}
?>
