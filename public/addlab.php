<?php
		if(isset($_REQUEST['ln'])){
			include("../application/labs.php");
			$obj = new labs();
			$name = $_REQUEST['ln'];
			$department_head=$_REQUEST['dh'];
			$location=$_REQUEST['ll'];
			$obj->add_lab($name,$department_head,$location);
			header("Location: labpage.php");
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
		<form method="GET" action="addlab.php">
		<table>
		<tr>
			<td>Lab Name</td><td><input type="text" id="name" name="ln"></td>
		</tr>
		
		<tr>
			<td>Department Head :</td><td><input type="text" id="dephead" name="dh"</td>
		</tr>
		<tr>
			<td>Location:</td><td><input type="text" id="loc" name="ll"></td>
		</tr>
		<tr>
			<td></td><td><input type="submit" name="do" value="ADD"></td>
		</tr>
			
		</table>
		</form>
	</body>
</html>