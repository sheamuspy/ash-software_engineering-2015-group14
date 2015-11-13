<?php

include_once("equipment.php");
$obj= new equipment();
$obj->display_equipment();
$lab= new equipment();
	echo"<tr class='header'>
		<td>Serial Number</td>
		<td>Equipment Name</td>
		<td>Lab</td>
		<td>Date Purchased</td>
	    </tr>";

    $count=0;
	while ($row=$obj->fetch()) {
        if ($count==0) {
            $color = 'row2';
            $count=1;
        }
        else {
            $color = 'row1';
            $count=0;
        }
		echo "<tr class=$color onclick='viewEquip($row[equipment_id])'><td>$row[serial_number]</td>";
		echo "<td>$row[equipment_name]</td>";
		echo "<td>$row[lab_id]</td>";
		echo "<td>$row[date_purchased]</td></tr>";
	}
				
?>