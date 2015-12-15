<?php

/**
 * This is the class file for the checkout.php models tests.
 *
 * This file tests all the neccessary functions in the checkout.php class.
 *
 * PHP version 5.6
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category Tests
 * @package EIMS.tests
 * @author Sheamus Punch Yebisi
 */

/**
 * This is the Checkout file
 *
 * This file tests the methods of the checkout class file
 *
 * @category Tests
 * @package EIMS.tests
 * @author Sheamus Punch Yebisi
 */
class CheckoutTest extends PHPUnit_Framework_TestCase
{
    /**
     * This method test if the checkout.php class method get_checkout_details() executes successfully.
     */
    public function testGetCheckoutDetails()
    {
        include '../application/models/checkout.php';
        $obj = new checkout();
        $this -> assertTrue($obj->get_checkout_details());
    }
}
