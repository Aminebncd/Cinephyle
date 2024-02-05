<?php
ob_start();
$titre = "Cinephyle";
$titre_secondaire = "Liste des films";
?>

<h1><?= $titre_secondaire ?></h1>

<h3 class="cateFilm">Les plus recents :</h3>
<div class="wrapList">
    <button class="scrollButton" onclick="scrollFilmsDate('left')">←</button>
    <div class="filmContainer Date">
        <div class="filmList">
            <?php foreach ($filmsDate as $film) : ?>
                <div class="filmCard">
                    <a class="filmLink" href="index.php?action=detailsFilm&id=<?= $film['id_film']?>">
                        <img class="afficheList" src="<?= $film['affiche'] ?>" alt="<?= $film['affiche'] ?>" >    
                        <div class="filmTitle"><?= $film['titre']?></div>
                    </a>
                </div>
            <?php endforeach; ?>   
        </div>
    </div>
    <button class="scrollButton" onclick="scrollFilmsDate('right')">→</button>
</div>

<h3 class="cateFilm">Les mieux notés :</h3>
<div class="wrapList">
    <button class="scrollButton" onclick="scrollFilmsNote('left')">←</button>
    <div class="filmContainer Note">
        <div class="filmList">
            <?php foreach ($filmsNote as $film) : ?>
                <div class="filmCard">
                    <a class="filmLink" href="index.php?action=detailsFilm&id=<?= $film['id_film']?>">
                        <img class="afficheList" src="<?= $film['affiche'] ?>" alt="<?= $film['affiche'] ?>" >    
                        <div class="filmTitle"><?= $film['titre']?></div>
                    </a>
                </div>
            <?php endforeach; ?>   
        </div>
    </div>
    <button class="scrollButton" onclick="scrollFilmsNote('right')">→</button>
</div>

<div class="miaou">
    <h3>AJOUTEZ UN FILM</h3>
    <a href="index.php?action=ajoutFilm">test</a>
</div>

<?php 
$content = ob_get_clean();
require 'view/template.php'; 
?>
