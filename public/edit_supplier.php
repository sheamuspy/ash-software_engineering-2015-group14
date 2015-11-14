<?php
		if(isset($_REQUEST['sn'])){
		include_once("../application/models/suppliers.php");
		$obj1 = new suppliers();
		$id=$_REQUEST['id'];
		$name=$_REQUEST['sn'];
		$address=$_REQUEST['sa'];
		$number=$_REQUEST['pn'];
		$obj1->edit_supplier($id,$name,$address,$number);
		header('Location: suppliers_page.php');
		}
	?>
<html>
	<head> 
		<title> Edit Lab</title>
		<link rel="stylesheet" href="style.css">
		<script>

		</script>
	</head>

	<body>
		<?php
		if(isset($_REQUEST['supplier_id'])){
			require_once("../application/models/suppliers.php");
			$supplier_id = $_REQUEST['supplier_id'];
			$obj = new suppliers();
			$obj->get_supplier($supplier_id);
			$row= $obj->fetch();

			$supplier_name=$row['supplier_name'];
			$address=$row['address'];
			$number=$row['phone_number'];
		}
		?>
		<form method="get" action="edit_supplier.php">
			<table>
				<tr>
					<td><input type="hidden" name="id" value="<?php echo $supplier_id; ?>"></td>
				</tr>
				<tr>
					<td>Supplier's Name :</td><td><input type="text" required name="sn" value="<?php echo $supplier_name; ?>"></td>
				</tr>
				<tr>
					<td>Supplier's address</td>
					
					<td><input type="text" name="sa" required value="<?php echo $address; ?>"></td>
				</tr>
				<tr>
					<td>Phone number:</td><td><input type="text" required name="pn" value="<?php echo $number; ?>"></td>
					
				</tr>
				<tr>
					<td></td><td><input type="submit" name="do" value="Update"></td>
				</tr>
					
			</table>
		</form>
	
	</body>
</html>