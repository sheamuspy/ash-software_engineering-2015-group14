<?php
		if(isset($_REQUEST['ln'])){
		include_once("../application/models/labs.php");
		$obj1 = new labs();$id=$_REQUEST['id'];
		$name=$_REQUEST['ln'];
		$dept_head=$_REQUEST['dh'];
		$loc=$_REQUEST['ll'];
		$obj1->edit_lab($id,$name,$dept_head,$loc);
		header('Location: labpage.php');
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
		if(isset($_REQUEST['lab_id'])){
			require_once("../application/models/labs.php");
			$lab_id = $_REQUEST['lab_id'];
			$obj = new labs();
			$obj->get_lab($lab_id);
			$row= $obj->fetch();

			$labname=$row['lab_name'];
			$dhead=$row['department_head'];
			$loc=$row['lab_location'];
		}
		?>
		<form method="get" action="editlab.php">
			<table>
				<tr>
					<td><input type="hidden" name="id" value="<?php echo $lab_id; ?>"></td>
				</tr>
				<tr>
					<td>Lab Name :</td><td><input type="text" required name="ln" value="<?php echo $labname; ?>"></td>
				</tr>
				<tr>
					<td>Department head</td>
					
					<td><input type="text" name="dh" required value="<?php echo $dhead; ?>"></td>
				</tr>
				<tr>
					<td>Location:</td><td><input type="text" required name="ll" value="<?php echo $loc; ?>"></td>
					
				</tr>
				<tr>
					<td></td><td><input type="submit" name="do" value="Update"></td>
				</tr>
					
			</table>
		</form>
	
	</body>
</html>