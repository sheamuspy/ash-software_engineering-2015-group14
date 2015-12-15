<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CheckoutTest extends PHPUnit_Framework_TestCase{

    /**
     * @uses /application/models/equipment An equipment class
     */
    public function testGetCheckoutDetails() {
        include '../application/models/checkout.php';
        $obj = new checkout();
        $this -> assertTrue($obj->get_checkout_details());
    }
}
