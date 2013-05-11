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
 * General utility class in Paypal, not to be instantiated.
 *
 * It provides the autoloader for all classes.
 *
 * @package PayPal
 * @author  Issei Murasawa
 *
 * @codeCoverageIgnore
 */
class Paypal
{
    /**
     * Registers the autoloader.
     */
    public static function registerAutoloader()
    {
        spl_autoload_register('self::loadClass');
    }

    /**
     * Handles autoloading of classes.
     *
     * @param  string $className
     * @return true if loaded, null otherwise
     */
    public static function loadClass($className)
    {
        $path = dirname(__FILE__) . DIRECTORY_SEPARATOR
              . str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        if (file_exists($path)) {
            include $path;

            return true;
        }
    }
}
