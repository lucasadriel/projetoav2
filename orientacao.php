<?php
require __DIR__  . '/config.php';

$dadosTCC = [];

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "select titulo from tcc where id = {$id}";
$sql = $pdo->query($sql);

if ($sql->rowCount() > 0) {
    $dadosTCC['tcc'] = $sql->fetch();
}

$idProfessor = $_SESSION['login']['id'];
$sqlProfessor = "select * from professores where id = {$idProfessor}";
$sqlProfessor = $pdo->query($sqlProfessor);

if ($sqlProfessor->rowCount() > 0) {
    $dadosTCC['professor'] = $sqlProfessor->fetch();
}

$sqlAluno = "select alunos.*, tcc.* from alunos inner join tcc on alunos.id = tcc.aluno_id where tcc.id = {$id}";
$sqlAluno = $pdo->query($sqlAluno);

if ($sqlAluno->rowCount() > 0) {
    $dadosTCC['aluno'] = $sqlAluno->fetch();
}


$orientacao = filter_input(INPUT_POST, 'orientacao', FILTER_SANITIZE_SPECIAL_CHARS);
if ($orientacao) {
    $sqlOrientacao = $pdo->prepare("update alunos set orientacao = :orientacao where id = {$id}");
    $sqlOrientacao->bindValue(':orientacao', $orientacao);
    $sqlOrientacao->execute();

    header('Location: aluno.php');
    exit;
}

//echo "<pre>";
//var_dump($dadosTCC);
//echo "</pre>";

?>


<?php require __DIR__ . "/pages/header.php"; ?>

    <h1 class="aluno-title">Acompanhamento das orientações de TCC</h1><br>

    <div class="cadastro-tcc" style="margin-bottom: 40px;">
        <h2 class="aluno-subtitle">Dados das orientações</h2><br>

        <form method="post">
            <label>Matrícula:</label>
                <input type="text" value="<?= $dadosTCC['aluno']['matricula']; ?>" name="matricula" width="60" maxlength="80" placeholder="Matrícula"><br><br>

            <label>Aluno:</label>
                <input type="text" value="<?= $dadosTCC['aluno']['nome']; ?>" name="aluno" width="80" maxlength="100" placeholder="Aluno"><br><br>

            <label>Título do trabalho:</label>
            <input type="text" value="<?= $dadosTCC['tcc']['titulo']; ?>" name="trabalho" width="80" maxlength="100" placeholder="Título do trabalho"><br><br>

            <label>Nome do professor:</label>
            <input type="text" value="<?= $dadosTCC['professor']['nome']; ?>" name="professor" width="80" maxlength="100" placeholder="Nome do professor"><br><br>

            <p class="cadastro-title-tcc">Informe as orientações para esse trabalho:</p>
            <textarea name="orientacao" id="" cols="60" rows="5"></textarea><br><br>

            <input class="btn btn-primary" type="submit" value="Cadastrar"> 
            <a href="index.php" class="btn btn-warning" style="margin-left: 10px;">Voltar</a>

        </form>
    </div>

<?php require __DIR__ . '/pages/footer.php'; ?>