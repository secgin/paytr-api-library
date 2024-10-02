<?php

namespace YG\PayTR;

/**
 * @method Config merchantId(string $merchantId)
 * @method Config merchantKey(string $merchantKey)
 * @method Config merchantSalt(string $merchantSalt)
 * @method Config activeTestMode()
 * @method Config activeDebugMode()
 */
class Config implements Abstracts\Config
{
    private array $items = [];

    private array $methods = [
        'merchantId',
        'merchantKey',
        'merchantSalt'
    ];

    private function __construct(array $config)
    {
        $this->items = $config;
        $this->loadServices();
    }

    public static function create(array $config = []): self
    {
        return new self($config);
    }

    public function set(string $key, $value): Abstracts\Config
    {
        $this->items[$key] = $value;
        return $this;
    }

    public function get(string $key): string
    {
        return $this->items[$key] ?? '';
    }

    public function __call($name, $arguments)
    {
        if ($name == 'activeTestMode')
        {
            $this->set('testMode', true);
            return $this;
        }
        elseif ($name == 'activeDebugMode')
        {
            $this->set('debugOn', true);
            return $this;
        }

        if (in_array($name, $this->methods) === false)
            throw new \Exception('Method not found!');

        if (count($arguments) === 0)
            return $this->get($name);

        return $this->set($name, $arguments[0]);
    }

    private function loadServices(): void
    {
        $tokenServiceUrl = 'https://www.paytr.com/odeme/api/get-token';

        $this->set('tokenServiceUrl', $tokenServiceUrl);
    }
}