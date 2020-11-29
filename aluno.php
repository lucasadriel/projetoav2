<?php
require __DIR__ . "/config.php";

if (empty($_SESSION['login'])) {
    session_destroy();
    header('Location: login.php');
}

if (isset($_SESSION['login'])) {
    $id = $_SESSION['login'];

    $sql = $pdo->prepare("select * from alunos");
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $dados = $sql->fetchAll();
    } 
}

    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $curso = filter_input(INPUT_POST, 'curso', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($nome && $curso) {
        $sql = $pdo->prepare("select * from alunos where nome = :nome");
        $sql->bindValue(":nome", $nome);
        $sql->execute();

        if ($sql->rowCount() === 0) {
            $matricula = date('Y') . rand(1, 9999);
            $senha = md5(rand(1, 9999));

            $sql = $pdo->prepare("insert into alunos set nome = :nome, curso = :curso, matricula = :matricula, senha = :senha");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":curso", $curso);
            $sql->bindValue(":senha", $senha);
            $sql->bindValue(":matricula", $matricula);
            $sql->execute(); 

            echo "<script>window.location.href = window.location.href</script>";
        } else {
            echo "Usuário ja cadastrado";
        }        
    } 

?>

<?php require __DIR__ . "/pages/header.php"; ?>

    <header><h1 class="aluno-title">CADASTRO DE ALUNO</h1></header><br>

    <div class="tabelas">
        <h2 class="aluno-subtitle">Dados do Aluno</h2><br>

            <form method="post">
                <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" width="150" maxlength="150" placeholder="nome"> <br><br>

                <label>Curso:</label>
                    <input type="text" name="curso" width="150" maxlength="150" placeholder="curso"> <br><br>

                <input class="btn btn-primary" type="submit" value="Cadastrar aluno">
                <a href="index.php" class="btn btn-warning" style="margin-left: 10px;">Voltar</a>
            </form>
            <hr><br>

        <table class="table table-sm table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Matrícula</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cursos</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados as $dado): ?>            

                <tr>
                    <td style="font-weight: bold;"><?= empty($dado['matricula']) ? 'Sem matrícula' : $dado['matricula']; ?></td>
                    <td><?= empty($dado['nome']) ? 'Sem usuário' : $dado['nome']; ?></td>
                    <td><?= empty($dado['curso']) ? 'Sem curso' : $dado['curso'];; ?></td>
                    <td>
                        <a href="editar.php?id=<?= $dado['id']; ?>">
                            <button type="button" class="btn btn-sm btn-outline-primary">Editar</button>
                        </a> 
                        <a href="excluir.php?id=<?= $dado['id']; ?>">
                            <button type="button" class="btn btn-sm btn-outline-danger">Excluir</button>
                        </a> 
                        <a href="tcc.php?id=<?= $dado['id']; ?>">
                            <button type="button" class="btn btn-sm btn-success">Adicionar TCC</button>
                        </a>
                        <a href="visuOrientacao.php?id=<?= $dado['id']; ?>">
                            <button type="button" class="btn btn-sm btn-info">Visualizar orientações</button>
                        </a>
                    </td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table>

    </div><br>

<?php require __DIR__ . '/pages/footer.php'; ?>