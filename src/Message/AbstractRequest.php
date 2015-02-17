<?php

namespace Omnipay\Veritrans\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    const BASE_URL_PRODUCTION = 'https://api.veritrans.co.id/v2';
    const BASE_URL_SANDBOX    = 'https://api.sandbox.veritrans.co.id/v2';

    abstract public function getEndpoint();

    public function getBaseUrl()
    {
        $env = $this->getParameter('environment');

        if ($env === 'production') {
            return self::BASE_URL_PRODUCTION;
        } else {
            return self::BASE_URL_SANDBOX;
        }
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    public function setServerKey($value)
    {
        $this->setParameter('serverKey', $value);
    }

    public function getServerKey()
    {
        return $this->getParameter('serverKey');
    }

    public function setEnvironment($env)
    {
        $this->setParameter('environment', $env);
    }

    public function getEnvironment()
    {
        return $this->getParameter('environment');
    }

    public function sendData($data)
    {
        // don't throw exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        $httpRequest = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            null,
            $data
        );

        $httpResponse = $httpRequest
            ->setHeader('Authorization', 'Basic '.base64_encode($this->getServerKey().':'))
            ->setHeader('Content-Type', 'application/json')
            ->setHeader('Accept', 'application/json')
            ->send();

        return $this->response = new Response($this, $httpResponse->json());
    }
}
