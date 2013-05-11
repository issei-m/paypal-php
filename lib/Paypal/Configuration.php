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
 * Configuration of PayPal API.
 *
 * @package    PayPal
 * @subpackage Configuration
 * @link       https://cms.paypal.com/cms_content/JP/ja_JP/files/developer/PaymentsPlus.pdf
 * @author     Issei Murasawa
 */
final class Paypal_Configuration
{
    private
        $version,
        $sandbox,
        $username,
        $password,
        $signature;

    /**
     * Consructor.
     *
     * @param string  $version The version of API.
     * @param boolean $sandbox Whether to use the sandbox or not
     */
    public function __construct($version, $sandbox = false)
    {
        $this->version = $version;
        $this->sandbox = (boolean) $sandbox;
    }

    /**
     * Returns the version.
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Returns true if to use the sandbox.
     *
     * @return boolean
     */
    public function isSandbox()
    {
        return $this->sandbox;
    }

    /**
     * Returns the username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the username.
     *
     * @param  string $username
     * @return Paypal_Configuration
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Returns the password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the password.
     *
     * @param  string $password
     * @return Paypal_Configuration
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returns the signature.
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Sets the signature.
     *
     * @param  string $signature
     * @return Paypal_Configuration
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }
}
