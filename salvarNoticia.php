<?php
require_once "./config/config.php";
require_once "./classes/noticia.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $noticiaObj = new Noticia($db);
    $idNoticia = isset($_POST['idnoticia']) ? $_POST['idnoticia'] : null; // Verifica se é edição
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $noticia = $_POST['conteudo'];
    $dataPublicacao = $_POST['data_publicacao'];
    $imagem = $_FILES['foto_noticia'];

    // Validação e upload da imagem
    $nomeImagem = "";
    if ($imagem['error'] === UPLOAD_ERR_OK) {
        $extensao = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));
        $tamanhoMaximo = 10 * 1024 * 1024; // 10 MB

        // Validar tipo de arquivo
        $tiposPermitidos = ['jpg', 'jpeg', 'png'];
        if (!in_array($extensao, $tiposPermitidos)) {
            die("Apenas arquivos JPG ou PNG são permitidos.");
        }

        // Validar tamanho do arquivo
        if ($imagem['size'] > $tamanhoMaximo) {
            die("O tamanho do arquivo não pode exceder 10 MB.");
        }

        // Gerar nome único para o arquivo
        $nomeImagem = uniqid() . "." . $extensao;
        $destino = "uploads/" . $nomeImagem;

        // Mover o arquivo para o diretório
        if (!move_uploaded_file($imagem['tmp_name'], $destino)) {
            die("Erro ao salvar a imagem.");
        }
    } else if ($imagem['error'] !== UPLOAD_ERR_NO_FILE) {
        die("Erro ao fazer upload da imagem.");
    }

    // Diferenciar entre cadastro e atualização
    if ($idNoticia) {
        // Atualizar notícia existente
        $noticiaObj->atualizar($idNoticia, $titulo, $dataPublicacao, $noticia, $nomeImagem);
        echo "Notícia atualizada com sucesso!";
    } else {
        // Cadastrar nova notícia
        $noticiaObj->registrar($titulo, $dataPublicacao, $noticia, $nomeImagem, $autor);
        echo "Notícia salva com sucesso!";
    }

    echo '<br><a href="gerenciador.php">Voltar</a>';
}
?>
