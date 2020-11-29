<?php
require __DIR__ . '/config.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "select orientacao from alunos where id = {$id}";
$sql = $pdo->query($sql);

if ($sql->rowCount() > 0) {
    $dados = $sql->fetchAll();
}
?>

<?php require __DIR__ . "/pages/header.php"; ?>

<?php foreach ($dados as $dado) : ?>
    <div class="orientacao" style="max-width: 900px; margin: auto; ">
        <p style="text-align: justify; margin: 50px 0;"><?= $dado['orientacao']; ?></p>
    </div>

<?php endforeach; ?>

<?php require __DIR__ . '/pages/footer.php'; ?>