<?php

namespace YG\PayTR\Abstracts;

interface HttpClient
{
    public function post(string $serviceUrl, array $data): HttpResult;
}