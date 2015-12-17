<?php
/**
 * author: Rahila Sule
 * description: A class to test equipment functions. Currently tests add equipment method and checkout method
 */
include_once("equipment.php");
class EquipmentTest extends PHPUnit_Framework_TestCase
{
	//test add equipment. checks if equipment is added
	public function testAdd()
	{
		$obj = new equipment();
		$this->assertEquals(7,count($obj->add_equipment(11800, 266, "Pipette", 2, "2015-07-14", 2, "for transferring or measuring out small quantities of liquid")));
	}

	//test checkout equipment
	public function testcheckOut()
	{
		$obj = new equipment();
		$this->assertEquals(2,count($obj->checkout_equipment(2,20)));
	}
}