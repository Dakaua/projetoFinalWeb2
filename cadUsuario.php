<?php

include_once './config/config.php';
include_once './classes/usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario($db);

    // Validação e depuração
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

    if (empty($nome) || empty($sexo) || empty($email) || empty($senha)) {
        die("Por favor, preencha todos os campos.");
    }


    // Criar o usuário
    $usuario->criar($nome, $sexo, $email, $senha);
    header('Location: listaUsuarios.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Usuário</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <img src="./imgs/logoNoticiarioDan.webp" alt="" id="logo">
        <h1>Fofoqueiros de Plantão</h1>

        <h1>Adicionar Usuário</h1>

        <button><a href="./listaUsuarios.php">Voltar</a></button>
    </header>

    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>
        <br><br>
        <label>Sexo:</label>
        <label for="masculino">
            <input type="radio" id="masculino" name="sexo" value="M" required> Masculino
        </label>
        <label for="feminino">
            <input type="radio" id="feminino" name="sexo" value="F" required> Feminino
        </label>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required>
        <br><br>
        <input type="submit" value="Adicionar">
    </form>
</body>

</html>