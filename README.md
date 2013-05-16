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

// 第2引数をtrueでSANDBOXになります。
$configuration = new Paypal_Configuration('Api version', true);
$configuration->setUsername('Your user id')
              ->setPassword('Your password')
              ->setSignature('Your signature');

$paypal = new Paypal_Connector($configuration);

$transactionData = $paypal->call('GetTransactionDetails', array(
    'TransactionID' => 'XXX',
));
```

symfony 1.4 系で使用する
------------------------

lib/payment に`sfPaypal.class.php` (以下参照) を配置。  
https://gist.github.com/issei-m/5589593

settings.yml に以下追記。

``` yaml
paypal:
  version: xxx
  username: xxx
  password: xxx
  signature: xxx
```

使い方

``` php
$paypal = sfPaypal::getInstance();
$transactionData = $paypal->call('GetTransactionDetails', array(
    'TransactionID' => 'XXXXX',
));
```
