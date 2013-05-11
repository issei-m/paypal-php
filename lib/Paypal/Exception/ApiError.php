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
 * Handles a something wrong with result from PayPal.
 *
 * @package    PayPal
 * @subpackage Exception
 * @author     Issei Murasawa
 */
final class Paypal_Exception_ApiError extends Paypal_Exception
{
    protected
        $level,
        $shortMessage;

    /**
     * Constructor.
     *
     * @param integer   $code           The internal exception code
     * @param string    $level          The severity of error
     * @param string    $message        The internal exception message
     * @param string    $shortMessage   The short text message
     * @param Exception $previous       The previous exception
     *
     */
    public function __construct($code = 0, $level = null, $message = null, $shortMessage = null, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->level = $level;
        $this->shortMessage = $shortMessage;
    }

	/**
	 * Returns the level.
     *
	 * @return string
	 */
	public function getLevel()
    {
        return $this->level;
    }

	/**
	 * Returns the short text message.
     *
	 * @return string
	 */
	public function getShortMessage()
    {
        return $this->shortMessage;
    }
}
