<?php

namespace Omnipay\Veritrans\VTDirect\Message\MandiriClickpay;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class Response extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return $this->data['transaction_status'] == 'settlement';
    }

    public function getCode()
    {
        return $this->data['status_code'];
    }

    public function getMessage()
    {
        return $this->data['status_message'];
    }

    public function isRedirect()
    {
        return false;
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectUrl()
    {
        return null;
    }

    public function getRedirectData()
    {
        return array();
    }
}
