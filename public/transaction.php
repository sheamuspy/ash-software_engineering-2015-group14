<?php
	
	include("adb.php");

	class transaction extends adb{

		function transaction(){}

		function add_transaction($user_id, $equipment_id, $purpose){

			$str_query = "INSERT INTO webtech_project_transactions SET
							user_id = '$user_id',
							transaction_date = CURDATE(),
							purpose = '$purpose',
							equipment_id = '$equipment_id'";
			return $this->query($str_query);
		}

		function select_transactions(){
			$str_query = "SELECT transaction_id, user_name, equipment_name, transaction_date, purpose FROM webtech_project_transactions INNER JOIN webtech_project_users ON 
							webtech_project_users.user_id = webtech_project_transactions.user_id INNER JOIN 
							webtech_project_equipment ON 
							webtech_project_equipment.equipment_id = webtech_project_transactions.equipment_id";
			return $this->query($str_query);
		}
		
		function select_transactions_by_date($date){
			$str_query = "SELECT transaction_id, user_name, equipment_name, transaction_date, purpose FROM webtech_project_transactions INNER JOIN webtech_project_users ON 
							webtech_project_users.user_id = webtech_project_transactions.user_id INNER JOIN 
							webtech_project_equipment ON 
							webtech_project_equipment.equipment_id = webtech_project_transactions.equipment_id WHERE
							webtech_project_transactions.transaction_date='$date'";
			return $this->query($str_query);
		}

		function select_transactions_by_equipment($equipment){
			$str_query = "SELECT transaction_id, user_name, equipment_name, transaction_date, purpose FROM webtech_project_transactions INNER JOIN webtech_project_users ON 
							webtech_project_users.user_id = webtech_project_transactions.user_id INNER JOIN 
							webtech_project_equipment ON 
							webtech_project_equipment.equipment_id = webtech_project_transactions.equipment_id WHERE
							webtech_project_equipment.equipment_name LIKE'$equipment%'";
			return $this->query($str_query);
		}

		function select_transactions_by_name($username){
			$str_query = "SELECT transaction_id, user_name, equipment_name, transaction_date, purpose FROM webtech_project_transactions INNER JOIN webtech_project_users ON 
							webtech_project_users.user_id = webtech_project_transactions.user_id INNER JOIN 
							webtech_project_equipment ON 
							webtech_project_equipment.equipment_id = webtech_project_transactions.equipment_id WHERE
							webtech_project_users.user_name LIKE '$username%'";
			return $this->query($str_query);
		}
		
		function get_transaction($id){
			$str_query = "SELECT transaction_id, user_name, equipment_name, transaction_date, purpose FROM webtech_project_transactions INNER JOIN webtech_project_users ON 
							webtech_project_users.user_id = webtech_project_transactions.user_id INNER JOIN 
							webtech_project_equipment ON 
							webtech_project_equipment.equipment_id = webtech_project_transactions.equipment_id WHERE
							webtech_project_transactions.transaction_id = '$id'";
			return $this->query($str_query);
		}

	}

?>