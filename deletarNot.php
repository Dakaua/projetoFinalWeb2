<?php
session_start();
if (!isset($_GET['id'])) {
    header('Location: gerenciador.php');
    exit();
}
include_once './config/config.php';
include_once './classes/noticia.php';


$noticia = new Noticia($db);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $noticia->deletar($id);
    header('Location: gerenciador.php');
    exit();
}
?>