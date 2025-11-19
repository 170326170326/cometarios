<?php
require_once 'db.php';
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $contenido = trim($_POST['contenido']);
    $fecha = date("Y-m-d H:i:s");

    if ($titulo === "") {
        $error = "⚠️ El título no puede estar vacío.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO articulos (titulo, contenido, fecha) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $titulo, $contenido, $fecha);
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
<title>Agregar Artículo</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
<h1>Agregar Nuevo Artículo</h1>

<?php if (!empty($error)): ?>
<p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
<input type="text" name="titulo" placeholder="Título del artículo" required maxlength="255">
<textarea name="contenido" placeholder="Contenido del artículo (opcional)" rows="6"></textarea>
<button type="submit">Agregar Artículo</button>
</form>

<a href="login.php" class="btn">Volver</a>
</div>

</body>
</html>
