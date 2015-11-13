<?php
	include_once("adb.php");
	class equipment extends adb{
		
		function equipment(){
			
		}
		
		function add_equipment($sn, $in, $name, $lid, $dp, $sid, $desc){
			$str_query="INSERT INTO webtech_project_equipment SET
							serial_number='$sn', 
							inventory_number='$in', 
							equipment_name='$name',
							lab_id=$lid,
							date_purchased='$dp',
							supplier_id=$sid,
							description='$desc'";
			return $this->query($str_query);
		}
		function delete_equipment($eid) {
			$str_query="delete from webtech_project_equipment where equipment_id=$eid";
			return $this->query($str_query);
		}
		function edit_equipment($eid, $sn, $in, $name, $lid, $dp, $sid, $desc){
			$str_query="UPDATE webtech_project_equipment SET
							serial_number='$sn',
							inventory_number='$in',
							equipment_name='$name',
							lab_id=$lid,
							date_purchased='$dp',
							supplier_id=$sid,
							description='$desc'
							WHERE webtech_project_equipment.equipment_id=$eid";
			return $this->query($str_query);
		}
		function display_equipment() {
			$str_query = "select equipment_id, serial_number, equipment_name, lab_id, date_purchased from webtech_project_equipment"; 
			return $this->query($str_query);
		}
        function view_equipment($eid) {
            $str_query = "SELECT * FROM webtech_project_equipment INNER JOIN webtech_project_labs ON webtech_project_equipment.lab_id=webtech_project_labs.lab_id JOIN webtech_project_supplier ON webtech_project_equipment.supplier_id=webtech_project_supplier.supplier_id WHERE webtech_project_equipment.equipment_id=$eid";
            return $this->query($str_query);
        }
        function display_labname($lid) {
            $str_query = "select lab_name from webtech_project_labs wl left join webtech_project_equipment we on we.lab_id=wl.lab_id where we.course_id=$lid";
            return $this->query($str_query);
        }
		function get_most_recently_added(){
			$str_query = "SELECT equipment_id FROM webtech_project_equipment
				ORDER BY equipment_id DESC
				LIMIT 1";
				if(!$this->query($str_query)){
					return false;
				}else{
					return $this->fetch();
				}
		}
		function search_equipment($equipment){
			$str_query = "SELECT * FROM webtech_project_equipment INNER JOIN webtech_project_supplier ON 
							webtech_project_supplier.supplier_id = webtech_project_equipment.supplier_id INNER JOIN 
							webtech_project_labs ON 
							webtech_project_equipment.lab_id = webtech_project_labs.lab_id WHERE
							webtech_project_equipment.equipment_name LIKE'$equipment%'";
			return $this->query($str_query);
		}
	}
        
?>