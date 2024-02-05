<?php
session_start(); 
ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Liste des réalisateurs";
?>

<h1><?= $titre_secondaire ?></h1>

<p >Nombre de réalisateurs :<?= $requete->rowCount() ?> </p>
<h2>Les plus recherchés :</h2>

<div class="wrapList">
    <button class="scrollButton" onclick="scrollFilms('left')">←</button>
    <div class="filmContainer">
        <div class="filmList">
            <?php 
            foreach($requete->fetchAll() as $real) { ?>
                <div class="filmCard">
                    <a class="filmLink" href="index.php?action=detailsReal&id=<?= $real['id_real']?>">
                    
                    <img class="afficheList" src="<?= $real['portrait'] ?>" alt="<?= $real['portrait'] ?>" >  
                    <div class="filmTitle">   
                        <?= $real['nom']?>    
                    </div>   
            
                </div>
            </a>
            <?php } ?>   
        </div>
    </div>
    <button class="scrollButton" onclick="scrollFilms('right')">→</button>

</div>

<div class="miaou">
    
    <h3 >AJOUTEZ UN REALISATEUR</h3>
    <a href="index.php?action=ajoutReal">test</a>
</div>


<?php 
$content = ob_get_clean();
require "view/template.php" ;