<?php

namespace Controller;

use Model\Connect;

class cinemaController {

    // lister les films
    public function listFilms() {

        $pdo = Connect::seConnecter();
        
        $requete = $pdo->query("
            SELECT id_film, titre, date_sortie_france
            FROM film
        ");

        require "view/listFilms.php";
    }

    public function detailsFilm($id) {
        $pdo = Connect::seConnecter();
    
        $requete = $pdo->prepare("
            SELECT titre, date_sortie_france, duree, resume, note
            FROM film
            WHERE id_film = :id
        ");
        $requete->execute([":id" => $id]);
    
        require "view/detailsFilm.php";
    }
    

}