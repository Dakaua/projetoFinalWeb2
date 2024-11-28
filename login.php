<?php

session_start();
include_once './config/config.php';
include_once './classes/usuario.php';


$usuario = new Usuario($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        // Processar login
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if ($dados_usuario = $usuario->login($email, $senha)) {
            $_SESSION['usuario_id'] = $dados_usuario['idautor'];
            $_SESSION['usuario_nome'] = $dados_usuario['nome'];
            header('Location: gerenciador.php');
            exit();
        } else {
            $mensagem_erro = "Credenciais inválidas!";
        }
    }
}
?>
<!DOCTYPE html>
<html>


<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A U T E N T I C A Ç Ã O</title>
    <link rel="stylesheet" href="styles.css">
</head>


<body>


    <div class="container">


        <div class="box">
            <h1>A U T E N T I C A Ç Ã O</h1>


            <form method="POST">
                <label for="email">Email:</label><br>
                <input type="email" name="email" required>
                <br><br>
                <label for="senha">Senha:</label><br>
                <input type="password" name="senha" required>
                <br><br>




                <input type="submit" name="login" value="Login">
            </form>
            <div class="mensagem">
                <?php if (isset($mensagem_erro)) echo '<p>' . $mensagem_erro . '</p>'; ?>
            </div>
        </div>


</body>
</html>