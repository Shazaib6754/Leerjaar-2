<?php
require_once 'database.php';

class Film {
    public static function add($titel, $genre) {
        $conn = Database::connect();
        $stmt = $conn->prepare("INSERT INTO film (titel, genre) VALUES (?, ?)");
        $stmt->execute([$titel, $genre]);
    }

    public static function all() {
        $conn = Database::connect();
        $stmt = $conn->query("SELECT * FROM film");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>