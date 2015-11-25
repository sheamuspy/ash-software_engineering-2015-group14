<?php
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
	    $str_query = "INSERT INTO webtech_project_equipment SET serial_number='$sn', 
		    inventory_number='$in', equipment_name='$name', lab_id=$lid, date_purchased='$dp',
			supplier_id=$sid, description='$desc'";
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

	//edits equipment in database
	function edit_equipment($eid, $sn, $in, $name, $lid, $dp, $sid, $desc)
	{
		//query that updates an equipment in database
		$str_query = "UPDATE webtech_project_equipment SET serial_number ='$sn',
		    inventory_number = '$in', equipment_name = '$name', lab_id = $lid,
			date_purchased = '$dp', supplier_id = $sid, description = '$desc' WHERE webtech_project_equipment.equipment_id = $eid";
		return $this->query($str_query);
	}

	function display_equipment() 
	{
		$str_query = "SELECT equipment_id, serial_number, equipment_name, lab_id, date_purchased
		    FROM webtech_project_equipment"; 
		return $this->query($str_query);
	}

    function view_equipment($eid) 
    {
        $str_query = "SELECT * FROM webtech_project_equipment INNER JOIN webtech_project_labs
             ON webtech_project_equipment.lab_id=webtech_project_labs.lab_id JOIN webtech_project_supplier
             ON webtech_project_equipment.supplier_id=webtech_project_supplier.supplier_id
             WHERE webtech_project_equipment.equipment_id=$eid";
        return $this->query($str_query);
    }

    function display_labname($lid) 
    {
        $str_query = "SELECT lab_name from webtech_project_labs AS wl LEFT JOIN
            webtech_project_equipment AS we ON we.lab_id=wl.lab_id WHERE we.course_id=$lid";
        return $this->query($str_query);
    }

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

    function search_equipment($equipment)
    {
        $str_query = "SELECT * FROM webtech_project_equipment INNER JOIN webtech_project_supplier ON 
	        webtech_project_supplier.supplier_id = webtech_project_equipment.supplier_id INNER JOIN 
		    webtech_project_labs ON webtech_project_equipment.lab_id = webtech_project_labs.lab_id 
		    WHERE webtech_project_equipment.equipment_name LIKE'$equipment%'";
	return $this->query($str_query);
    }
}