<?php
require __DIR__ . '/config.php';

if (empty($_SESSION['login'])) {
    session_destroy();
    header('Location: login.php');
}

$id = $_GET['id'];

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$curso = filter_input(INPUT_POST, 'curso', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

if ($nome && $curso && $senha) {
    $sql = $pdo->prepare("update alunos set nome = :nome, curso = :curso, senha = :senha where id = :id");
    $sql->bindValue(":nome", $nome);
    $sql->bindValue(":curso", $curso);
    $sql->bindValue(":senha", md5($senha));
    $sql->bindValue(":id", $id);
    $sql->execute();

    header('Location: aluno.php');
    exit;
}

$sql = 'select * from alunos where id =' . $id;
$sql = $pdo->query($sql);

if ($sql->rowCount() > 0) {
    $dados = $sql->fetch();
}
?>

<?php require __DIR__ . "/pages/header.php"; ?>

<header>
    <h1 class="aluno-title">EDITAR ALUNO</h1>
</header><br>

<div class="tabelas" style="margin-bottom: 40px;">
    <h2 class="aluno-subtitle">Dados do Aluno</h2><br>

    <form method="post">
        Nome: <br>
        <input type="text" name="nome" value="<?= $dados['nome']; ?>"> <br><br>
        Curso: <br>
        <input type="text" name="curso" value="<?= $dados['curso']; ?>"> <br><br>
        Senha: <br>
        <input type="password" name="senha" value="<?= $dados['senha']; ?>"> <br><br>
        <input class="btn btn-primary" type="submit" value="Atualizar aluno">
        <a href="index.php" class="btn btn-warning" style="margin-left: 10px;">Voltar</a>

    </form>
</div>

<?php require __DIR__ . '/pages/footer.php'; ?>