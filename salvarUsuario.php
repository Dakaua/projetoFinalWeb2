<?php
require_once "./config/config.php";
require_once "./classes/usuario.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioObj = new Usuario($db);
    $idusuario = isset($_POST['idusuario']) ? $_POST['idusuario'] : null; // Verifica se é edição
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $email = $_POST['email'];


    // Diferenciar entre cadastro e atualização
    if ($idusuario) {
        // Atualizar usuário existente
        $usuarioObj->atualizar($idusuario, $nome, $sexo, $email);
        echo "Usuário atualizado com sucesso!";
    } else {
        // Cadastrar novo usuário
        $usuarioObj->registrar($nome, $sexo, $email, $senha); // Corrigido
        echo "Usuário salvo com sucesso!";
    }
    

    echo '<br><a href="listaUsuarios.php">Voltar</a>';
}
?>
