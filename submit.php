<?php
require('Database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $db = new Database();
    $nombreLignesAffectees = createArticle($db, $titre, $contenu);

    if ($nombreLignesAffectees > 0) {
        header("Location: index.php");
        exit();
    } else {
        echo "Une erreur est survenue lors de la création de l'article.";
    }
} else {
    echo "Le formulaire n'a pas été soumis.";
}

function createArticle($db, $titre, $contenu) {
    $date_publication = date("Y-m-d H:i:s");
    if ($db) {
        $stmt = $db->connexion->prepare("INSERT INTO articles (titre, contenu, date_publication) VALUES (?, ?, ?)");
        $stmt->execute([$titre, $contenu, $date_publication]);
        return $stmt->rowCount();
    } else {
        return 0; 
    }
}
?>
