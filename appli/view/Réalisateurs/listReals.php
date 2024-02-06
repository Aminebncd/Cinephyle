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
    <button class="scrollButton" onclick="scrollReals('left')">←</button>
    <div class="realContainer">
        <div class="realList">
            <?php 
            foreach($requete->fetchAll() as $real) { ?>
                <div class="realCard">
                    <a class="link" href="index.php?action=detailsReal&id=<?= $real['id_real']?>">
                    
                    <img class="afficheList" src="<?= $real['portrait'] ?>" alt="<?= $real['portrait'] ?>" >  
                    <div class="realTitle">   
                        <?= $real['nom']?>    
                    </div>   
            
                </div>
            </a>
            <?php } ?>   
        </div>
    </div>
    <button class="scrollButton" onclick="scrollReals('right')">→</button>

</div>



<?php 
$content = ob_get_clean();
require "view/template.php" ;