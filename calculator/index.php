<?php

// Autoloader voor classes
require_once 'vendor/autoload.php';

// use Project_calculator\Classes\Calculator;
// require_once 'classes/Calculator.php';
// require_once 'classes/Calculator2.php';

// Gebruik van Calculator class
$calculator = new Calculator();

echo $calculator->add(5, 3);
echo "<br>";
echo $calculator->add(10.5, 7.5);
echo "<br>";
