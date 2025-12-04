<?php
require_once __DIR__ . '/../classes/Calculator.php';

$calc = new Calculator();
$result = $calc->add(5, 10);      
echo "The sum is: " . $result;



?>