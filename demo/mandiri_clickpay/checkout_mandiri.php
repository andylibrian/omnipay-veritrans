<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

$serverKey = trim(file_get_contents(__DIR__ . '/../vt_serverkey.txt'));

$gateway = Omnipay::create('Veritrans_VTDirect_MandiriClickpay');
$gateway->setServerKey($serverKey);
$gateway->setEnvironment('sandbox');

$data = array(
    'transactionId' => mt_rand(1, 99999999),
    'amount'        => $_POST['input2'] . '.00',
    'card'          => new CreditCard(),
    'currency'      => 'IDR',
    'mandiri_clickpay' => [
        'card_number' => $_POST['card-number'],
        'input1' => $_POST['input1'],
        'input2' => $_POST['input2'],
        'input3' => $_POST['input3'],
        'token'  => $_POST['token'],
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
