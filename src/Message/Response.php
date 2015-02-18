<?php

namespace Omnipay\Veritrans\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class Response extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return in_array($this->getCode(), array('200'));
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
        return !empty($this->data['redirect_url']);
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectUrl()
    {
        return $this->data['redirect_url'] ?: null;
    }

    public function getRedirectData()
    {
        return array();
    }
}
