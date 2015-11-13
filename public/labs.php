<?php
include_once ("adb.php");

class labs extends adb{
	function labs(){
	}

	function add_lab($name, $dept_head, $location){
		$str_query="INSERT INTO webtech_project_labs SET
						lab_name='$name', department_head='$dept_head', lab_location='$location'";
	return $this->query($str_query);
	}

	function search_labs($search_text){
		$str_query="SELECT lab_id, lab_name, department_head, lab_location FROM webtech_project_labs
				WHERE lab_name LIKE '%$search_text%' ";
				return $this->query($str_query);
	}

	function get_lab($id){
		$str_query="SELECT lab_id, lab_name, department_head, lab_location FROM
					webtech_project_labs WHERE lab_id=$id";
					return $this->query($str_query);
	}

	function edit_lab($id, $name, $dept_head, $location){
		$str_query="UPDATE webtech_project_labs SET lab_name='$name', department_head='$dept_head', lab_location='$location'
						WHERE lab_id=$id ";
		return $this->query($str_query);					
	}

	function delete_lab($id){
		$str_query="DELETE FROM webtech_project_labs WHERE lab_id=$id ";
		return $this->query($str_query);
	}

	function get_all_labs(){
		$str_query="SELECT * FROM
					webtech_project_labs";
		return $this->query($str_query);
	}
}


?>