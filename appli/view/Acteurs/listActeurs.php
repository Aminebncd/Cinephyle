<?php
// session_start(); 
ob_start(); 

if (isset($_SESSION['message'])) {
    echo '<div class="alert customAlert mt-2">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}


$titre = "Cinephyle";
$titre_secondaire = "Liste des acteurs";
?>

<h1><?= $titre_secondaire ?></h1>

<p >Nombre d'acteurs répertoriés :<?= $requeteNom->rowCount() ?> </p>

<h3 class="cateFilm">Les stars du moment :</h3 class="cateFilm">
<div class="wrapList">
    <button class="scrollButton" onclick="scrollActeursNom('left')">←</button>
    <div class="acteurContainer Nom">
        <div class="acteurList">
            <?php 
            foreach($requeteNom->fetchAll() as $acteur) { ?>
                <div class="acteurCard">
                    <a class="link" href="index.php?action=detailsActeur&id=<?= $acteur['id_acteur']?>">
                        
                    <img class="afficheList" src="<?= $acteur['portrait'] ?>" alt="<?= $acteur['portrait'] ?>" > 
                    <div class="acteurTitle">   
                        <?= $acteur['nom']?>    
                    </div>   
                    
                </div>
            </a>
            <?php } ?>   
        </div>
        
    </div>
    <button class="scrollButton" onclick="scrollActeursNom('right')">→</button>   
</div>

<h3 class="cateFilm">Ils viennent d'être ajoutés :</h3 class="cateFilm">
<div class="wrapList">
    <button class="scrollButton" onclick="scrollActeursDate('left')">←</button>
    <div class="acteurContainer Date">
        <div class="acteurList">
            <?php 
            foreach($requeteDate->fetchAll() as $acteur) { ?>
                <div class="acteurCard">
                    <a class="link" href="index.php?action=detailsActeur&id=<?= $acteur['id_acteur']?>">
                    
                    <img class="afficheList" src="<?= $acteur['portrait'] ?>" alt="<?= $acteur['portrait'] ?>" > 
                    <div class="acteurTitle">   
                        <?= $acteur['nom']?>    
                    </div>   
            
                </div>
            </a>
            <?php } ?>   
        </div>

    </div>
    <button class="scrollButton" onclick="scrollActeursDate('right')">→</button>   
</div>


<?php 
$content = ob_get_clean();
require "view/template.php" ;