<?php
session_start(); 
ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Liste des acteurs";
?>

<h1><?= $titre_secondaire ?></h1>

<p >Nombre d'acteurs :<?= $requete->rowCount() ?> </p>
<h2>Les stars du moment :</h2>

<div class="wrapList">
    <button class="scrollButton" onclick="scrollFilms('left')">←</button>
    <div class="filmContainer">
        <div class="filmList">
            <?php 
            foreach($requete->fetchAll() as $acteur) { ?>
                <div class="filmCard">
                    <a class="filmLink" href="index.php?action=detailsActeur&id=<?= $acteur['id_acteur']?>">
                    
                    <img class="afficheList" src="<?= $acteur['portrait'] ?>" alt="<?= $acteur['portrait'] ?>" > 
                    <div class="filmTitle">   
                        <?= $acteur['nom']?>    
                    </div>   
            
                </div>
            </a>
            <?php } ?>   
        </div>
    </div>
    <button class="scrollButton" onclick="scrollFilms('right')">→</button>

    

</div>

<div class="miaou">
    
    <h3 >AJOUTEZ UN ACTEUR</h3>
    <a href="index.php?action=ajoutActeur">test</a>
</div>


<?php 
$content = ob_get_clean();
require "view/template.php" ;