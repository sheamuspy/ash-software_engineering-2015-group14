
<?php
	include("suppliers.php");

	$supplier_id=$_REQUEST['supplier_id'];

	$obj = new suppliers();
	$obj->get_supplier($supplier_id);
	$row=$obj->fetch();
	echo "<table>";
	echo "<td>Lab Name : </td><td>".$row['supplier_name']."</td></tr>";
	echo "<tr><td>Department Head :</td><td> ".$row['address']."</td></tr>";
	echo "<tr><td>Location : </td><td>".$row['phone_number']."</td></tr>";
	echo "</table>";
?>
