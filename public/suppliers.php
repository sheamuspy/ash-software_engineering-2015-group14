<?php
	include_once("adb.php");
	
	class suppliers extends adb{
		
		function suppliers(){}
		
		function get_suppliers(){
			$str_query="SELECT * FROM webtech_project_supplier";
			return $this->query($str_query);
		}
		
		function add_supplier($name, $address, $number){
			$str_query="INSERT INTO webtech_project_supplier SET
							supplier_name='$name', address='$address', phone_number='$number'";
		return $this->query($str_query);
		}

		function search_suppliers($search_text){
			$str_query="SELECT * FROM webtech_project_supplier
					WHERE supplier_name LIKE '%$search_text%' ";
					return $this->query($str_query);
		}

		function get_supplier($id){
			$str_query="SELECT * FROM
						webtech_project_supplier WHERE supplier_id=$id";
						return $this->query($str_query);
		}

		function edit_supplier($id, $name, $address, $number){
			$str_query="UPDATE webtech_project_supplier SET supplier_name='$name', address='$address', phone_number='$number'
							WHERE supplier_id=$id ";
			return $this->query($str_query);					
		}

		function delete_supplier($id){
			$str_query="DELETE FROM webtech_project_supplier WHERE supplier_id=$id ";
			return $this->query($str_query);
		}

		function get_all_supplier(){
			$str_query="SELECT * FROM
						webtech_project_supplier";
			return $this->query($str_query);
		}
	
	}
	
?>