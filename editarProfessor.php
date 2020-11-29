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
$titulacao = filter_input(INPUT_POST, 'titulacao', FILTER_SANITIZE_SPECIAL_CHARS);

if ($nome && $curso && $senha) {
    $sql = $pdo->prepare("update professores set nome = :nome, curso = :curso, titulacao = :titulacao, senha = :senha where id = {$id}");
    $sql->bindValue(":nome", $nome);
    $sql->bindValue(":curso", $curso);
    $sql->bindValue(":senha", $senha);
    $sql->bindValue(":titulacao", $titulacao);
    $sql->execute();

    header('Location: professor.php');
    exit;
}

$sql = 'select * from professores where id =' . $id;
$sql = $pdo->query($sql);

if ($sql->rowCount() > 0) {
    $dados = $sql->fetch();
}
?>

<?php require __DIR__ . "/pages/header.php"; ?>

<header>
    <h1 class="aluno-title">EDITAR PROFESSOR</h1>
</header><br>


<div class="tabelas" style="margin-bottom: 40px;">
    <h2 class="aluno-subtitle">Dados do Professor</h2><br>

    <form method="post">
        Nome: <br>
        <input type="text" name="nome" value="<?= $dados['nome']; ?>"> <br><br>
        Curso: <br>
        <input type="text" name="curso" value="<?= $dados['curso']; ?>"> <br><br>
        Titulação: <br>
        <select name="titulacao">
            <option value="Especialista">Especialista</option>
            <option value="Mestrado">Mestrado</option>
            <option value="Doutorado">Doutorado</option>
        </select> <br><br>
        Senha: <br>
        <input type="password" name="senha" value="<?= $dados['senha']; ?>"> <br><br>
        <input class="btn btn-primary" type="submit" value="Atualizar professor">
        <a href="index.php" class="btn btn-warning" style="margin-left: 10px;">Voltar</a>

    </form>
</div>

<?php require __DIR__ . '/pages/footer.php'; ?>