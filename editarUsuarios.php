<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
include_once './config/config.php';
include_once './classes/usuario.php';


$usu = new Usuario($db);


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = $usu->lerPorId($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idusuario'];
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $email = $_POST['email'];
    $usu->atualizar($id, $nome, $sexo, $email);
    header('Location: listaUsuarios.php');
    exit();
}

try {
    $usu =  new Usuario($db);
    $Usuario = $usu->listarTodos();
    // var_dump($Usuario);
} catch (Exception $e) {
    die("Erro: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <header>
        <img src="./imgs/logoNoticiarioDan.webp" alt="" id="logo">
        <h1>Fofoqueiros de Plantão</h1>
        <h1>Editar Usuário</h1>

        <button><a href="./listaUsuarios.php">Voltar</a></button>
    </header>

<main>
    <form method="POST">
        <input type="hidden" name="idusuario" value="<?php echo $row['idusuario']; ?>">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required>
        <br><br>

        <label>Sexo:</label>
        <label for="masculino_editar">
            <input type="radio" id="masculino_editar" name="sexo" value="M" <?php echo ($row['sexo'] === 'M') ? 'checked' : ''; ?> required> Masculino
        </label>
        <label for="feminino_editar">
            <input type="radio" id="feminino_editar" name="sexo" value="F" <?php echo ($row['sexo'] === 'F') ? 'checked' : ''; ?> required> Feminino
        </label>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
        <br><br>

        <input type="submit" value="Atualizar">
    </form>
</main>
</body>

</html>