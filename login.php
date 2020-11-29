<?php
require __DIR__ . "/config.php";
    
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

if ($nome && $senha) {
    $sqlAlunos = $pdo->prepare('select * from alunos where nome = :nome and senha = :senha');
    $sqlAlunos->bindValue(":nome", $nome);
    $sqlAlunos->bindValue(":senha", md5($senha));
    $sqlAlunos->execute();

    if ($sqlAlunos->rowCount() > 0) {
        $info = $sqlAlunos->fetch();
        $_SESSION["login"] = [
            'id' => $info['id'],
            'nome' => $info['nome'],
            'senha' => $info['senha']
        ];

        header ("Location: index.php");
        exit; 
    } 

    $sqlProfessores = $pdo->prepare('select * from professores where nome = :nome and senha = :senha');
    $sqlProfessores->bindValue(":nome", $nome);
    $sqlProfessores->bindValue(":senha", md5($senha));
    $sqlProfessores->execute();
    
    if ($sqlProfessores->rowCount() > 0) {
        $info = $sqlProfessores->fetch();
        $_SESSION["login"] = [
            'id' => $info['id'],
            'nome' => $info['nome'],
            'senha' => $info['senha']
        ];

        header ("Location: index.php");
        exit; 
    } else {
        echo '<div class="aviso">Nome e/ou senha incorretos</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

    <h1 class="login-title">Fazer Login</h1>
    <div class="form">
        <form method="post">
        Nome: <br>
        <input type="text" name="nome"> <br><br>
        Senha: <br>
        <input type="password" name="senha"> <br><br>
        <input class="button-login" type="submit" value="Login"> <br><br>
        <a href="cadastrar.php">Ainda não tem cadastro?</a>
    </div>
</form>
</body>
</html>

