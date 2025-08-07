<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    
    $nombreImagen = $_FILES["imagen"]["name"];
    $rutaTemporal = $_FILES["imagen"]["tmp_name"];
    $destino = "imagenes/" . $nombreImagen;

    move_uploaded_file($rutaTemporal, $destino);

    $sql = "INSERT INTO productos (nombre, precio, imagen) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sds", $nombre, $precio, $destino);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="nombre" placeholder="Nombre del producto" required><br>
    <input type="number" name="precio" placeholder="Precio" step="0.01" required><br>
    <input type="file" name="imagen" accept="image/*"><br>
    <button type="submit">Guardar</button>
</form>
