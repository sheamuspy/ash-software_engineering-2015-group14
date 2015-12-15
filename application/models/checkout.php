<?php
	include("adb.php");

	class checkout extends adb{

		function checkout(){}

        function getCheckoutDetails(){
            $str_query = "SELECT * FROM webtech_project_checkout
                            INNER JOIN webtech_project_users ON
							webtech_project_users.user_id = webtech_project_checkout.USER_ID INNER JOIN
							webtech_project_equipment ON
							webtech_project_equipment.equipment_id = webtech_project_checkout.EQUIPMENT_ID";

            return $this->query($str_query);
        }

	}

?>
