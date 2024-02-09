
<?php

ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Liste des rôles répertoriés";
if (isset($_SESSION['message'])) {
    echo '<div class="alert customAlert mt-2">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>

<div class="container">
    <h1><?= $titre_secondaire ?></h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Rôles</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($requeteRoles->fetchAll() as $role): ?>
                <tr>
                    <td>
                        <a class="link" href="index.php?action=detailsRole&id=<?= $role['id_role']?>"><?= $role['role']?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php 
$content = ob_get_clean();
require "view/template.php";
?>
