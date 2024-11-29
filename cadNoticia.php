<?php

session_start();
include_once './config/config.php';
include_once './classes/noticia.php';
include_once './classes/usuario.php';

try {
    $Usu =  new Usuario($db);
    $Usuario = $Usu->listarTodos();
    // var_dump($Usuario);
} catch (Exception $e) {
    die("Erro: " . $e->getMessage());
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Notícia</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<header>
        <img src="./imgs/logoNoticiarioDan.webp" alt="" id="logo">
        <h1>Fofoqueiros de Plantão</h1>

    </header>


    <div class="container">
        <form method="POST" action="salvarNoticia.php" enctype="multipart/form-data">
            <h1>Adicionar Notícia</h1>

            <label for="titulo">Titulo da Noticia:</label><br>
            <input type="text" name="titulo" required><br>
            <br>
 
            <select name="autor" required>

                <label for="autor">Autor:</label>
                <option value="">Selecionar Autor</option>
                <?php foreach ($Usuario as $Usuarios): ?>
                    <option value="<?php echo $Usuarios["idusuario"]; ?>">
                        <?php echo htmlspecialchars($Usuarios['nome']); ?></option>
                <?php endforeach; ?>
            </select><br><br>
            <label for="data_publicacao">Data de Publicação</label><br>
            <input type="date" name="data_publicacao" required><br>
            <br>

            <label for="conteudo">Conteudo da Notícia:</label><br>
            <textarea name="conteudo" rows="5" required></textarea><br>
            <br>

            <label for="foto_noticia">Foto da Notícia:</label><br>
            <input type="file" name="foto_noticia" accept=".jpg,.png"><br>
            <br>

            <input type="submit" value="Adicionar">
        </form>
    </div>
</body>

</html>