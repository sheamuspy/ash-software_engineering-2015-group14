<?php
		if(isset($_REQUEST['sn'])){
			include("suppliers.php");
			$obj = new suppliers();
			$name = $_REQUEST['sn'];
			$address=$_REQUEST['sa'];
			$number=$_REQUEST['pn'];
			$obj->add_supplier($name,$address,$number);
			header("Location: suppliers_page.php");
		}
		?>
<html>
	<head>
		<title>Add Lab</title>
		<link rel="stylesheet" href="style.css">                                       
		<script>
		</script>
	</head>
	<body>
		<form method="GET" action="add_supplier.php">
		<table>
		<tr>
			<td>Supplier's Name</td><td><input type="text" id="name" name="sn" required></td>
		</tr>
		
		<tr>
			<td>Supplier's address:</td><td><input type="text" id="dephead" name="sa"required></td>
		</tr>
		<tr>
			<td>Phone number:</td><td><input type="text" id="pn" name="ll"required></td>
		</tr>
		<tr>
			<td></td><td><input type="submit" name="do" value="ADD"></td>
		</tr>
			
		</table>
		</form>
	</body>
</html>