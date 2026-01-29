<?php
header("Content-Type: application/json");

// =======================
// DATABASE CONNECTIE
// =======================
$dsn  = "mysql:host=localhost;dbname=products_db;charset=utf8mb4";
$user = "root";   // pas aan indien nodig
$pass = "";       // pas aan indien nodig

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database connectie mislukt"]);
    exit;
}

// =======================
// REQUEST METHOD
// =======================
$method = $_SERVER["REQUEST_METHOD"];

// =======================
// GET — DATA OPVRAGEN
// =======================
if ($method === "GET") {
    $stmt = $pdo->query("SELECT id, naam, prijs FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    http_response_code(200);
    echo json_encode($products);
    exit;
}

// =======================
// POST — DATA OPSLAAN
// =======================
if ($method === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data || empty($data["naam"]) || empty($data["prijs"])) {
        http_response_code(400);
        echo json_encode(["error" => "Naam en prijs zijn verplicht"]);
        exit;
    }

    if (!is_numeric($data["prijs"])) {
        http_response_code(400);
        echo json_encode(["error" => "Prijs moet een getal zijn"]);
        exit;
    }

    // Unieke productnaam check
    $check = $pdo->prepare("SELECT id FROM products WHERE naam = ?");
    $check->execute([$data["naam"]]);
    if ($check->fetch()) {
        http_response_code(400);
        echo json_encode(["error" => "Productnaam bestaat al"]);
        exit;
    }

    // Insert
    $stmt = $pdo->prepare("INSERT INTO products (naam, prijs) VALUES (?, ?)");
    $stmt->execute([$data["naam"], $data["prijs"]]);

    http_response_code(201);
    echo json_encode(["message" => "Product succesvol toegevoegd"]);
    exit;
}

// =======================
// NIET ONDERSTEUNDE METHODS
// =======================
http_response_code(405);
echo json_encode(["error" => "Method not allowed"]);
