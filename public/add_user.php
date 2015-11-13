<html>
	<head></head>
	<body>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
			
			<table>
				<tr>
					<td align="left">Name:</td>
					<td><input type="text" name="name" size="50"></td>
				</tr>
				<tr>
					<td align="left">Status:</td>
					<td><textarea name="status" cols="50"></textarea></td>
				</tr>
				<tr>
					<td align="left">Contact:</td>
					<td><input type="tel" name="contact" size="50"></td>
				</tr>
				<tr>
					<td></td>
					<td align="right"><input type="submit" value="Add user"></td>
				</tr>
			</table>
			
		</form>
		<?php
			$fstatus = "1";
			if(!isset($_POST['name'])){
				exit();
			}
			include("users.php");
			$name = $_POST['name'];
			$status = $_POST['status'];
			$contact = $_POST['contact'];
			if(empty($name)|| empty($status)|| empty($contact)){
				exit();
			}

			$obj = new users();
			$obj->connect();
			if($obj->add_user($name, $status, $contact)){
				echo "added";
			}else{
				echo "failed";
			}

		?>
		
	</body>
</html> 