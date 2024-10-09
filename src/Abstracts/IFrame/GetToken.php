<?php

namespace YG\PayTR\Abstracts\IFrame;

interface GetToken
{
    public function getMerchantOid(): string;

    public function getPaymentAmount(): float;

    public function getCurrency(): string;

    /**
     * @return Basket[]
     */
    public function getUserBasket(): array;

    public function getNoInstallment(): bool;

    public function getMaxInstallment(): int;

    public function getUserIp(): string;

    public function getEmail(): string;

    /**
     * Müşteri adı soyadı
     */
    public function getUserName(): string;

    public function getUserAddress(): string;

    public function getUserPhone(): string;

    public function getMerchantOkUrl(): string;

    public function getMerchantFailUrl(): string;
}