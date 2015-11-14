
		<?php
		    include("../application/models/labs.php");

			$lab_id=$_REQUEST['lab_id'];

			$obj = new labs();
			$obj->get_lab($lab_id);
			$row=$obj->fetch();
			echo "Lab Name : ".$row['lab_name']."<br>";
			echo "Department Head : ".$row['department_head']."<br>";
			echo "Location : ".$row['lab_location']."<br>";

		?>
