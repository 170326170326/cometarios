<?php
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blog de Artículos</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">

<h1>Blog de Artículos</h1>

<?php
$result = $mysqli->query("SELECT id, titulo, fecha FROM articulos ORDER BY fecha DESC");
if ($result->num_rows == 0) echo "<p>No hay artículos aún.</p>";

while ($row = $result->fetch_assoc()):
?>
<div class="card">
    <h2><a href="index.php?article=<?= $row['id'] ?>"><?= htmlspecialchars($row['titulo']) ?></a></h2>
    <small>Publicado: <?= $row['fecha'] ?></small>
</div>
<?php endwhile; ?>

<a href="login.php" class="btn">Panel de Administración</a>

</div>
</body>
</html>
