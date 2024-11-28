<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
include_once './config/config.php';
include_once './classes/usuario.php';
include_once './classes/noticia.php';


$noticia = new Noticia($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idnoticia'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $conteudo = $_POST['conteudo'];
    $dataPublicacao = $_POST['data_publicacao'];
    $fotoPublicacao = $_FILES['foto_noticia'];
    $noticia->atualizar($id, $titulo, $dataPublicacao, $conteudo, $fotoPublicacao);
    header('Location: portal.php');
    exit();
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = $noticia->lerPorId($id);
}
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
    <title>Altera Notícia</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Alterar Notícia</h1>
        <form method="POST" action="salvarNoticia.php" enctype="multipart/form-data">

            <label for="titulo">Titulo da Noticia:</label><br>
            <input type="text" name="titulo" value= <?php echo $row['titulo']?> required><br>
            <br>

            <label for="autor">Autor:</label><br>
            
            <select name="autor" required>
                <option value="">Selecionar Autor</option>
                <?php foreach ($Usuario as $Usuarios): ?>

                    <option value="<?php echo $Usuarios["idautor"]; ?>">
                        <?php echo htmlspecialchars($Usuarios['nome']); ?></option>
                <?php endforeach; ?>
            </select><br><br>


            <label for="data_publicacao">Data de Publicação</label><br>
            <input type="date" name="data_publicacao" value=<?php echo $row['data']; ?> required><br>
            <br>

            <label for="conteudo">Conteudo da Notícia:</label><br>
            <textarea name="conteudo" rows="5" required value= <?php echo $row['noticia'];?>></textarea><br>
            <br>

            <label for="foto_noticia">Foto da Notícia:</label><br>
            <input type="file" name="foto_noticia" accept=".jpg,.png"><br>
            <br>

            <input type="submit" value="Adicionar">
        </form>
    </div>
</body>

</html>