<?php

require_once dirname(__FILE__) . '/../bootstrap.php';

class Paypal_ConfigurationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider configurationProvider
     */
    public function testConstructor($configuration)
    {
        $this->assertEquals('50.0', $configuration->getVersion());
        $this->assertFalse($configuration->isSandbox());

        $configuration = new Paypal_Configuration('60.0', true);
        $this->assertEquals('60.0', $configuration->getVersion());
        $this->assertTrue($configuration->isSandbox());
    }

    /**
     * @dataProvider configurationProvider
     */
    public function testUsernameAccessor($configuration)
    {
        $this->assertNull($configuration->getUsername());

        $configuration->setUsername('username');
        $this->assertEquals('username', $configuration->getUsername());
    }

    /**
     * @dataProvider configurationProvider
     */
    public function testPasswordAccessor($configuration)
    {
        $this->assertNull($configuration->getPassword());

        $configuration->setPassword('password');
        $this->assertEquals('password', $configuration->getPassword());
    }

    /**
     * @dataProvider configurationProvider
     */
    public function testSignatureAccessor($configuration)
    {
        $this->assertNull($configuration->getSignature());

        $configuration->setSignature('signature');
        $this->assertEquals('signature', $configuration->getSignature());
    }

    public function configurationProvider()
    {
        return array(
            array(new Paypal_Configuration('50.0'))
        );
    }
}
