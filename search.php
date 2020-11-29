<?php
require __DIR__ . '/config.php';
require __DIR__ . "/pages/header.php";


$busca = filter_input(INPUT_GET, 'seach', FILTER_SANITIZE_SPECIAL_CHARS);

if (empty($busca)) {
    echo "<script>alert('Sua pesquisa está vazia!')</script>";
    echo "<script>window.location.href = 'index.php'</script>";
}

if ($busca) {
    $sqlA = "select matricula, nome, curso from alunos where nome like '%{$busca}%'";
    $sqlP = "select matricula, nome, curso from professores where nome like '%{$busca}%'";
    $sqlA = $pdo->query($sqlA);
    $sqlP = $pdo->query($sqlP);

    if ($sqlA) {
        if ($sqlA->rowCount() > 0) {
            $info = $sqlA->fetchAll();

?>
            <header>
                <h1 class="aluno-title">RESULTADOS DA SUA BUSCA</h1>
            </header><br>

            <div class="tabelas">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Matrícula</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Cursos</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>

                    <?php foreach ($info as $dado) : ?>
                        <tr>
                            <td><?= $dado['matricula']; ?></td>
                            <td><?= $dado['nome']; ?></td>
                            <td><?= $dado['curso']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

        <?php

            exit;
        }
    }

    if ($sqlP) {
        if ($sqlP->rowCount() > 0) {
            $info = $sqlP->fetchAll();

        ?>

            <header>
                <h1 class="aluno-title">RESULTADOS DA SUA BUSCA</h1>
            </header><br>

            <div class="tabelas">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Matrícula</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Cursos</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>

                    <?php foreach ($info as $dado) : ?>
                        <tr>
                            <td><?= $dado['matricula']; ?></td>
                            <td><?= $dado['nome']; ?></td>
                            <td><?= $dado['curso']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

<?php

            exit;
        }
    }

    echo 'Sua busca não trouxe resultados';
}

?>

<?php require __DIR__ . '/pages/footer.php'; ?>