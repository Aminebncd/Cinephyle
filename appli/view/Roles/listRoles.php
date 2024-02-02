
<?php
session_start(); 
ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Liste des rôles";
?>

<h1><?= $titre_secondaire ?></h1>


<div>
    <table>

        <thead>
            <tr>
                <th scope="row" colspan="2">Rôles</th>
                
            </tr>
        </thead>

        <tbody>
            <?php 
            foreach($requeteRoles->fetchAll() as $role) { ?>

                    <tr>                       
                        <td>
                            <a class="filmLink" href="index.php?action=detailsRole&id=<?= $role['id_role']?>"><?= $role['role']?></a>
                        </td>                       
                    </tr>

            <?php } ?>
        </tbody>
        
    </table>
</div>


<?php 

$content = ob_get_clean();
require "view/template.php" ;