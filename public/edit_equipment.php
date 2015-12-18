<html>
	<head>
		<title>Edit Equipment</title>
		<link rel="stylesheet" href="css/style.css">
		<script>
			
		</script>
	</head>
	<body>
		<?php
			if(!isset($_REQUEST['eid'])){
				exit();
			}		
				include("../application/models/equipment.php");
				$obj = new equipment();
				$eid=$_REQUEST['eid'];		
				if(!$obj->view_equipment($eid)) {
					echo "Error Editing Equipment";
					exit();
				}else{
					$row=$obj->fetch();
				}
			?>
	
		<table>
			<tr>
			<td>Equipment Name:</td><td> <input type="text" value="<?php echo $row['equipment_name']?>" id="en"></td>
			</tr>
			<tr>
			<td>Serial Number: </td><td><input type="text" value="<?php echo $row['serial_number']?>" id="sn"></td>
			</tr>
			
			<tr>
			<td>Inventory Number:</td><td> <input type="text" value="<?php echo $row['inventory_number']?>" id="inv"></td>
			</tr>
			<tr>
			<td>Lab:</td><td><select id="lid">
						<option value="0">--Select Lab--</option>
						<?php
							include_once("../application/models/labs.php");
							$sup=new labs();
							$sup->get_all_labs();
							while($sup_row=$sup->fetch()){
								
								if($sup_row['lab_id']==$row['lab_id']){
									echo "<option value='{$sup_row['lab_id']}' selected>{$sup_row['lab_name']}</option>";
								}else{
									echo "<option value='{$sup_row['lab_id']}'>{$sup_row['lab_name']}</option>";
								}
								
							}
						?>
						</td>
			</tr>
			<tr>
			<td>Date Purchased:</td><td> <input type="date" value="<?php echo $row['date_purchased']?>" id="dp"></td>
			</tr>
			<tr>
			<td>Supplier:</td><td> <select id="sid">
							<?php
							include_once("../application/models/suppliers.php");
							$sup=new suppliers();
							$sup->get_suppliers();
							while($sup_row=$sup->fetch()){
								
								if($sup_row['supplier_id']==$row['supplier_id']){
									echo "<option value='{$sup_row['supplier_id']}' selected>{$sup_row['supplier_name']}</option>";
								}else{
									echo "<option value='{$sup_row['supplier_id']}'>{$sup_row['supplier_name']}</option>";
								}
								
							}
						?>
			</td>
			</tr>
			<tr>
			<td>Description: </td><td><textarea id="ed" cols="30" rows="5"><?php echo $row['description']?></textarea></td>
			</tr>
			<tr><td></td><td>
			<input type="submit" onclick="editEquipment()" value="Edit"></td>
			</tr>
		</table>
			
	</body>
</html>
