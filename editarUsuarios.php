<?php 
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
include_once './config/config.php';
include_once './classes/usuario.php';
 

$usu = new Usuario($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idautor'];
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $email = $_POST['email'];
    $usuario->atualizar($id, $nome, $sexo, $email);
    header('Location: portal.php');
    exit();
}
if (isset($_POST['idautor'])) {
    $id = $_POST['idautor'];
    $row = $usuario->lerPorId($id);
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
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <h1>Editar Usuário</h1>
    
    <a href="./listaUsuarios.php">Voltar</a>
    
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['idautor']; ?>">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo $row['nome']; ?>" required>
        <br><br>
        <label>Sexo:</label>
        <label for="masculino_editar">
            <input type="radio" id="masculino_editar" name="sexo" value="M" <?php echo ($row['sexo'] === 'M') ? 'checked' : ''; ?> required> Masculino
        </label>
        <label for="feminino_editar">
            <input type="radio" id="feminino_editar" name="sexo" value="F" <?php echo ($row['sexo'] === 'F') ? 'checked' : ''; ?> required> Feminino
        </label>
        <br><br>
        <label for="fone">Fone:</label>
        <input type="text" name="fone" value="<?php echo $row['fone']; ?>" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
        <br><br>
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>