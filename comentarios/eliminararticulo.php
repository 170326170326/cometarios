<?php
require_once 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $mysqli->prepare("DELETE FROM articulos WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: login.php");
exit;
?>

