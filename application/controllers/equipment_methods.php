<?php
/**
 * author: Rahila Sule
 * description: A php file containing all equipment methods. This is an ajax page
 */

//type of request
//1: add equipment
//2: edit equipment
//3: delete equipment
//4: search for equipment
//5: get last equipment
//6: checkout equipment

	if (!isset($_REQUEST['cmd'])) {
	    exit();
	}

	$cmd = $_REQUEST['cmd'];
	
	switch ($cmd) {
	
		case 1:
			add_equipment();
			break;

		case 2:
			edit_equipment();
			break;

		case 3:
			delete_equipment();
			break;

		case 4:
			search_equipment();
			break;

		case 5:
			get_last();
			break;

		case 6:
			checkout_equipment();
			break;

		default:
			break;
	}
	
	//ajax request that adds equipment
	function add_equipment()
	{
	    if (isset($_REQUEST['en'])) {
			include_once("../models/equipment.php");
			$obj = new equipment();

			if (!$obj->connect()) {
			    echo '{"result":0,"message":"Sorry we could not connect to the database."}';
			}

			$name = $_REQUEST['en'];
            $serial_number = $_REQUEST['sn'];
            $inventory_number = $_REQUEST['in'];
			$lab_id = $_REQUEST['lid'];
			$date_purchased = $_REQUEST['dp'];
			$supplier_id = $_REQUEST['sid'];
			$description = $_REQUEST['ed'];
			$user_id = $_REQUEST['uid'];
		
			if (!$obj->add_equipment($serial_number, $inventory_number, $name, $lab_id,
			     $date_purchased, $supplier_id, $description, $user_id)) {
				//return a JSON string to browser when request comes to get description
				echo '{"result":0,"message":"Sorry we could not execute the query."}';
                
			} else {
				echo '{"result":1,"message":"New equipment successfully added."}';
			}	
		}	
	}

	//ajax request that edits equipment details
	function edit_equipment() 
	{
		if (isset($_REQUEST['en'])) {
			include_once("../models/equipment.php");
			$obj = new equipment();
			//display error message if unable to connect to database
			if (!$obj->connect()) {
				echo '{"result":0,"message":"Sorry we could not connect to the database."}';
			}
			$eid =$_REQUEST['eid'];
			$name=$_REQUEST['en'];
            $serial_number=$_REQUEST['sn'];
            $inventory_number=$_REQUEST['in'];
			$lab_id=$_REQUEST['lid'];
			$date_purchased=$_REQUEST['dp'];
			$supplier_id=$_REQUEST['sid'];
			$description=$_REQUEST['ed'];
			$user_id = $_REQUEST['uid'];
		
			if(!$obj->edit_equipment($eid,$serial_number, $inventory_number, $name, $lab_id, 
				$date_purchased, $supplier_id, $description, $user_id)) {
				echo '{"result":0,"message":"Sorry we could not execute the query."}';    
			} else {				
				echo '{"result":1,"message":"Equipment successfully edited."}';
			}	
		}
		
	}
	
	/* the group decided equipment should not be deleted from database
	function delete_equipment()
	{
		include_once("../models/equipment.php");
		$obj = new equipment();
		if (!$obj->connect()) {
				echo '{"result":0,"message":"Sorry we could not connect to the database."}';
			}
			$eid =$_REQUEST['eid'];
			if(!$obj->delete_equipment($eid)) {
				echo '{"result":0,"message":"Sorry we could not execute the query."}';
                
			}else{
				echo '{"result":1,"message":"Equipment successfully deleted."}';
			}
	}
	*/

	//ajax request that searches forequipment 
	function search_equipment()
	{
	if (!isset($_REQUEST['st'])) {
	    echo '{"result":0,"message": "search did not work."}';
	}
	$search_text = $_REQUEST['st'];
	include_once("../models/equipment.php");
	$obj = new equipment();
	if (!$obj->search_equipment($search_text)) {
		echo '{"result":0,"message": "search did not work."}';
		return;
	}

	$row=$obj->fetch();
	echo '{"result":1,"equipment":[';
	$count=0;
	while ($row) {
		$count++;
		echo json_encode($row);
		$row=$obj->fetch();
		if ($row) {
			echo ",";
		}
	}
	echo '], "message":"'.$count.' results found with \"'.$search_text.'\"","numRows":'.$count.'}';
    }

    //ajax request gets last equipment
	function get_last() 
	{
		include_once("../models/equipment.php");
		$obj = new equipment();
		$obj->connect();
		$response = $obj->get_most_recently_added();
		if (!$response) {
			echo '{"result":0,"message": "search did not work."}';
			return;
		} else {
			echo '{"result":1, "response":'.$response['equipment_id'].'}';
		}
    }

    //ajax request that checks out equipment
    function checkout_equipment()
    {
    	if (isset($_REQUEST['eid'])) {
			include_once("../models/equipment.php");
			$obj = new equipment();
			if (!$obj->connect()) {
				echo '{"result":2,"message":"Sorry we could not connect to the database."}';
			}
			$eid =$_REQUEST['eid'];
			$user_id = $_REQUEST['uid'];
			
			//first sets equipment as unavailable
			$obj->set_available($eid);
			if($obj->set_available($eid)) {
				//if successfully sets equipment as unavailable then checkout equipment
				if(!$obj->checkout_equipment($user_id, $eid)) {
				echo '{"result":0,"message":"Sorry we could not execute the query."}';    
				} else {				
				echo '{"result":1,"message":"Equipment successfully checked out."}';
				}   
			} else {				
				echo '{"result":1,"message":"error"}';
			}

				
		}
    }