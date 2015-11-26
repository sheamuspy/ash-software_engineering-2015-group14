/**
* A method to search equipment in the database
*
* The file contains the sql statements to search for an equipment in the inventory database
*
* LICENSE:
*
* @Category Zend
* @Package
* @Copyright
* @license
* @version 1.0.1
*/

<html>
    <head>
        <meta charset="UTF-8">
		<title></title>
	</head>
	<body>
		<a href="add_equipment.php">Click to Add Product</a>
		<?php
    //connect to the inventory databse
		$server = "localhost";
		$username="root";
		$password="";
		$database = "engineering_inventory";

		$link = mysql_connect($server, $username, $password);
		if (! $link) {
			echo "Error connecting to server ::".mysql_error();
			exit();
		}
		if (! mysql_select_db($database, $link)) {
			echo "error connecting to database ::".mysql_error();
			exit();
		}

		$searchText = "";
		if (isset($_REQUEST['st'])) {
			$searchText = $_REQUEST['st'];
		}
    //form for user input
		echo "<form action='search_equipment.php' method='GET'>"
			."<input type='text' name='st' value='$searchText'>"
			."<input type='submit' value='search'>"
			. "</form>";
    //sql statement to query the database
			$query = "Select equipment_id, equipment_name, lab_id, supplier_id From webtech_project_equipment where equipment_name like '%$searchText%'";

			$result = mysql_query($query);
		echo	"<table border = '1'>";
		echo	"<tr>";
		echo	"<td>Equipment Name</td><td>Equipment ID</td><td>Date of Purchase</td><td>Lab ID</td>";
		echo	"</tr>";
		echo "<ol>";
		while ($row= mysql_fetch_assoc($result)) {
				echo "<tr><td><li><a href = 'view.php?pid=".$row['equipment_id']."'>".$row['equipment_name']."</a></td>";
				echo "<td><a href = 'view.php?pid=".$row['product_id']."'>".$row['price']."</a></td>";
				echo "<td><a href = 'edit_equipment.php?pid=".$row['product_id']."'>".'[edit]'."</a></td>";
				//echo " ";
				echo "<td><a href = 'deletepage.php?pid=".$row['product_id']."'>".'[delete]'."</a></li></td></tr>";
		}
		echo "</ol>";
		echo "</table>";
		mysql_close($link);
		?>
	</body>
</html>
