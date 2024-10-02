<?php

namespace YG\PayTR\Abstracts;

interface Response
{
    public function isSuccess(): bool;

    public function getErrorCode(): ?string;

    public function getErrorMessage(): ?string;

    public function getResult(): ?array;
}