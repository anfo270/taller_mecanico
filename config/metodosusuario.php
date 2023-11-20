<?php

require 'Conexionbd.php';

function Consulta_usuario($cifradoCorreo, $cifradoContraseña)
{
    $conexion = Conexionbd();
    if ($conexion) {
        $sql = "SELECT * FROM usuarios WHERE CorreoElectronico = ? AND Contaseña = ?";
        $consulta = $conexion->prepare($sql);
        if (!$consulta) {
            return die("Error en la consulta: " . $conexion->error);
        }
        $consulta->bind_param("ss", $cifradoCorreo, $cifradoContraseña);
        $consulta->execute();
        // Obtener resultados
        return $consulta->get_result();
    } else {
        return die("Error en la conexión a la base de datos.");
    }
}
function Consulta_usuario_email($cifradoCorreo)
{
    $conexion = Conexionbd();
    if ($conexion) {
        $sql = "SELECT * FROM usuarios WHERE CorreoElectronico = ?";
        $consulta = $conexion->prepare($sql);
        if (!$consulta) {
            return die("Error en la consulta: " . $conexion->error);
        }
        $consulta->bind_param("s", $cifradoCorreo);
        $consulta->execute();
        // Obtener resultados
        return $consulta->get_result();
    } else {
        return die("Error en la conexión a la base de datos.");
    }
}

function Consulta_usuario_id($id)
{
    $conexion = Conexionbd();
    if ($conexion) {
        $sql = "SELECT * FROM usuarios WHERE Id = ?";
        $consulta = $conexion->prepare($sql);
        if (!$consulta) {
            return die("Error en la consulta: " . $conexion->error);
        }
        $consulta->bind_param("s", $id);
        $consulta->execute();
        // Obtener resultados
        return $consulta->get_result();
    } else {
        return die("Error en la conexión a la base de datos.");
    }
}


function Crear_Usuario($nombre, $ApellidoMaterno, $ApellidoPaterno, $cifradoCorreo, $cifradoContraseña)
{
    $conexion = Conexionbd();
    if ($conexion) {
        $sql = 'INSERT INTO usuarios (nombre, ApellidoMaterno, ApellidoPaterno, CorreoElectronico, Contaseña) VALUES (?, ?, ?, ?, ?)';
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param("sssss", $nombre, $ApellidoMaterno, $ApellidoPaterno, $cifradoCorreo, $cifradoContraseña);
        if (!$consulta) {
            return die("No se creo el usauruio" . $conexion->error);
        }
        return $consulta->execute();
    } else {
        return die("Error en la conexión a la base de datos.");
    }
}

function cambiar_contraseña($id, $cifradacontraseña)
{
    $conexion = Conexionbd();
    if ($conexion) {
        $sql = "UPDATE usuarios set Contaseña=? WHERE Id=?";
        $consulta = $conexion->prepare($sql);
        if (!$consulta) {
            return die("Error en la consulta: " . $conexion->error);
        }
        $consulta->bind_param("ss", $cifradacontraseña, $id);
        $consulta->execute();
        // Obtener resultados
        return $consulta->get_result();
    } else {
        return die("Error en la conexión a la base de datos.");
    }
}
