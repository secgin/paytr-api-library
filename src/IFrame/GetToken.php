<?php

namespace YG\PayTR\IFrame;

use YG\PayTR\Abstracts\IFrame\Basket;

class GetToken implements \YG\PayTR\Abstracts\IFrame\GetToken
{
    private string $merchantOid;

    private string $email;

    private float $paymentAmount;

    private string $currency = 'TRY';

    private array $userBasket;

    private bool $noInstallment = false;

    private int $maxInstallment = 0;

    private string $userIp;

    private string $userName;

    private string $userAddress;

    private string $userPhone;

    private string $merchantOkUrl;

    private string $merchantFailUrl;

    private function __construct(string $merchantOid,
                                float $paymentAmount,
                                array $userBasket,
                                bool $noInstallment,
                                int $maxInstallment,
                                string $userIp,
                                string $email,
                                string $userName,
                                string $userAddress,
                                string $userPhone,
                                string $merchantOkUrl,
                                string $merchantFailUrl)
    {
        $this->merchantOid = $merchantOid;
        $this->paymentAmount = $paymentAmount;
        $this->userBasket = $userBasket;
        $this->noInstallment = $noInstallment;
        $this->maxInstallment = $maxInstallment;
        $this->userIp = $userIp;
        $this->email = $email;
        $this->userName = $userName;
        $this->userAddress = $userAddress;
        $this->userPhone = $userPhone;
        $this->merchantOkUrl = $merchantOkUrl;
        $this->merchantFailUrl = $merchantFailUrl;
    }

    /**
     * @param string $merchantOid
     * @param float  $paymentAmount
     * @param Basket[]  $userBasket
     * @param bool   $noInstallment
     * @param int    $maxInstallment
     * @param string $userIp
     * @param string $email
     * @param string $userName
     * @param string $userAddress
     * @param string $userPhone
     * @param string $merchantOkUrl
     * @param string $merchantFailUrl
     *
     * @return GetToken
     */
    public static function create(string $merchantOid,
                           float $paymentAmount,
                           array $userBasket,
                           bool $noInstallment,
                           int $maxInstallment,
                           string $userIp,
                           string $email,
                           string $userName,
                           string $userAddress,
                           string $userPhone,
                           string $merchantOkUrl,
                           string $merchantFailUrl): GetToken
    {
        return new GetToken($merchantOid, $paymentAmount, $userBasket, $noInstallment, $maxInstallment,
            $userIp, $email, $userName, $userAddress, $userPhone, $merchantOkUrl, $merchantFailUrl);
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }


    public function getMerchantOid(): string
    {
        return $this->merchantOid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPaymentAmount(): float
    {
        return $this->paymentAmount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return array|Basket[]
     */
    public function getUserBasket(): array
    {
        return $this->userBasket;
    }

    public function getNoInstallment(): bool
    {
        return $this->noInstallment;
    }

    public function getMaxInstallment(): int
    {
        return $this->maxInstallment;
    }

    public function getUserIp(): string
    {
        return $this->userIp;
    }

    /**
     * @inheritDoc
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserAddress(): string
    {
        return $this->userAddress;
    }

    public function getUserPhone(): string
    {
        return $this->userPhone;
    }

    public function getMerchantOkUrl(): string
    {
        return $this->merchantOkUrl;
    }

    public function getMerchantFailUrl(): string
    {
        return $this->merchantFailUrl;
    }
}