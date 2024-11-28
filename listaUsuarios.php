<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit();
}

include_once './config/config.php';
include_once './classes/Usuario.php';


// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit();
}

$usuario = new Usuario($db);

// Obter dados do usuário logado
$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);

// Obter dados dos usuários
$dados = $usuario->ler();
// Função para determinar a saudação
function saudacao() {
    $hora = date('H');
    
    if ($hora >= 6 && $hora < 12) {
        return "Bom dia";
    } elseif ($hora >= 12 && $hora < 18) {
        return "Boa tarde";
    } else {
        return "Boa noite";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuarios cadastrados</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <h1><?php echo saudacao() . ", " . $_SESSION['usuario_nome']; ?>!</h1>

    

    <a href="./cadAutor.php">Adicionar Usuário</a><br>
    <a href="gerenciador.php">Voltar</a>
<br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Sexo</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $dados->fetch()) : ?>
            <tr>
                <td><?php echo $row['idautor']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo ($row['sexo'] === 'M') ? 'Masculino' : 'Feminino'; ?></td>
                <td><?php echo $row['email']; ?></td>
           
                <td>
                    <a href="./editarUsuario.php?id=<?php echo $row['idautor']; ?>">Editar</a>
                    <a href="./deletarUsuario.php?id=<?php echo $row['idautor']; ?>">Deletar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body> </html>