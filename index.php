<?php
require __DIR__ . "/config.php";

if (empty($_SESSION['login'])) {
    session_destroy();
    header('Location: login.php');
}

$sql = 'select * from tcc';
$sql = $pdo->query($sql);

if ($sql->rowCount() > 0) {
    $dadosTcc = $sql->fetchAll();
} 

$nomeLogado = $_SESSION['login']['nome'];

?>

<?php require __DIR__ . "/pages/header.php"; ?>

<header><h1 class="aluno-title">Seja bem vindo(a) <?= $nomeLogado; ?></h1></header><br>

    
<div class="main-tcc">
    <?php foreach ($dadosTcc as $tcc) : ?>
        <div class="main-tcc-trabalho">
            <a href="">
                <img src="assets/images/tcc.jpg" width="100%" alt="">
            </a>
            <p class="main-tcc-title"><?= $tcc['titulo']; ?></p>
            <p style="padding: 0 5px;" class="main-tcc-resumo"><?= substr($tcc['resumo'], 0, 100) . '...'; ?></p>

            <a href="tccCompleto.php?id=<?= $tcc['id']; ?>"><button class="main-tcc-button btn btn-warning">Ver TCC completo</button></a>
        </div>
    <?php endforeach; ?>
</div>
    
<br>

<?php require __DIR__ . '/pages/footer.php'; ?>