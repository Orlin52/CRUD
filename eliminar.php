<?php
include 'conexion.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // eliminar la imagen del servidor
    $res = $conexion->query("SELECT imagen FROM productos WHERE id = $id");
    $fila = $res->fetch_assoc();
    if ($fila["imagen"] && file_exists($fila["imagen"])) {
        unlink($fila["imagen"]);
    }

    $conexion->query("DELETE FROM productos WHERE id = $id");
}

header("Location: index.php");
exit();
?>
