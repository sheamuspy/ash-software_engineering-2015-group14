<?php

	$server = "localhost";
	$username = "csashesi_sy16";
	$password="1lov3j3su5";
	$database="csashesi_sheamus-yebisi";
	$link;

	$link = mysql_connect($server,$username,$password);

	if($link==false){
		echo "Sorry we failed to connect to the server";
		exit();
	}

	if(!mysql_select_db($database)){
		echo "Sorry we could not connect to the database";
		exit();
	}

	function find($data){

		$query="SELECT product_id, product_name, description FROM webtech_practical2_products WHERE product_name LIKE '%$data%'";

		$result = mysql_query($query);

		if($result==false){
			mysql_error();
			exit();
		}
		return $result;
	}

	function add($col1,$col2){

		$query = "INSERT INTO webtech_practical2_products (product_name, description, manufacturer_id)
									VALUES ('$col1','$col2' ,'1')";

		$result = mysql_query($query);

		return $result;
	}

	function update($id, $col1, $col2){

		$query = "	UPDATE webtech_practical2_products SET
						product_name = '$col1',
						description = '$col2'
						WHERE product_id = '$id'";

		$result = mysql_query($query);

		return $result;
	}

	function delete($id){

		$query="DELETE FROM webtech_practical2_products WHERE product_id = $id";

		$result = mysql_query($query);

		return $result;
	}

?>