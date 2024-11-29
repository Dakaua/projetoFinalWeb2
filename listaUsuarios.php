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
function saudacao()
{
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
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <header>
        <img src="./imgs/logoNoticiarioDan.webp" alt="" id="logo">
        <h1><?php echo saudacao() . ", " . $_SESSION['usuario_nome']; ?>!</h1>

        <button><a href="./cadUsuario.php">Adicionar Usuário</a></button><br>
        <button><a href="gerenciador.php">Voltar</a></button>
    </header>
    <main>


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
                    <td><?php echo $row['idusuario']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo ($row['sexo'] === 'M') ? 'Masculino' : 'Feminino'; ?></td>
                    <td><?php echo $row['email']; ?></td>

                    <td>
                        <button><a href="./editarUsuarios.php?id=<?php echo $row['idusuario']; ?>">Editar</a></button>
                        <button><a href="./deletarUsuario.php?id=<?php echo $row['idusuario']; ?>">Deletar</a></button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>

</html>