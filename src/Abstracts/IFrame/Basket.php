<?php

namespace YG\PayTR\Abstracts\IFrame;

interface Basket
{
    public function getName(): string;

    public function getPrice(): float;

    public function getQuantity(): float;
}