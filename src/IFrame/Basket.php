<?php

namespace YG\PayTR\IFrame;

class Basket implements \YG\PayTR\Abstracts\IFrame\Basket
{
    private string $name;

    private float $price;

    private string $quantity;

    private function __construct(string $name, string $price, string $quantity)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public static function create(string $name, string $price, string $quantity): Basket
    {
        return new Basket($name, $price, $quantity);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }
}