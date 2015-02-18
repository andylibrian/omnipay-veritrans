<?php

namespace Omnipay\Veritrans;

use Omnipay\Common\AbstractGateway;

class VTWebGateway extends AbstractGateway
{
    public function getName()
    {
        return 'Veritrans VT-Web';
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
        return $this->createRequest('\Omnipay\Veritrans\Message\VTWeb\TransactionChargeRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Veritrans\Message\VTWeb\TransactionChargeRequest', $parameters);
    }
}
