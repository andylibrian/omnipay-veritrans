<?php

namespace Omnipay\Veritrans\VTDirect;

use Omnipay\Common\AbstractGateway;

class TCashGateway extends AbstractGateway
{
    public function getName()
    {
        return 'Veritrans VT-Direct TCash';
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
            '\Omnipay\Veritrans\VTDirect\Message\TCash\TransactionChargeRequest',
            $parameters
        );
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest(
            '\Omnipay\Veritrans\VTDirect\Message\TCash\TransactionChargeRequest',
            $parameters
        );
    }
}
