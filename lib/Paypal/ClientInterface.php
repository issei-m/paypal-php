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
 * Sends a request via an abstract Client subsystem.
 *
 * @package    PayPal
 * @subpackage Client
 * @author     Issei Murasawa
 */
interface Paypal_ClientInterface
{
    /**
     * Sends a request.
     *
     * @param  string $url
     * @param  array  $params
     * @return string
     * @throws Paypal_Exception_Connection When failed to connect
     *
     * @link   https://cms.paypal.com/cms_content/JP/ja_JP/files/developer/nvp_GetTransactionDetails_php.txt
     */
    public function sendRequest($url, array $params);
}
