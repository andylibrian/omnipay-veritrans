<?php

namespace Omnipay\Veritrans;

class VTWebGatewayTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->gateway = new VTWebGateway();
    }

    public function testGetName()
    {
        $this->assertEquals('Veritrans VT-Web', $this->gateway->getName());
    }

    public function testGetDefaultParameters()
    {
        $this->assertEquals(
            array(
                'serverKey'   => '',
                'environment' => 'production',
            ),
            $this->gateway->getDefaultParameters()
        );
    }

    public function testSetGetServerKey()
    {
        $this->gateway->setServerKey('key');
        $this->assertEquals('key', $this->gateway->getServerKey());
    }

    public function testSetGetEnvironment()
    {
        $this->gateway->setEnvironment('env');
        $this->assertEquals('env', $this->gateway->getEnvironment());
    }

    public function testAuthorize()
    {
        $this->assertInstanceOf(
            'Omnipay\Veritrans\Message\VTWeb\TransactionChargeRequest',
            $this->gateway->authorize()
        );
    }

    public function testPurchase()
    {
        $this->assertInstanceOf(
            'Omnipay\Veritrans\Message\VTWeb\TransactionChargeRequest',
            $this->gateway->purchase()
        );
    }
}
