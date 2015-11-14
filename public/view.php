<?php
    include_once("../application/models/equipment.php");
    $obj= new equipment();
    $eid = $_REQUEST['id'];
    $obj->view_equipment($eid);
    $row=$obj->fetch(); 
    echo	"Serial Number :".$row['serial_number']."<br>";
    echo    "Inventory Number :".$row['inventory_number']."<br>";
    echo 	"Equipment Name :".$row['equipment_name']."<br>";
    echo 	"Lab ID :".$row['lab_id'];
    echo 	"<br/>";
    echo 	"Suplier ID : ".$row['supplier_id']."<br>";
    echo	"Description :".$row['description']."<br>";
            
    //$obj= new equipment();
?>                   


                            