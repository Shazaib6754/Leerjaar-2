<?php
class Database {
    private static $host = "localhost";
    private static $dbname = "film"; // jouw database naam
    private static $username = "root"; // pas aan als nodig
    private static $password = ""; // pas aan als nodig
    private static $conn = null;

    public static function connect() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connectie mislukt: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
?>