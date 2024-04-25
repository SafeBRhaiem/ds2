<?php
session_start();

require('Database.php');

$db = new Database();

$query = $db->query("SELECT articles.*, GROUP_CONCAT(commentaires.contenu SEPARATOR '<br>') AS commentaires FROM articles LEFT JOIN commentaires ON articles.id = commentaires.article_id GROUP BY articles.id ORDER BY articles.id DESC");

$articles = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog.Palestine</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white py-4">
        <div class="container">
            <h1 class="mb-0">Blog.Palestine</h1>
            <nav class="mt-3">
                <ul class="list-unstyled d-flex justify-content-center">
                    <li class="mx-3"><a href="index.php" class="text-white">Accueil</a></li>
                    <li class="mx-3"><a href="write_article.html" class="text-white">Écrire Article</a></li>
                    <li class="mx-3"><a href="info.html" class="text-white">Information</a></li>
                    <li class="mx-3"><a href="about.html" class="text-white">À propos</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="py-4">
        <section class="latest-articles">
            <div class="container">
                <h2 class="mb-4">Derniers Articles</h2>
                <div class="row">
                    <?php foreach ($articles as $article): ?>
                        <article class="col-md-6 mb-4">
                            <h3><?php echo $article['titre']; ?></h3>
                            <p><?php echo $article['contenu']; ?></p>
                            <form action="add_comment.php" method="post">
                                <input type="hidden" name="article_id" value="<?php echo $article['id']; ?>">
                                <textarea name="contenu" class="form-control mb-3" placeholder="Ajouter un commentaire"></textarea>
                                <button type="submit" class="btn btn-primary">Ajouter Commentaire</button>
                            </form>

                            <?php if (!empty($article['commentaires'])): ?>
                                <div class="mt-3">
                                    <h4>Commentaires:</h4>
                                    <p><?php echo $article['commentaires']; ?></p>
                                </div>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white py-3">
        <div class="container text-center">
            <p>&copy; 2024 Blog sur la Palestine</p>
        </div>
    </footer>
</body>
</html>
