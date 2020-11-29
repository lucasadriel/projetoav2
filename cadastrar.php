<?php
require __DIR__ ."/config.php";

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$curso = filter_input(INPUT_POST, 'curso', FILTER_SANITIZE_SPECIAL_CHARS);
$tipoUsuario = filter_input(INPUT_POST, 'tipo_usuario', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
$titulacao = filter_input(INPUT_POST, 'titulacao', FILTER_SANITIZE_SPECIAL_CHARS);

if ($nome && $senha) {
    if ($tipoUsuario == 'aluno') {
        $sql = $pdo->prepare('select * from alunos where nome = :nome');
        $sql->bindValue(':nome', $nome);
        $sql->execute();

        if ($sql->rowCount() === 0) {
            $hash = md5($senha);
            $matricula = date('Y') . rand(1, 9999);

            $sql = $pdo->prepare("insert into alunos set nome = :nome, curso = :curso, senha = :senha, matricula = :matricula");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":curso", $curso);
            $sql->bindValue(":senha", $hash);
            $sql->bindValue(":matricula", $matricula);
            $sql->execute();
                
            header('Location: index.php');
            exit; 
        } else {
            echo 'Usuário já cadastrado';
        }
    } else {
        $sql = $pdo->prepare('select * from professores where nome = :nome');
        $sql->bindValue(':nome', $nome);
        $sql->execute();

        if ($sql->rowCount() === 0) {
            $hash = md5($senha);
            $matricula = date('Y') . rand(1, 9999);

            $sql = $pdo->prepare("insert into professores set nome = :nome, curso = :curso, titulacao = :titulacao, senha = :senha, matricula = :matricula");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":curso", $curso);
            $sql->bindValue(':titulacao', $titulacao);
            $sql->bindValue(":senha", $hash);
            $sql->bindValue(":matricula", $matricula);
            $sql->execute();
                
            header('Location: index.php');
            exit; 
        } else {
            echo 'Usuários já cadastrado';
        }
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
    

<h1 class="login-title">Fazer Cadastro</h1>
<div class="form">
    <form method="post">
        Nome: <br>
        <input type="text" name="nome"> <br><br>
        Curso: <br>
        <input type="text" name="curso"> <br><br>
        Titulação: <br>
        <select name="titulacao">
            <option value="">Selecione uma opção</option>
            <option value="Especialista">Especialista</option>
            <option value="Mestrado">Mestrado</option>
            <option value="Doutorado">Doutorado</option>
        </select> <br>
        <small>Obrigatório so para professores.</small> <br><br>
        Tipo de usuário: <br>
        <select name="tipo_usuario" required>
            <option value="">Selecione uma opção</option>
            <option value="professor">Professor(a)</option>
            <option value="aluno">Aluno(a)</option>
        </select> <br><br>
        Senha: <br>
        <input type="password" name="senha"> <br><br>
        <input class="button-login" type="submit" value="Cadastrar"> <br><br>
        <a href="login.php">Logar</a>
    </form>
    </div>


</body>
</html>