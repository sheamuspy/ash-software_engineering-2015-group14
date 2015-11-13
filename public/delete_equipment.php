<html>
	<head>
		<title>Delete Equipment</title>
		<link rel="stylesheet" href="css/style.css">
		<script>
		</script>
	</head>
	<body>
	<form method="Get" action="page.php">
		<div>Equipment Name: <input type="text" name="en" size="30"></div>
        <div>Serial Number: <input type="text" name="sn" size="30"></div>
        <div>Inventory Number: <input type="text" name="in" size="30"></div>
		<div>Lab ID:<select name="lid">
					<option value="0">--Select Lab--</option>
                    <option value="1">1</option>
                    <option value="2">2</option></select></div>
		<div>Date Purchased: <input type="date" name="dp" size="30"></div>
		<div>Supplier ID: <select name="sid">
						<option value="0">--Select Supplier--</option>
                        <option value="1">1</option>
            <option value="2">2</option></select></div>
		<div>Description: <div><textarea name="ed" cols="30" rows="5"></textarea></div>
		<input type="submit" name="do" value="Delete">
	</form>
	
	<?php
		if(isset($_REQUEST['en'])){
			include("equipment.php");
			$obj = new equipment();
			$name=$_REQUEST['en'];
            $serial_number=$_REQUEST['sn'];
            $inventory_number=$_REQUEST['in'];
			$lab_id=$_REQUEST['lid'];
			$date_purchased=$_REQUEST['dp'];
			$supplier_id=$_REQUEST['sid'];
			$description=$_REQUEST['ed'];
		
			if(!$obj->delete_equipment($serial_number, $inventory_number, $name, $lab_id, $date_purchased, $supplier_id, $description)) {
				echo mysql_error();
                echo "Error Deleting Equipment";
                
			}else{
				echo "$name successfully deleted from inventory";
			}	
		}
		?>
	</body>
</html>