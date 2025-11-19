<?php
require_once 'db.php';
session_start();

$autor = trim($_POST['autor'] ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');
$article_id = isset($_POST['article_id']) ? (int)$_POST['article_id'] : 0;

if ($autor === '' || $mensaje === '' || $article_id <= 0) {
    header("Location: index.php?article=$article_id&error=empty");
    exit;
}

$stmt = $mysqli->prepare("INSERT INTO comentarios (article_id, autor, mensaje) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $article_id, $autor, $mensaje);

if ($stmt->execute()) {
    header("Location: index.php?article=$article_id&success=1");
} else {
    header("Location: index.php?article=$article_id&error=db");
}

$stmt->close();
exit;
?>