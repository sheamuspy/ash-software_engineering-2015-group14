<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class QueryTest extends PHPUnit_Framework_TestCase{

    /**
     * @uses /application/models/equipment An equipment class
     */
    public function testQuery() {
        include '../application/models/equipment.php';
        $obj = new equipment();
        $this -> assertTrue($obj->display_equipment());
    }
}
