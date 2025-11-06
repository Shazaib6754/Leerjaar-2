<?php
require_once 'database.php';

class FilmActeur {
    public static function link($film_id, $acteur_id) {
        $conn = Database::connect();
        $stmt = $conn->prepare("INSERT INTO film_acteur (film_id, acteur_id) VALUES (?, ?)");
        $stmt->execute([$film_id, $acteur_id]);
    }

    public static function getActorsByFilm($film_id) {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT acteur.naam FROM acteur 
                                JOIN film_acteur ON acteur.id = film_acteur.acteur_id 
                                WHERE film_acteur.film_id = ?");
        $stmt->execute([$film_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>