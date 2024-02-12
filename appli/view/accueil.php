<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Retrouvez toutes les infos sur vos films favoris.";
?>



<div class="textLanding">
    <h1 class="h1Landing"><?= $titre_secondaire ?></h1>
    <p class="pLanding">Une base de donnée tenue par des passionnés, pour des passionés.</p>
</div>

<div class="containerUn">
    <div class="scrolling-wrapper">
        <div class="scrolling-card"><img class="scrolling-img 1" src="https://www.ecranlarge.com/uploads/image/000/993/the-dark-knight-rises-photo-993749.jpg" alt="">
        </div>

        <div class="scrolling-card"><img class="scrolling-img 2" src="https://www.cinematheque.fr/media/01-films/shutter-island.jpg" alt="">
        </div>

        <div class="scrolling-card"><img class="scrolling-img 3" src="https://www.serieously.com/app/uploads/2022/03/jjk-0-yuta-une.png" alt="">
        </div>
    </div>
</div>
<div class="scrolling-state">
    <div class="scrolling-dot active"></div>
    <div class="scrolling-dot"></div>
    <div class="scrolling-dot"></div>
</div>

<div class="containerDeux">
    <div class="accueilCardUn">
        <a class="nav-link" href="index.php?action=listFilms">Films</a>
        <img class="cardImage" src="https://www.presse-citron.net/app/uploads/2019/03/Affiche-Endgame-presse-citron.png" alt="">
        <div class=filter></div>
    </div>
    <div class="accueilCardDeux">
        <a class="nav-link" href="index.php?action=listActeurs">Acteurs</a>
        <img class="cardImage" src="https://uploads.jovemnerd.com.br/wp-content/uploads/2022/12/the_last_of_us_joel_pedro_pascal__g2c02z8-1210x544.jpg" alt="">
        <div class=filter></div>
    </div>
    <div class="accueilCardTrois">
        <a class="nav-link" href="index.php?action=listReals">Réalisateurs</a>
        <img class="cardImage" src="https://www.programme-tv.net/imgre/fit/~1~tel~2023~10~26~126be7ca-fd0d-489c-ad6b-77c653205d7c.jpeg/1200x600/crop-from/top/quality/80/top-10-des-meilleurs-films-de-tim-burton-et-sa-filmographie-complete.jpg" alt="">
        <div class=filter></div>
    </div>
</div>

<div class="containerTrois">

    <div class="àLaffiche">
        <h3>A l'affiche</h3>
        <div class="accueilFilms">
            
            <?php foreach($requeteFilm->fetchAll() as $film): ?>
                <div>
                    <a class="nav-link" href="index.php?action=detailsFilm&id=<?= $film['id_film'] ?>">
                    <img class="accueilFilm" src="<?= $film['affiche'] ?>" alt=""></a>
                </div>
            <?php endforeach; ?>
           
        </div>
        <div class="container mt-3"><a class="nav-link" href="index.php?action=listFilms">Plus de films à l'affiche</a></div>
    </div>

    <div class="accueilGenres">
        <h3>Categories</h3>
        <div class=" mb-3 accueilListGenres">

            <?php foreach($requeteGenre->fetchAll() as $genre): ?>
            <div class="accueilListGenreElements">
                <a class="link accueilGenreElement" href="index.php?action=detailsGenre&id=<?= $genre['id_genre']?>"><?= $genre['libelle']?></a>
            </div>
            <?php endforeach; ?>

        </div>
        <div class="container mt-3"><a class="nav-link" href="index.php?action=listGenres">Plus de genres</a></div>
    </div>

</div>

<div class="containerQuatre">
    <div class ="àLaMode">
        <h3>Les stars à la mode cette semaine</h3>
        <div class="accueilActeurs">
    
            <?php foreach($requeteActeur->fetchAll() as $acteur): ?>
                <div class="accueilActeur">
                    <p><?= $acteur['acteur']?></p> 
                <a class="nav-link" href="index.php?action=detailsActeur&id=<?= $acteur['id_acteur'] ?> ">
                <img class="accueilActeurImg" src="<?= $acteur['portrait'] ?>" alt=""></a>
            </div>
            <?php endforeach; ?>

        </div>
        <div class="container mt-3"><a class="nav-link" href="index.php?action=listActeurs">Plus d'acteurs</a></div>
    </div>
</div>






<?php
    $content = ob_get_clean();
    require 'view/template.php'; 
?>