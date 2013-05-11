<?php

require_once dirname(__FILE__) . '/../bootstrap.php';

class Paypal_ConnectorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Paypal_Connector::__construct
     * @covers Paypal_Connector::getClient
     * @covers Paypal_Connector::getConfiguration
     * @covers Paypal_Connector::getEndpointUrl
     *
     * @dataProvider stuffProvider
     */
    public function testBasicMethods($client, $configuration)
    {
        $connector = new Paypal_Connector($client, $configuration);

        $this->assertEquals($connector->getClient(), $client);
        $this->assertEquals($connector->getConfiguration(), $configuration);

        $endpointUrl = $configuration->isSandbox()
                     ? Paypal_Connector::ENDPOINT_URL_SANDBOX
                     : Paypal_Connector::ENDPOINT_URL_PRODUCTION;

        $this->assertEquals($connector->getEndpointUrl(), $endpointUrl);
    }

    public function testCallSuccess()
    {
        $client = $this->getMock('Paypal_Client_Curl');
        $client->expects($this->once())
               ->method('sendRequest')
               ->will($this->returnValue('ACK=Success&VERSION=50'));

        $connector = new Paypal_Connector($client, new Paypal_Configuration('50.0'));

        $this->assertEquals(
            array(
                'ACK'     => 'Success',
                'VERSION' => 50,
            ),
            $connector->call('GetTransactionDetails', array('TransactionId' => '0123456789'))
        );
    }

    /**
     * @expectedException        Paypal_Exception_ApiError
     * @expectedExceptionMessage MESSAGE
     * @expectedExceptionCode    10000
     */
    public function testCallFailure()
    {
        // Failure test

        $client = $this->getMock('Paypal_Client_Curl');
        $client->expects($this->once())
               ->method('sendRequest')
               ->will($this->returnValue('ACK=Failure&VERSION=50&L_ERRORCODE0=10000&L_SHORTMESSAGE0=SHORTMESSAGE&L_LONGMESSAGE0=MESSAGE&L_SEVERITYCODE0=ERROR'));

        $connector = new Paypal_Connector($client, new Paypal_Configuration('50.0'));
        $connector->call('GetTransactionDetails', array('TransactionId' => '0123456789'));
    }

    public function stuffProvider()
    {
        return array(
            array(new Paypal_Client_Curl(), new Paypal_Configuration('50.0', true)),
            array(new Paypal_Client_Curl(), new Paypal_Configuration('50.0', false)),
        );
    }
}
