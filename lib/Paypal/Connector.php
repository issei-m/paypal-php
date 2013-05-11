<?php

/*
 * This file is part of the Paypal package.
 *
 * (c) Issei Murasawa <issei.m7@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Makes a request and sends to PayPal NVP interface.
 *
 * @package    PayPal
 * @subpackage Connector
 * @link       https://cms.paypal.com/cms_content/JP/ja_JP/files/developer/nvp_GetTransactionDetails_php.txt
 * @author     Issei Murasawa
 */
class Paypal_Connector
{
    const
        ENDPOINT_URL_PRODUCTION = 'https://api-3t.paypal.com/nvp',
        ENDPOINT_URL_SANDBOX    = 'https://api-3t.sandbox.paypal.com/nvp';

    /** @var Paypal_Configuration */
    private $configuration;

    /** @var Paypal_ClientInterface */
    private $client;

    /**
     * Constructor.
     *
     * @param Paypal_ClientInterface $client
     * @param Paypal_Configuration   $configuration
     */
    public function __construct(Paypal_Configuration $configuration, Paypal_ClientInterface $client = null)
    {
        $this->configuration = $configuration;
        $this->client = $client ? $client : new Paypal_Client_Curl();
    }

    /**
     * Returns the endpoint url to send a request.
     *
     * @return string
     */
    public function getEndpointUrl()
    {
        return $this->configuration->isSandbox()
            ? self::ENDPOINT_URL_SANDBOX
            : self::ENDPOINT_URL_PRODUCTION;
    }

    /**
     * Calls the interface of API with method, parameters.
     *
     * @param  string $method The method name
     * @param  array  $params The parameters
     * @return array
     *
     * @throws Paypal_Exception_ApiError When there is something wrong with result
     */
    public function call($method, array $params = array())
    {
        $systemParams = array(
            'METHOD'    => $method,
            'VERSION'   => $this->configuration->getVersion(),
            'PWD'       => $this->configuration->getPassword(),
            'USER'      => $this->configuration->getUsername(),
            'SIGNATURE' => $this->configuration->getSignature(),
        );

        // keys are bust be uppercase
        $upperKeys = array_map('strtoupper', array_keys($params));
        $params = array_combine($upperKeys, array_values($params));

        $result = $this->client->sendRequest($this->getEndpointUrl(), array_merge($systemParams, $params));
        $data = array();
        parse_str($result, $data);

        if ('Failure' === $data['ACK']) {
            $code         = (int) $data['L_ERRORCODE0'];
            $level        = $data['L_SEVERITYCODE0'];
            $message      = $data['L_LONGMESSAGE0'];
            $shortMessage = $data['L_SHORTMESSAGE0'];

            throw new Paypal_Exception_ApiError($code, $level, $message, $shortMessage);
        }

        return $data;
    }

    /**
     * Returns the configuration.
     *
     * @return Paypal_Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Returns the client.
     *
     * @return Paypal_Configuration
     */
    public function getClient()
    {
        return $this->client;
    }
}
