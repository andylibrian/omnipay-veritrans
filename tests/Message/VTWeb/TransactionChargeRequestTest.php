<?php

namespace Omnipay\Veritrans\Message\VTWeb;

use Omnipay\Tests\TestCase;

class TransactionChargeRequestTest extends TestCase
{
    public function setup()
    {
        $this->request = new TransactionChargeRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSetGetVtwebConfiguration()
    {
        $value = array('config-name' => 'config-value');

        $this->request->setVtwebConfiguration($value);
        $this->assertEquals($value, $this->request->getVtwebConfiguration());
    }

    public function testGetData()
    {
        $this->request->initialize(
            array(
                'amount'   => '12000.00',
                'currency' => 'IDR',
                'card'     => $this->getValidCard(),
            )
        );
        $this->assertNotEmpty($this->request->getData());
    }

    public function testGetDataWithItems()
    {
        $this->request->initialize(
            array(
                'amount'   => '12000.00',
                'currency' => 'IDR',
                'card'     => $this->getValidCard(),
                'items'    => [['name' => 'Test', 'price' => '100.00', 'quantity' => 2,]]
            )
        );
        $this->assertNotEmpty($this->request->getData());
        $this->assertTrue(strpos($this->request->getData(), 'item_details') !== false);
        $this->request->initialize(
            array(
                'amount'   => '12000.00',
                'currency' => 'IDR',
                'card'     => $this->getValidCard(),
            )
        );
        $this->assertNotEmpty($this->request->getData());
        $this->assertFalse(strpos($this->request->getData(), 'item_details'));
    }

    public function testGetEndpoint()
    {
        $this->assertEquals($this->request->getBaseUrl() . '/charge', $this->request->getEndPoint());
    }
}
