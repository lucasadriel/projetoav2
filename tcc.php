<?php
require __DIR__ . '/config.php';

if (empty($_SESSION['login'])) {
    session_destroy();
    header('Location: login.php');
}

$id = $_GET['id'];

$sql = 'select * from alunos where id =' . $id;
$sql = $pdo->query($sql);

if ($sql->rowCount() > 0) {
    $dados = $sql->fetch();  
}

$sql = "select * from professores where id = {$_SESSION['login']}";
$sql = $pdo->query($sql);

if ($sql->rowCount() > 0) {
    $dadosProfessor = $sql->fetch();
}

$matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_SPECIAL_CHARS);
$aluno = filter_input(INPUT_POST, 'aluno', FILTER_SANITIZE_SPECIAL_CHARS);
$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
$resumo = filter_input(INPUT_POST, 'resumo', FILTER_SANITIZE_SPECIAL_CHARS);
$intro = filter_input(INPUT_POST, 'intro', FILTER_SANITIZE_SPECIAL_CHARS);
$ref = filter_input(INPUT_POST, 'ref', FILTER_SANITIZE_SPECIAL_CHARS);
$meto = filter_input(INPUT_POST, 'meto', FILTER_SANITIZE_SPECIAL_CHARS);
$conc = filter_input(INPUT_POST, 'conc', FILTER_SANITIZE_SPECIAL_CHARS);

if ($matricula && $intro && $titulo && $resumo) {
    $sql = $pdo->prepare("
        insert into tcc set aluno_id = :aluno_id, professor_id = :professor_id, matricula = :matricula, titulo = :titulo, resumo = :resumo, 
        introducao = :introducao, referencial = :referencial, metodologia = :metodologia, conclusao = :conclusao
    ");
    $sql->bindValue(':matricula', $matricula);
    $sql->bindValue(':aluno_id', $id);
    $sql->bindValue(':professor_id', $dadosProfessor['id']);
    $sql->bindValue(':titulo', $titulo);
    $sql->bindValue(':resumo', $resumo);
    $sql->bindValue(':introducao', $intro);
    $sql->bindValue(':referencial', $ref);
    $sql->bindValue(':metodologia', $meto);
    $sql->bindValue(':conclusao', $conc);
    $sql->execute();

    header('Location: aluno.php');
    exit;
}


?>

<?php require __DIR__ . "/pages/header.php"; ?>

    <h1 class="aluno-title">Cadastro do tema do trabalho de conclusão</h1><br>

    <div class="cadastro-tcc" style="margin-bottom: 40px;">
        <h2 class="aluno-subtitle">Dados do TCC</h2><br>

        <form method="post">
            <label>Matrícula:</label>
                <input type="text" value="<?= $dados['matricula']; ?>" name="matricula" width="60" maxlength="80" placeholder="Matrícula"><br><br>

            <label>Aluno:</label>
                <input type="text" value="<?= $dados['nome']; ?>" name="aluno" width="80" maxlength="100" placeholder="Aluno"><br><br>

            <label>Título do trabalho:</label>
            <input type="text" name="titulo" width="80" maxlength="100" placeholder="Título do trabalho"><br><br>

            <p class="cadastro-title-tcc">Informe o resumo do seu trabalho:</p>
            <textarea name="resumo" id="" cols="60" rows="5"></textarea><br><br>

            <p class="cadastro-title-tcc">Informe a introdução do seu trabalho:</p>
            <textarea name="intro" id="" cols="60" rows="5"></textarea><br><br>

            <p class="cadastro-title-tcc">Informe o referencial do seu trabalho:</p>
            <textarea name="ref" id="" cols="60" rows="5"></textarea><br><br>

            <p class="cadastro-title-tcc">Informe a metodologia do seu trabalho:</p>
            <textarea name="meto" id="" cols="60" rows="5"></textarea><br><br>

            <p class="cadastro-title-tcc">Informe a conclusão do seu trabalho:</p>
            <textarea name="conc" id="" cols="60" rows="5"></textarea><br><br>

            <input class="btn btn-primary" type="submit" value="Cadastrar"> 
            <a href="index.php" class="btn btn-warning" style="margin-left: 10px;">Voltar</a>

        </form>
    </div>

<?php require __DIR__ . '/pages/footer.php'; ?>
