<html>
	<head>
		<title>Add Equipment</title>
		<link rel="stylesheet" href="css/style.css">
		<script>
			
		</script>
	</head>
	<body>
	    <!-- Modal Trigger -->
	    <a class="modal-trigger waves-effect waves-light btn" href="#addmodal">Add Equipment</a>

	  <!-- Modal Structure -->
	  <div id="addmodal" class="modal modal-fixed-footer">
	    <div class="modal-content">
	      <h4>Add Equipment</h4>
	      <p>A bunch of text</p>
	    </div>
	    <div class="modal-footer">
	      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
	    </div>
      </div>
		<table>
			<tr>
				<td>Equipment Name: </td><td><input type="text" id="en" required></td>
			</tr>
			<tr>
				<td>Serial Number: </td><td><input type="text" id="sn" required></td>
			</tr>
			<tr>
				<td>Inventory Number: </td><td><input type="text" id="inv" size="30" required></td>
			</tr>
				<td>Lab ID:</td><td><select id="lid">
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
			<tr>
				<td>Date Purchased:</td><td> <input type="date" class="datepicker" id="dp" size="30" required></td>
			</tr>
			<tr>
				<td>Supplier ID:</td><td> <select id="sid">
								<option value="0">--Select Supplier--</option>
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
				<td>Description:</td> <td><textarea id="ed" cols="30" rows="5"required></textarea></td>
			<tr><td>
				</td><td><input type="submit" onclick="addEquipment()" value="ADD"></td>
			</tr>
		</table>
	</body>
</html>