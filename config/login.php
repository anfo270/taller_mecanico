<?php
require 'metodosusuario.php';
session_start();

//Obtencion de datos
$correo = $_POST['CorreoElectronico'];
$contraseña = $_POST['Contraseña'];

//cifrado
$cifradoCorreo = md5($correo);
$cifradoContraseña = md5($contraseña);

//Consulta para verificar si el usuario existe en la base de datos
$resultado = Consulta_usuario($cifradoCorreo, $cifradoContraseña);

if ($resultado->num_rows > 0) {
    $_SESSION['CorreoElectronico'] = $correo;
    $_SESSION['Contraseña'] = $contraseña;
    $_SESSION['NombreUsuario'] = $resultado->fetch_assoc()["Nombre"];
    echo "<script>location.href='../index.html'</script>";
} else {
    echo '<script>alert("Correo Electronico o Contraseña incorrecta")</script>';
    echo "<script>location.href='../login.html'</script>";
}
