<?php

namespace YG\PayTR;

use Exception;
use YG\PayTR\Abstracts\AbstractHandler;
use YG\PayTR\Abstracts\HttpClient;
use YG\PayTR\Abstracts\Response;
use YG\PayTR\IFrame\GetTokenHandler;

class PayTrClient implements \YG\PayTR\Abstracts\PayTrClient
{
    private Config $config;

    private HttpClient $httpClient;

    private array $requestClasses = [
        'getToken' => GetTokenHandler::class
    ];

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->httpClient = new CurlHttpClient();
    }

    #region Handler Methods
    private function getRequestHandler($name)
    {
        $requestHandlerClass = $this->requestClasses[$name];
        $handler = new $requestHandlerClass();

        if ($handler instanceof AbstractHandler)
        {
            $handler->setConfig($this->config);
            $handler->setHttpClient($this->httpClient);
        }
        return $handler;
    }


    private function hasRequestClass(string $name): bool
    {
        return isset($this->requestClasses[$name]);
    }

    private function handle(string $requestName, $request): Response
    {
        return $this->getRequestHandler($requestName)->handle($request);
    }
    #endregion

    #region Magic Methods
    /**
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        if ($this->hasRequestClass($name))
            return $this->handle($name, $arguments[0] ?? null);

        throw new Exception('Method not found');
    }
    #endregion
}