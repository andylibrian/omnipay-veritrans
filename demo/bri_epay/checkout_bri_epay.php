<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

$serverKey = trim(file_get_contents(__DIR__ . '/../vt_serverkey.txt'));

$gateway = Omnipay::create('Veritrans_VTDirect_BRIEpay');
$gateway->setServerKey($serverKey);
$gateway->setEnvironment('sandbox');

$data = array(
    'transactionId' => mt_rand(1, 99999999),
    'amount'        => $_POST['amount'] . '.00',
    'card'          => new CreditCard(),
    'currency'      => 'IDR',
);

$response = $gateway->authorize($data)->send();

if ($response->isSuccessful()) {
    // payment success, update database
    var_dump($successful);
    var_dump($response);
} elseif ($response->isRedirect()) {
    // redirect to offsite payment gateway
    $response->redirect();
} else {
    var_dump('else');
    echo $response->getMessage();
}
