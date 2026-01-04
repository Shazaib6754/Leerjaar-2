<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\Fiets;

// Acceptatietest (handmatig)
$fiets = new Fiets(
    1,
    'Sparta',
    'mountainbike',
    250,50
);

echo "<h1>Fiets</h1>";
echo "<ul>";
echo "<li>ID: " . $fiets->getId() . "</li>";
echo "<li>Merk: " . $fiets->getMerk() . "</li>";
echo "<li>Type: " . $fiets->getType() . "</li>";
echo "<li>Prijs: €" . number_format($fiets->getPrijs(), 2, ',', '.') . "</li>";
echo "</ul>";
