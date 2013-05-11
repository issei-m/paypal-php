<?php

require_once dirname(__FILE__) . '/../bootstrap.php';

class Paypal_ExceptionTest extends PHPUnit_Framework_TestCase
{
    public function testOverall()
    {
        $exception = new Paypal_Exception();
        $this->assertInstanceOf('Exception', $exception);
    }
}
