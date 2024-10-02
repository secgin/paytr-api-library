<?php

namespace YG\PayTR\IFrame;

use YG\PayTR\Abstracts\AbstractResponse;
use YG\PayTR\Abstracts\HttpResult;

class GetTokenResult extends AbstractResponse implements \YG\PayTR\Abstracts\IFrame\GetTokenResult
{
    public static function create(HttpResult $result): self
    {
        return new self($result);
    }

    public function getToken(): string
    {
        return $this->result['token'] ?? '';
    }
}