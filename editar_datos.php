<?php
include('db.php'); //mysqli

$id = $_POST['id'];
$correo = $_POST['correo'];
$contacto = $_POST['contacto'];



/* $query = mysql_query($mysqli, "UPDATE usuarios SET correo = '$correo', contacto = '$contacto' WHERE id = '$id' ");  */

$sql = "SELECT * FROM usuarios WHERE correo = '" . $correo . "' OR contacto = '" . $contacto . "' ";
$select = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($select);

$query = "UPDATE usuarios SET correo = '$correo', contacto = '$contacto', estado = 1 WHERE id = '$id' ";
mysqli_query($mysqli, $query);
header("Location: https://ssosorno.cl/");

/* mysql_query($mysqli, "UPDATE  usuarios SET correo = '$correo', contacto = '$contacto' WHERE id = '$id' ");  */
/* if($row > 0){
    echo 'El dato ya existe';
} else {
    $query = "UPDATE usuarios SET correo = '$correo', contacto = '$contacto', estado = 1 WHERE id = '$id' ";
    mysqli_query($mysqli, $query);
    header("Location: https://ssosorno.cl/");
} */
