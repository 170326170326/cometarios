<?php
require_once 'db.php';
$error = "";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) die("ID inválido.");

$stmt = $mysqli->prepare("SELECT titulo, contenido FROM articulos WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$art = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$art) die("Artículo no encontrado.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $contenido = trim($_POST['contenido']);

    if ($titulo === "") {
        $error = "⚠️ El título no puede estar vacío.";
    } else {
        $stmt = $mysqli->prepare("UPDATE articulos SET titulo=?, contenido=? WHERE id=?");
        $stmt->bind_param("ssi", $titulo, $contenido, $id);
        $stmt->execute();
        header("Location: login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Artículo</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
<h1>Editar Artículo</h1>

<?php if (!empty($error)): ?>
<p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
<input type="text" name="titulo" value="<?= htmlspecialchars($art['titulo']) ?>" required maxlength="255">
<textarea name="contenido" rows="6"><?= htmlspecialchars($art['contenido']) ?></textarea>
<button type="submit">Guardar Cambios</button>
</form>

<a href="login.php" class="btn">Volver</a>
</div>

</body>
</html>
