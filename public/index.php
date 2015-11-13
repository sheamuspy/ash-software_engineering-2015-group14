<?php
	session_start();
	if(!isset($_SESSION['USERNAME'])){
		header("location:login.php");
	}

?>
<html>
	<head>
		<title>Index</title>
		<link rel="stylesheet" href="css/style.css">
		<script>
			
		</script>
	</head>
	<body>
		<table align='center'>
			<tr>
				<td colspan="2" id="pageheader">
					<b>Ashesi Engineering Inventory</b>
				</td>
			</tr>
			<tr>
				<td id="mainnav">
					<div><?php echo $_SESSION['USERNAME']?><br> logged in</div>
					<a href="index.php" style="text-decoration:none"><div class="menuitem"><b>Home</b></div></a>
					<a href="equipment_page.php" style="text-decoration:none"><div class="menuitem">Equipment</div></a>
					<a href="labpage.php" style="text-decoration: none;"><div class="menuitem">Labs</div></a>
					<div class="menuitem">Supplier</div>
					<a href="history.php" style="text-decoration: none;"><div class="menuitem">History</div></a>
					<a href="logout.php" style="text-decoration: none;"><div class="menuitem">Logout</div></a>
				</td>
				<td id="content">
					<div id="divPageMenu">
								
					</div>
					<div id="divContent">
						
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>	