<?php

function Conexionbd()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tallermecanico";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        return die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
