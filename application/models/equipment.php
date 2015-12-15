<?php
/**
 * author: Rahila Sule
 * description: A class to manage(add, edit etc) all equipment. This class communicates(queries) with DB
 */
include_once("adb.php");
class equipment extends adb
{
	//constructor for equipment class
    function equipment()
    {
			
	}
		
	//adds an equipment to database	
	function add_equipment($sn, $in, $name, $lid, $dp, $sid, $desc)
	{
	    $str_query = "INSERT INTO webtech_project_equipment SET serial_number ='$sn', 
		    inventory_number = '$in', equipment_name = '$name', lab_id = $lid, 
		    date_purchased = '$dp', supplier_id = $sid, description = '$desc'";
		return $this->query($str_query);
	}

	/*  delete equipment method has been taken out because the group decided that 
		equipment should not be completely deleted from the database
	function delete_equipment($eid) 
	{
		$str_query="delete from webtech_project_equipment where equipment_id=$eid";
		return $this->query($str_query);
	}
	*/

	//query that edits equipment details in database
	function edit_equipment($eid, $sn, $in, $name, $lid, $dp, $sid, $desc)
	{
		//query that updates an equipment in database
		$str_query = "UPDATE webtech_project_equipment SET serial_number ='$sn',
		    inventory_number = '$in', equipment_name = '$name', lab_id = $lid,
			date_purchased = '$dp', supplier_id = $sid, description = '$desc' 
			WHERE webtech_project_equipment.equipment_id = $eid";
		return $this->query($str_query);
	}

	//query that checks out an equipment by recording details of who borrowed, what was borrowed and when it was borrowed
	function checkout_equipment($uid, $eid)
	{
		$str_query = "INSERT INTO webtech_project_checkout SET user_id = $uid, equipment_id = $eid,
			checkout_date = CURDATE(), checkin_date =''";
		return $this->query($str_query);
	}

	//this is a helper method for the checkout equipment method above. It sets equipment as unavailable
	function set_available($eid)
	{
		$str_query = "UPDATE webtech_project_equipment SET available = 0
			WHERE webtech_project_equipment.equipment_id = $eid";
		return $this->query($str_query);
	}

	//this is a function that displays details of an equipment
	function display_equipment() 
	{
		$str_query = "SELECT equipment_id, serial_number, equipment_name, lab_id, date_purchased, 
			available FROM webtech_project_equipment"; 
		return $this->query($str_query);
	}

	/*this is a function that enables an equipment to be viewed. It simply selects
	* all details about an equipment and also selects details about the lab and supplier of 
	* the equipment
	*/
    function view_equipment($eid) 
    {
        $str_query = "SELECT * FROM webtech_project_equipment INNER JOIN webtech_project_labs
             ON webtech_project_equipment.lab_id=webtech_project_labs.lab_id JOIN webtech_project_supplier
             ON webtech_project_equipment.supplier_id=webtech_project_supplier.supplier_id
             WHERE webtech_project_equipment.equipment_id=$eid";
        return $this->query($str_query);
    }

    //this is a helper function that queries database for lab name
    function display_labname($lid) 
    {
        $str_query = "SELECT lab_name from webtech_project_labs AS wl LEFT JOIN
            webtech_project_equipment AS we ON we.lab_id=wl.lab_id WHERE we.course_id=$lid";
        return $this->query($str_query);
    }

    /*this is a function that selects equipment and enables them to be arranged in order
    *of most recently added equipment
    */
	function get_most_recently_added()
	{
	    $str_query = "SELECT equipment_id FROM webtech_project_equipment
				ORDER BY equipment_id DESC LIMIT 1";

				if (!$this->query($str_query)) {
					return false;
				} else {
					return $this->fetch();
				}
	}

	/*this is a function that queries databse for an equipment and its details provided some
	* or all of the equipment name
	*/
    function search_equipment($equipment)
    {
        $str_query = "SELECT * FROM webtech_project_equipment INNER JOIN webtech_project_supplier ON 
	        webtech_project_supplier.supplier_id = webtech_project_equipment.supplier_id INNER JOIN 
		    webtech_project_labs ON webtech_project_equipment.lab_id = webtech_project_labs.lab_id 
		    WHERE webtech_project_equipment.equipment_name LIKE'$equipment%'";
	return $this->query($str_query);
    }

}