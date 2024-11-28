<?php 
session_start();
include "./config/config.php";
include "./classes/noticia.php";

// Supondo que $db é a conexão ao banco
$query = "SELECT tbnoticia.titulo, tbnoticia.data, tbnoticia.noticia, tbnoticia.foto,  tbautor.nome AS autor 
                FROM tbnoticia 
                JOIN tbautor ON tbnoticia.autor = tbautor.idautor";
$stmt = $db->prepare($query);
$stmt->execute();
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Notícias</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <img src="" alt="">
        <h1>Portal de Notícias</h1>

        <button><a href="login.php">Gerenciadores</a>
    </header>
    <main>
    <div class="noticias-container">
        <?php foreach ($noticias as $noticia): ?>
            <div class="noticia">
                <h2><?= htmlspecialchars($noticia['titulo']) ?></h2>
                <p><?= htmlspecialchars($noticia['noticia']) ?></p>
                <p><strong>Autor:</strong> <?= htmlspecialchars($noticia['autor']) ?></p>
                <p><strong>Data:</strong> <?= htmlspecialchars($noticia['data']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    </main>
</body>

</html>