<?php
session_start();
include_once "./config/config.php";
include_once "./classes/noticia.php";
$result = new Noticia($db);
$consulta = $result->listarTodos();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Notícias</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>

        <!-- Titulo no header -->
        <h1>Lista de Notícias</h1>

        <!-- botao de cadNoticia -->
        <button><a href="cadNoticia.php">Cadastro de Noticia</a></button>

         <!-- botao de gerenciador de usuario -->
        <button><a href="listaUsuarios.php">Gerenciador de Usuarios</a></button>

        <button><a href="logout.php">Logout</a></button>
    </header>
    <main>
        <!-- tabela de noticias -->
        <h3>Notícias</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Data</th>
                <th>Conteudo</th>
                <th>Foto</th>
                <th>Autor</th>
                <th>Ações</th>
            </tr>

            <?php

            
            while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) :
            ?>
                <tr>
                    <td><?php echo $row['idnoticia']; ?></td>
                    <td><?= $row["titulo"]; ?></td>
                    <td><?= $row["data"]; ?></td>
                    <td><?= $row["noticia"]; ?></td>
                    <td><img src="./uploads/<?= $row["foto"]; ?>" alt="foto"></td>
                    <td><?= $row["autor"]; ?></td>
                    <td>
                    <button><a href="altNoticia.php?id=<?php echo $row['idnoticia']; ?>">Editar</a></button>
                    <button><a href="deletarNot.php?id=<?php echo $row['idnoticia']; ?>">Deletar</a></button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

    </main>

    <!-- implementar um footer a planejar ainda -->
</body>

</html>