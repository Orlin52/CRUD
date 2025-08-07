<?php
include 'conexion.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $resultado = $conexion->query("SELECT * FROM productos WHERE id = $id");
    $fila = $resultado->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];

    if (!empty($_FILES["imagen"]["name"])) {
        $nombreImagen = $_FILES["imagen"]["name"];
        $rutaTemporal = $_FILES["imagen"]["tmp_name"];
        $destino = "imagenes/" . $nombreImagen;
        move_uploaded_file($rutaTemporal, $destino);
        $sql = "UPDATE productos SET nombre=?, precio=?, imagen=? WHERE id=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sdsi", $nombre, $precio, $destino, $id);
    } else {
        $sql = "UPDATE productos SET nombre=?, precio=? WHERE id=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sdi", $nombre, $precio, $id);
    }

    $stmt->execute();
    header("Location: index.php");
    exit();
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $fila["id"] ?>">
    <input type="text" name="nombre" value="<?= $fila["nombre"] ?>" required><br>
    <input type="number" name="precio" value="<?= $fila["precio"] ?>" step="0.01" required><br>
    <input type="file" name="imagen"><br>
    <button type="submit">Actualizar</button>
</form>
