<?php

/**
 * This is the class file for the checkout table.
 *
 * This file interfaces with the checkout table in the database, providing any necessary function that interact with this table.
 *
 * PHP version 5.6
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category ClassModels
 * @package EIMS.application.models
 * @author Sheamus Punch Yebisi
 */

include("adb.php");

/**
* This is the checkout class.
*
* This class is an interface betweeen the AJAX page and the checkout table in the database.
*
* @category ClassModels
* @package EIMS.application.models
* @author Sheamus Punch Yebisi
* @class checkout
* @extends adb
*/
class checkout extends adb
{

    /**
    * This is the default constructor.
    */
    public function checkout() {}

    /**
    * This method retrieves the history of all checkout details.
    *
    * @return boolean Defines whether the query was executed successfully.
    */
    public function get_checkout_details()
    {
        $str_query = "SELECT * FROM webtech_project_checkout
                        INNER JOIN webtech_project_users ON
                        webtech_project_users.user_id = webtech_project_checkout.USER_ID INNER JOIN
                        webtech_project_equipment ON
                        webtech_project_equipment.equipment_id = webtech_project_checkout.EQUIPMENT_ID";

        return $this->query($str_query);
    }
}
?>
