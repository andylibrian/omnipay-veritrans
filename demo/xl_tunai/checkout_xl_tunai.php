<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

$serverKey = trim(file_get_contents(__DIR__ . '/../vt_serverkey.txt'));

$gateway = Omnipay::create('Veritrans_VTDirect_XLTunai');
$gateway->setServerKey($serverKey);
$gateway->setEnvironment('sandbox');

$data = array(
    'transactionId' => mt_rand(1, 99999999),
    'amount'        => '100000.00',
    'card'          => new CreditCard(),
    'currency'      => 'IDR',
);

$response = $gateway->authorize($data)->send();

if ($response->isSuccessful()) {
    // payment success, display ID and order ID
    var_dump($response->getData());
    echo 'Transaksi Sukses';
} elseif ($response->isRedirect()) {
    // redirect to offsite payment gateway
    $response->redirect();
} else {
    echo $response->getMessage();
}
