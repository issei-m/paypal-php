<?php

require_once dirname(__FILE__) . '/../../bootstrap.php';

class Paypal_Exception_ApiErrorTest extends PHPUnit_Framework_TestCase
{
    public function testOverall()
    {
        $exception = new Paypal_Exception_ApiError();
        $this->assertInstanceOf('Paypal_Exception', $exception);
        $this->assertEquals(0, $exception->getCode());
        $this->assertEmpty($exception->getMessage());

        $exception = new Paypal_Exception_ApiError('15000', 'Error', 'Long Message', 'Short Message');
        $this->assertEquals(15000, $exception->getCode());
        $this->assertEquals('Error', $exception->getLevel());
        $this->assertEquals('Long Message', $exception->getMessage());
        $this->assertEquals('Short Message', $exception->getShortMessage());
    }
}
