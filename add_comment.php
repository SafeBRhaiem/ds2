<?php
session_start();
require('Database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenu = $_POST['contenu'];
    $article_id = $_POST['article_id'];
    $db = new Database();
    $stmt = $db->connexion->prepare("INSERT INTO commentaires (contenu, article_id) VALUES (?, ?)");
    $stmt->execute([$contenu, $article_id]);
    header("Location: index.php");
    exit();
} else {
    echo "Le formulaire n'a pas été soumis.";
}
?>
