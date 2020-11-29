<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/header.css?123">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/style.css?">
</head>
<body>
    <header class="main-header">
        <div class="main-header-left">
            <a href="index.php"><img src="assets/images/logotipo.jpg" width='50px' height='50px'></a>
        </div>
        <div class="main-header-rigth">
            <div class="main-header-search">
                <form action="search.php" method="get">
                    <input id="campo" type="text" name="seach">
                    <input type="submit" value="Pesquisar">
                </form>
            </div>

            <a href="aluno.php"><button type="button" class="btn btn-warning">Aluno</button></a>
            <a href="professor.php"><button type="button" class="btn btn-warning">Professor</button></a>
            <!-- <a href=""><button type="button" class="btn btn-warning">Estrutura</button></a> -->

            <a href="logout.php"><button type="button" class="btn btn-danger">Sair</button></a>
        </div>
    </header>