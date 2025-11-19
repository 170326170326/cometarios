<?php
require_once 'db.php';

$article_id = isset($_GET['article']) ? (int)$_GET['article'] : 1;

$artStmt = $mysqli->prepare("SELECT id, titulo, contenido, fecha FROM articulos WHERE id=?");
$artStmt->bind_param("i", $article_id);
$artStmt->execute();
$art = $artStmt->get_result()->fetch_assoc();
$artStmt->close();

if (!$art) die("Artículo no encontrado.");

$comStmt = $mysqli->prepare("SELECT autor, mensaje, fecha FROM comentarios WHERE article_id=? ORDER BY fecha DESC");
$comStmt->bind_param("i", $article_id);
$comStmt->execute();
$comResult = $comStmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($art['titulo']) ?></title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">

<div class="card">
<h1><?= htmlspecialchars($art['titulo']) ?></h1>
<p><?= nl2br(htmlspecialchars($art['contenido'])) ?></p>
<small>Publicado: <?= $art['fecha'] ?></small>
</div>

<div class="card">
<h2>Deja tu comentario</h2>
<form action="insertar.php" method="post">
<input type="hidden" name="article_id" value="<?= $art['id'] ?>">
<input type="text" name="autor" placeholder="Tu nombre" required maxlength="100">
<textarea name="mensaje" placeholder="Tu comentario" required maxlength="1000" rows="6"></textarea>
<button type="submit">Enviar comentario</button>
</form>
</div>

<h2>Comentarios recientes</h2>
<?php while ($row = $comResult->fetch_assoc()): ?>
<div class="comment">
    <b><?= htmlspecialchars($row['autor']) ?></b>
    <small>(<?= $row['fecha'] ?>)</small>
    <p><?= nl2br(htmlspecialchars($row['mensaje'])) ?></p>
</div>
<?php endwhile; ?>

<a href="inicio.php" class="btn">Volver a Artículos</a>

</div>
</body>
</html>