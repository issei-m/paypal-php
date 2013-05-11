<?php

require_once dirname(__FILE__) . '/../../bootstrap.php';

class Paypal_Exception_ConnectionTest extends PHPUnit_Framework_TestCase
{
    public function testOverall()
    {
        $exception = new Paypal_Exception();
        $this->assertInstanceOf('Paypal_Exception', $exception);
    }
}
