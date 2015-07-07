<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

$serverKey = trim(file_get_contents(__DIR__ . '/../vt_serverkey.txt'));

$gateway = Omnipay::create('Veritrans_VTDirect_TCash');
$gateway->setServerKey($serverKey);
$gateway->setEnvironment('sandbox');

$data = array(
    'transactionId' => mt_rand(1, 99999999),
    'amount'        => '100000.00',
    'card'          => new CreditCard(),
    'currency'      => 'IDR',
    'telkomsel_cash' => [
        'customer' => $_POST['token-number'],
        'promo'    => false,
        'is_reversal' => 0,
    ],
);

$response = $gateway->authorize($data)->send();

if ($response->isSuccessful()) {
    // payment success, update database
    echo 'Transaksi Sukses';
} elseif ($response->isRedirect()) {
    // redirect to offsite payment gateway
    $response->redirect();
} else {
    echo $response->getMessage();
}
