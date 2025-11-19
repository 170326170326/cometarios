<?php
require 'db.php';

// Obtener artículos
$result = $mysqli->query("SELECT id, titulo, fecha FROM articulos ORDER BY fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel Admin</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
<h1>Panel de Administración</h1>
<a href="agregar.php" class="btn">Agregar Artículo</a>
<a href="inicio.php" class="btn">Ver Página</a>

<?php if ($result && $result->num_rows > 0): ?>
<table>
<tr><th>ID</th><th>Título</th><th>Fecha</th><th>Acciones</th></tr>
<?php while($a=$result->fetch_assoc()): ?>
<tr>
<td><?= $a['id'] ?? '' ?></td>
<td><?= htmlspecialchars($a['titulo'] ?? '') ?></td>
<td><?= $a['fecha'] ?? '' ?></td>
<td>
<a href="editar.php?id=<?= $a['id'] ?? 0 ?>">Editar</a> | 
<a href="eliminar.php?id=<?= $a['id'] ?? 0 ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
</td>
</tr>
<?php endwhile; ?>
</table>
<?php else: ?>
<p>No hay artículos registrados.</p>
<?php endif; ?>

</div>
</body>
</html>