<?php
session_start();
require 'metodosusuario.php';

// Recolección de datos
$nombre = $_POST['Nombre'];
$ApellidoMaterno = $_POST['ApellidoMaterno'];
$ApellidoPaterno = $_POST['ApellidoPaterno'];
$Contraseña = $_POST['Contraseña'];
$CorreoElectronico = $_POST['CorreoElectronico'];

// Cifrado de datos para credenciales (Nota: MD5 no es una forma segura de almacenar contraseñas)
$cifradoContraseña = md5($Contraseña);
$cifradoCorreo = md5($CorreoElectronico);

//verificar si existe un correo electronico
$resultado = Consulta_usuario($cifradoCorreo, $cifradoContraseña);
if ($resultado->num_rows > 0) {
    echo ('<script>alert("El correo electronico ya existe")</script>');
    echo "<script>location.href='../registro.html'</script>";
} else {
    // Inserción del nuevo usuario
    $resultado = Crear_Usuario($nombre, $ApellidoMaterno, $ApellidoPaterno, $cifradoCorreo, $cifradoContraseña);

    if ($resultado) {
        $_SESSION['CorreoElectronico'] = $cifradoCorreo;
        $_SESSION['Contraseña'] = $cifradoContraseña;
        $_SESSION['NombreUsuario'] = $nombre;
        echo "<script>alert('Usuario creado exitosamente')</script>";
        echo "<script>alert('Bienvenido a AutoMasters')</script>";
        echo "<script>location.href='../index.html'</script>";
    } else {
        echo "Error al crear el usuario";
    }
}
