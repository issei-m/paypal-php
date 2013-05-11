PayPal API with PHP
===================

PayPal API を PHP で操作する為のクラスです。
現在 NVP インターフェースのみの対応となっています。

使い方
-----

```php
<?php

require __DIR__ . '/lib/Paypal.php';

Paypal::registerAutoloader();

$configuration = new Paypal_Configuration('Api version', true);
$configuration->setUsername('Your user id')
              ->setPassword('Your password')
              ->setSignature('Your signature');

$paypal = new Paypal_Connector($configuration);

$transactionData = $paypal->call('GetTransactionDetails', array(
    'TransactionID' => 'XXX',
));
```