<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
    <meta name="description" content="Cinephyle - Découvrez un large catalogue de films, consultez les dernières sorties, explorez les biographies des réalisateurs et des acteurs. Restez informé sur les dernières tendances cinématographiques.">
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      crossorigin="anonymous"
    />
</head>

<body>
  <!-- Barre de navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark ">
        <a class="navbar-brand" href="index.php">CINEPHYLE</a>
        
        <!-- Bouton pour la navigation mobile -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Contenu de la barre de navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Liens vers différentes actions de l'application -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=listFilms">Films</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=listActeurs">Acteurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=listReals">Réalisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=listGenres">Genres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=listRoles">Rôles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=ajout">Modifications</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div id="wrapper">
        <?= $content ?>
    </div>

    <script src="public/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <footer class="footer mt-auto py-3 text-white">
        <div class="text-center">
            <span>AmineBncd @ ElanFormation | <a class="nav-item link" href="https://github.com/Aminebncd">Github</a> | <a class="nav-item link" href="https://www.linkedin.com/in/mohamed-amine-bounachada-9a2819200/">Linkedin</a></span>  
        </div>
    </footer>

</body>
</html>
