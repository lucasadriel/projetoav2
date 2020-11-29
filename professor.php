<?php
require __DIR__ . "/config.php";

if (empty($_SESSION['login'])) {
    session_destroy();
    header('Location: login.php');
}

if (isset($_SESSION['login'])) {
    $id = $_SESSION['login'];

    $sql = $pdo->prepare("select * from professores");
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $dados = $sql->fetchAll();
    } 
}

    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $curso = filter_input(INPUT_POST, 'curso', FILTER_SANITIZE_SPECIAL_CHARS);
    $titulacao = filter_input(INPUT_POST, 'titulacao', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($nome && $curso) {
        $sql = $pdo->prepare("select * from professores where nome = :nome");
        $sql->bindValue(":nome", $nome);
        $sql->execute();

        if ($sql->rowCount() === 0) {
            $matricula = date('Y') . rand(1, 9999);
            $senha = md5(rand(1, 9999));

            $sql = $pdo->prepare("insert into professores set nome = :nome, curso = :curso, matricula = :matricula, titulacao = :titulacao, senha = :senha");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":curso", $curso);
            $sql->bindValue(":senha", $senha);
            $sql->bindValue(":titulacao", $titulacao);
            $sql->bindValue(":matricula", $matricula);
            $sql->execute(); 

            echo "<script>window.location.href = window.location.href</script>";
        } else {
            echo "Usuário ja cadastrado";
        }        
    } 

?>


<?php require __DIR__ . "/pages/header.php"; ?>

    <header><h1 class="aluno-title">CADASTRO DE PROFESSORES</h1></header><br>

    <div class="tabelas">
        <h2 class="aluno-subtitle">Dados do professor</h2><br>

            <form method="post">
                <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" width="150" maxlength="150" placeholder="nome"> <br><br>

                <label>Curso:</label>
                    <input type="text" name="curso" width="150" maxlength="150" placeholder="curso"> <br><br>

                <label>Titulação:</label>
                    <select name="titulacao">
                        <option value="Especialista">Especialista</option>
                        <option value="Mestrado">Mestrado</option>
                        <option value="Doutorado">Doutorado</option>
                    </select> <br><br>

                <input class="btn btn-primary" type="submit" value="Cadastrar professor">
                <a href="index.php" class="btn btn-warning" style="margin-left: 10px;">Voltar</a>
            </form>
            <hr><br>

            <table class="table table-sm table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Matrícula</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cursos</th>
                    <th scope="col">Titulação</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados as $dado): ?>            

                    <tr>
                        <td><?= empty($dado['matricula']) ? 'Sem matrícula' : $dado['matricula']; ?></td>
                        <td><?= empty($dado['nome']) ? 'Sem usuário' : $dado['nome']; ?></td>
                        <td><?= empty($dado['curso']) ? 'Sem curso' : $dado['curso'];; ?></td>
                        <td><?= empty($dado['titulacao']) ? 'Sem títulos' : $dado['titulacao'];; ?></td>
                        <td>
                            <a href="editarProfessor.php?id=<?= $dado['id']; ?>">
                                <button type="button" class="btn btn-sm btn-outline-primary">Editar</button>
                            </a> 
                            <a href="excluirProfessor.php?id=<?= $dado['id']; ?>">
                                <button type="button" class="btn btn-sm btn-outline-danger">Excluir</button>
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>

    </div><br>

<?php require __DIR__ . '/pages/footer.php'; ?>