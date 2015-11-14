<?php
	session_start();
	if(!isset($_SESSION['USERNAME'])){
		header("location:login.php");
	}

?>

<html>
	<head>
		<title>Equipment</title>
		<link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/materialize.min.css">
		
        <script>var userId = <?php echo $_SESSION['USER_ID']; ?>;</script>
	</head>
	<body>
        <header></header>
        <main>
            <div class="row">
                
                <div class="col s12 m4 13">
                    
                </div>
                
                <div class="col s12 m8 19">
                    
                </div>
            </div>
        </main>
        <footer></footer>
        
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
                    <a href="equipment_page.php" style="text-decoration:none"><div class="menuitem"><b>Equipment</b></div></a>
					<a href="labpage.php" style="text-decoration: none;"><div class="menuitem">Labs</div></a>
					<a href="suppliers_page.php" style="text-decoration:none"><div class="menuitem">Supplier</div></a>
					<a href="history.php" style="text-decoration: none;"><div class="menuitem">History</div></a>
					<a href="logout.php" style="text-decoration: none;"><div class="menuitem">Logout</div></a>
				</td>
				<td id="content">
					<div id="divPageMenu">
					<div style="float:left">
						<span id="change" class="menuitem"  onclick="loadAddEquipmentForm()">Add Equipment</span>
						<span class="menuitem" id="edit" onclick="loadEditEquipmentForm()" hidden="true">Edit</span> 
						<span class="menuitem" onclick="deleteEquip()"id="deleteE" hidden="true">Delete</span>
						<span class="menuitem" id="exit" onclick="exitView()" hidden="true">Exit</span>
					</div>
                        <div align="right">
						<input type="text" placeholder="Search" id="txtSearch"/>
						<span id="search" class="menuitem" onclick="search()">search</span>
						</div>
					</div>
					<div id="divStatus" class="status">
						status message
					</div>
					<div id="divContent">
						<div id="contentSpace"></div>
						<table id="tableExample" class="reportTable" width="100%">
                            <?php

include_once("../application/models/equipment.php");
$obj= new equipment();
$obj->display_equipment();
//$lab= new equipment();
	echo"<tr class='header'>
		<td>Serial Number</td>
		<td>Equipment Name</td>
		<td>Lab</td>
		<td>Date Purchased</td>
	    </tr>";

    $count=0;
	while ($row=$obj->fetch()) {
        if ($count==0) {
            $color = 'row1';
            $count=1;
        }
        else {
            $color = 'row2';
            $count=0;
        }
		echo "<tr onclick='loadViewEquip($row[equipment_id])' class=$color style='cursor:pointer'><td>$row[serial_number]</td>";
		echo "<td>$row[equipment_name]</td>";
		echo "<td>$row[lab_id]</td>";
		echo "<td>$row[date_purchased]</td></tr>";
	}
				
?>
					
		</table>
                        </div>
                    <script src="jquery-2.1.3.js"></script>
        <script src="js/equipment_page.js"></script>
                    <script src="js/materialize.min.js"></script>
	</body>
</html>	