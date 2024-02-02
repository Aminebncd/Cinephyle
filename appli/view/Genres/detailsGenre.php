
<?php
session_start(); 
ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Liste des films";
?>

<h1><?= $titre_secondaire ?></h1>


<div>
    <table>

        <thead>
            <tr>
                <th scope="row" colspan="2">Genre</th>
                
            </tr>
        </thead>

        <tbody>
            <?php 
            foreach($requeteCate->fetchAll() as $categorie) { ?>

                    <tr>                       
                        <td>
                            <a class="filmLink" href="index.php?action=detailsFilm&id=<?= $categorie['id_film']?>"><?= $categorie['titre']?></a>
                        </td>                       
                    </tr>

            <?php } ?>
        </tbody>
        
    </table>
</div>


<?php 
$content = ob_get_clean();
require "view/template.php" ;