<?php

namespace Omnipay\Veritrans\VTDirect;

use Omnipay\Common\AbstractGateway;

class CimbClicksGateway extends AbstractGateway
{
    public function getName()
    {
        return 'Veritrans VT-Direct CIMB Clicks';
    }

    public function getDefaultParameters()
    {
        return array(
            'serverKey'   => '',
            'environment' => 'production',
        );
    }

    public function setServerKey($key)
    {
        $this->setParameter('serverKey', $key);
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

    public function authorize(array $parameters = array())
    {
        return $this->createRequest(
            '\Omnipay\Veritrans\VTDirect\Message\CimbClicks\TransactionChargeRequest',
            $parameters
        );
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest(
            '\Omnipay\Veritrans\VTDirect\Message\CimbClicks\TransactionChargeRequest',
            $parameters
        );
    }
}
