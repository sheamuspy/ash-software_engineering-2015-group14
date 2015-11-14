<?php
	session_start();
	if(!isset($_SESSION['USERNAME'])){
		header("location:login.php");
	}

?>
<html>
	<head>
		<title>Suppliers</title>
		<link rel="stylesheet" href="css/style.css">
		<script src="jquery-2.1.3.js"></script>
		<script src="js/suppliers_page.js"></script>
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
					<a href="index.php" style="text-decoration:none"><div class="menuitem">Home</div></a>
					<a href="equipment_page.php" style="text-decoration:none"><div class="menuitem">Equipment</div></a>
					<a href="labpage.php" style="text-decoration:none"><div class="menuitem">Labs</div></a>
					<a href="suppliers_page.php" style="text-decoration:none"><div class="menuitem"><b>Supplier</b></div></a>
					<a href="history.php" style="text-decoration: none;"><div class="menuitem">History</div></a>
					<a href="logout.php" style="text-decoration: none;"><div class="menuitem">Logout</div></a>
				</td>
				<td id="content">
					<div id="divPageMenu">
					<div style="float:left">
						<span class="menuitem" onclick="addData()">Add Supplier</span>
						<span class="menuitem" id="edit" onclick="editData()" hidden="true">Edit</span> 
						<span class="menuitem" id="deleteE" onclick="deleteData()" hidden="true">Delete</span>
						<span class="menuitem" id="exit" onclick="exitView()" hidden="true">Exit</span>
					</div>
					<div align="right">
						<input type="text" id="txtSearch" placeholder="Search for suppliers by name"/>
						<span class="menuitem" onclick="search()">search</span>
							</div>		
					</div>
					<div id="divStatus" class="status">
						status message
					</div>
					<div id="divContent">
						<div id="contentSpace"></div>
						<table id="tableExample" class="reportTable" width="100%">
							<?php
								include_once("../application/models/suppliers.php");
								$obj = new suppliers();
								$obj->get_suppliers();
								echo "<tr class='header'>
										<td>Supplier Name</td>
										<td>Supplier Address</td>
										<td>Phone Number</td>
										</tr>";
									$row_indicator = 0;
									$count=0;
								while($row=$obj->fetch()){
									if($row_indicator==0){
										$class = 'row1';
										$row_indicator = 1;
									}else{
										$class = 'row2';
										$row_indicator = 0;
									}
									$id=$row['supplier_id'];
									echo "<tr class=$class onclick='viewData($id)' style='cursor:pointer'>
									<td >{$row['supplier_name']}</td>
									<td>{$row['address']}</td>
									<td>{$row['phone_number']}</td>
									</tr>";
								}
							?>
						</table>
					</div>
				</td>
			</tr>
		</body>
</html>	