<?php

namespace App\Model;

class Fiets
{
    public function __construct(
        private int $id,
        private string $merk,
        private string $type,
        private float $prijs
    ) {}

    public function getId(): int { return $this->id; }
    public function getMerk(): string { return $this->merk; }
    public function getType(): string { return $this->type; }
    public function getPrijs(): float { return $this->prijs; }
}
