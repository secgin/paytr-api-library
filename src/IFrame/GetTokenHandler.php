<?php

namespace YG\PayTR\IFrame;

use YG\PayTR\Abstracts\AbstractHandler;

class GetTokenHandler extends AbstractHandler
{
    public function handle(\YG\PayTR\Abstracts\IFrame\GetToken $request): \YG\PayTR\Abstracts\IFrame\GetTokenResult
    {
        $merchantId = $this->config->get('merchantId');
        $merchantSalt = $this->config->get('merchantSalt');
        $merchantKey = $this->config->get('merchantKey');
        $testMode = boolval($this->config->get('testMode')) ? '1' : '0';
        $debugOn = boolval($this->config->get('debugOn')) ? '1' : '0';
        $paymentAmount = round(round($request->getPaymentAmount(), 2) * 100);
        $noInstallment = $request->getNoInstallment() ? '1' : '0';


        $hashStr = $merchantId .
            $request->getUserIp() .
            $request->getMerchantOid() .
            $request->getEmail() .
            $paymentAmount .
            $request->getUserBasket() .
            $noInstallment .
            $request->getMaxInstallment() .
            $request->getCurrency() .
            $testMode;

        $payTrToken = base64_encode(hash_hmac('sha256', $hashStr . $merchantSalt, $merchantKey, true));

        $postValues = [
            'merchant_id' => $merchantId,
            'user_ip' => $request->getUserIp(),
            'merchant_oid' => $request->getMerchantOid(),
            'email' => $request->getEmail(),
            'payment_amount' => $paymentAmount,
            'paytr_token' => $payTrToken,
            'user_basket' => $request->getUserBasket(),
            'debug_on' => $debugOn,
            'no_installment' => $noInstallment,
            'max_installment' => $request->getMaxInstallment(),
            'user_name' => $request->getUserName(),
            'user_address' => $request->getUserAddress(),
            'user_phone' => $request->getUserPhone(),
            'merchant_ok_url' => $request->getMerchantOkUrl(),
            'merchant_fail_url' => $request->getMerchantFailUrl(),
            //'timeout_limit'=>$timeout_limit,
            'currency' => $request->getCurrency(),
            'test_mode' => $testMode
        ];

        $result = $this->httpClient->post($this->config->get('tokenServiceUrl'), $postValues);

        return GetTokenResult::create($result);
    }
}