<?php

namespace YG\PayTR\Abstracts;

interface Config
{
    public function set(string $key, $value): self;

    public function get(string $key): string;
}