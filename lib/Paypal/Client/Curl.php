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
 * Sends a request via Curl.
 *
 * @package    PayPal
 * @subpackage Client
 * @author     Issei Murasawa
 *
 * @codeCoverageIgnore
 */
class Paypal_Client_Curl implements Paypal_ClientInterface
{
    /**
     * @see Paypal_ClientInterface
     */
    public function sendRequest($url, array $params)
    {
        // Set the curl parameters.
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);

        // Turn off the server and peer verification (TrustManager Concept).
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);

        // Set the API operation, version, and API signature in the request.
        $nvpRequest = http_build_query($params);

        // Set the request as a POST FIELD for curl.
        curl_setopt($curl, CURLOPT_POSTFIELDS, $nvpRequest);

        // Get response from the server.
        $data = curl_exec($curl);

        if (false === $data) {
            $message = curl_error($curl);
            $code    = curl_errno($curl);

            throw new Paypal_Exception_Connection($message, $code);
        }

        return $data;
    }
}
