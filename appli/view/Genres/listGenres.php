
<?php
session_start(); 
ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Liste des genres";
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
            foreach($requeteGenre->fetchAll() as $genre) { ?>

                    <tr>                       
                        <td>
                            <a class="filmLink" href="index.php?action=detailsGenre&id=<?= $genre['id_genre']?>"><?= $genre['libelle']?></a>
                        </td>                       
                    </tr>

            <?php } ?>
        </tbody>
        
    </table>
</div>



<div class="miaou">
    
    <h3 >AJOUTEZ UN GENRE</h3>
    <a href="index.php?action=ajoutGenre">test</a>
</div>


<?php 

$content = ob_get_clean();
require "view/template.php" ;