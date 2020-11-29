<?php
require __DIR__ . '/config.php';

if (empty($_SESSION['login'])) {
    session_destroy();
    header('Location: login.php');
}

$id = $_GET['id'];

if ($id) {
    $sql = $pdo->prepare("delete from professores where id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();

    header('Location: professor.php');
    exit;
}
?>