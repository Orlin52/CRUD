<?php
include 'conexion.php';
$resultado = $conexion->query("SELECT * FROM productos");
?>

<a href="crear.php">Nuevo Producto</a><br><br>
<table border="1">
    <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Imagen</th><th>Acciones</th></tr>
    <?php while ($fila = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?= $fila["id"] ?></td>
        <td><?= $fila["nombre"] ?></td>
        <td>L. <?= $fila["precio"] ?></td>
        <td>
            <?php if ($fila["imagen"]): ?>
                <img src="<?= $fila["imagen"] ?>" width="100">
            <?php endif; ?>
        </td>
        <td>
            <a href="editar.php?id=<?= $fila["id"] ?>">Editar</a> |
            <a href="eliminar.php?id=<?= $fila["id"] ?>" onclick="return confirm('¿Eliminar este producto?')">Eliminar</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
