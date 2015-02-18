<?php

namespace Omnipay\Veritrans\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Tests\TestCase;

class ResponseTest extends TestCase
{
    public function setup()
    {
        $this->response = new Response(
            $this->getMockRequest(),
            array(
                'status_code'    => 200,
                'status_message' => 'message',
                'redirect_url'   => 'url',
            )
        );
    }

    public function testIsSuccessful()
    {
        $this->assertTrue($this->response->isSuccessful());
    }

    public function testGetCode()
    {
        $this->assertEquals(200, $this->response->getCode());
    }

    public function testGetMessage()
    {
        $this->assertEquals('message', $this->response->getMessage());
    }

    public function testIsRedirect()
    {
        $this->assertTrue($this->response->isRedirect());
    }

    public function testGetRedirectMethod()
    {
        $this->assertEquals('GET', $this->response->getRedirectMethod());
    }

    public function testGetRedirectUrl()
    {
        $this->assertEquals('url', $this->response->getRedirectUrl());
    }

    public function testGetRedirectData()
    {
        $this->assertEquals(array(), $this->response->getRedirectData());
    }
}
