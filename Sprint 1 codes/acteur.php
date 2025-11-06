<?php
require_once 'database.php';

class Acteur {
    public static function add($naam) {
        $conn = Database::connect();
        $stmt = $conn->prepare("INSERT INTO acteur (naam) VALUES (?)");
        $stmt->execute([$naam]);
    }

    public static function all() {
        $conn = Database::connect();
        $stmt = $conn->query("SELECT * FROM acteur");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>