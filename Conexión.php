<?php
$conexion = new mysqli("localhost", "root", "", "productos_db");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
