<?php

namespace Omnipay\Veritrans\Message\VTWeb;

use Omnipay\Veritrans\Message\AbstractRequest;

class TransactionChargeRequest extends AbstractRequest
{
    public function setVtwebConfiguration(array $value)
    {
        $this->setParameter('vtwebConfiguration', $value);
    }

    public function getVtwebConfiguration()
    {
        return $this->getParameter('vtwebConfiguration');
    }

    public function getData()
    {
        $amountInteger = $this->getAmountInteger();

        // this is a workaround because IDR is not supported by default
        // we need to divide by 100 to get normal amount.
        if ($this->getCurrency() === 'IDR') {
            $amountInteger /= 100;
        }

        $data = array(
            'payment_type' => 'vtweb',
            'vtweb' => $this->getVtwebConfiguration(),
            'transaction_details' => array(
                'order_id' => $this->getTransactionId(),
                'gross_amount' => $amountInteger,
            ),
            'customer_details' => array(
                'first_name' => $this->getCard()->getFirstName(),
                'last_name' => $this->getCard()->getLastName(),
                'email' => $this->getCard()->getEmail(),
                'phone' => $this->getCard()->getBillingPhone(),
                'billing_address' => array(
                    'first_name' => $this->getCard()->getFirstName(),
                    'last_name'  => $this->getCard()->getLastName(),
                    'address' => $this->getCard()->getBillingAddress1(),
                    'city' => $this->getCard()->getBillingCity(),
                    'postal_code' => $this->getCard()->getBillingPostcode(),
                    'phone' => $this->getCard()->getBillingPhone(),
                    'country_code' => $this->getCard()->getBillingCountry(),
                ),
                'shipping_address' => array(
                    'address' => $this->getCard()->getShippingAddress1(),
                    'city' => $this->getCard()->getShippingCity(),
                    'postal_code' => $this->getCard()->getShippingPostcode(),
                    'phone' => $this->getCard()->getShippingPhone(),
                    'country_code' => $this->getCard()->getShippingCountry(),
                ),
            ),
        );

        $dataStr = json_encode($data);

        return $dataStr;
    }

    public function getEndpoint()
    {
        return $this->getBaseUrl().'/charge';
    }
}
