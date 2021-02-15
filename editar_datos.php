<?php
include('db.php'); //mysqli

$mensaje = "";

$id = $_POST['id'];
$correo = $_POST['correo'];
$contacto = $_POST['contacto'];

$sql = "SELECT * FROM usuarios WHERE correo = '" . $correo . " '";

$select = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($select);

if ($row['correo'] === $correo && $row['id'] === $id) {
    $query = "UPDATE usuarios SET correo = '$correo', contacto = '$contacto', estado = 1 WHERE id = '$id' ";
    mysqli_query($mysqli, $query);
    header("Location: https://ssosorno.cl/");
} elseif ($row['correo'] === $correo && $row['id'] != $id) {
    header("Location: http://localhost:8888/Formulario-Contacto-SSO/index.php");
}else{
    $query = "UPDATE usuarios SET correo = '$correo', contacto = '$contacto', estado = 1 WHERE id = '$id' ";
    mysqli_query($mysqli, $query);
    header("Location: https://ssosorno.cl/");
}
