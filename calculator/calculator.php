<?php
namespace Project_calculator\Classes;
class Calculator {
    private $result = 0;
    
    public function add($a, $b) {
        $this->result = $a + $b;
        return $this->result;
    }       


    public function getResult() {
        return $this->result;
    }

}
?>