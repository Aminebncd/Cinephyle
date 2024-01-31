<?php
ob_start();
$titre = "Cinephyle";
$titre_secondaire = "Liste des films";

?>


<h1><?= $titre_secondaire ?></h1>
<!-- <h3>Nombre de films : <?= $requete->rowCount() ?></h3> -->
<div class="wrapList">

    <button class="scrollButton" onclick="scrollFilms('left')">←</button>
    <div class="filmContainer">
        <div class="filmList">
            <?php 
            foreach($requete->fetchAll() as $film) { ?>
                <div class="filmCard">
                    <a class="filmLink" href="index.php?action=detailsFilm&id=<?= $film['id_film']?>">
                    
                    <img class="afficheList" src="<?= $film['affiche'] ?>" alt="<?= $film['affiche'] ?>" >    
                    
                    <div class="filmTitle">   
                        <?= $film['titre']?>    
                    </div>
                </div>
            </a>
            <?php } ?>   
        </div>
    </div>
    <button class="scrollButton" onclick="scrollFilms('right')">→</button>

</div>


<?php 

$content = ob_get_clean();
require 'view/template.php'; 

?>