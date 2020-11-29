<?php
//ini_set('display_errors', 0);
require __DIR__  . '/config.php';

$dadosTCC = [];

$id = $_GET['id'];

$sql = "select * from tcc where id = {$id}";
$sql = $pdo->query($sql);

if ($sql->rowCount() > 0) {
    $dadosTCC['tcc'] = $sql->fetch();
}

$sqlAluno = "select alunos.nome, tcc.* from alunos inner join tcc on alunos.id = tcc.aluno_id where tcc.id = {$id}";
$sqlAluno = $pdo->query($sqlAluno);


if ($sqlAluno->rowCount() > 0) {
    $dadosTCC['aluno'] = $sqlAluno->fetch();
}


// echo "<pre>";
// var_dump($dadosTCC);
// echo "</pre>";

?>
<?php require __DIR__ . "/pages/header.php"; ?>


    <div class="tcc-completo">
        <p class="aluno-title"><?= $dadosTCC['tcc']['titulo']; ?></p>
        <p class="tcc-completo-title-aluno"><?= $dadosTCC['aluno']['nome']; ?></p>
        <p><?= $dadosTCC['tcc']['resumo']; ?></p>
        <p><?= $dadosTCC['tcc']['introducao']; ?></p>
        <p><?= $dadosTCC['tcc']['referencial']; ?></p>
        <p><?= $dadosTCC['tcc']['metodologia']; ?></p>
        <p><?= $dadosTCC['tcc']['conclusao']; ?></p>

        <a href="orientacao.php?id=<?= $id; ?>"><button type="button" class="btn btn-success margin">Incluir orientações</button></a>
        <a href="index.php" class="btn btn-warning" style="margin-left: 10px;">Voltar</a>

    </div>


<?php require __DIR__ . '/pages/footer.php'; ?>
