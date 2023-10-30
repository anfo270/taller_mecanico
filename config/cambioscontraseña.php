<?php
require 'metodosusuario.php';
session_start();

//Obtencion de datos
$contraseña = $_POST['Contraseña'];
$id = $_POST['id'];
$cifradacontraseña = md5($contraseña);
$resultado = cambiar_contraseña($id, $cifradacontraseña);

if ($resultado) {
    echo '<script>alert("Revisa la contraseña o el proceso y vuelve a intentar")</script>';
    echo "<script>location.href='../recuperacion.html'</script>";
} else {

    echo '<script>alert("Contraseña actualizada ya puedes ingresar a tu cuenta")</script>';
    echo "<script>location.href='../login.html'</script>";
}
