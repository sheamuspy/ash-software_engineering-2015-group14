<?php
if(!isset($_REQUEST['cmd'])){
	echo '{"result":0,message:"unknown command"}';
	exit();
}
$cmd=$_REQUEST['cmd'];
switch($cmd)
{
	case 1:
		delete_lab();
		break;
	case 2:
		search_labs();
		break;
	default:
		echo '{"result":0,message:"unknown command"}';
		break;
}

function delete_lab(){
	include_once("../models/labs.php");
	$obj=new labs();
	$id=$_REQUEST['id'];
	if($obj->delete_lab($id)){
		echo '{"result":1,"message": "deleted"}';
	}else{
		echo '{"result":0,"message": "lab not removed."}';
	}
}	

function search_labs(){
	if(!isset($_REQUEST['st'])){
		echo '{"result":0,"message": "search did not work."}';
	}
	$search_text=$_REQUEST['st'];
	include_once("../models/labs.php");
	$obj=new labs();
	if(!$obj->search_labs($search_text)){
		echo '{"result":0,"message": "search did not work."}';
		return;
	}
	$row=$obj->fetch();
	echo '{"result":1,"labs":[';
	$count=0;
	while($row){
		$count++;
		echo json_encode($row);
		$row=$obj->fetch();
		if($row){
			echo ",";
		}
	}
	echo '], "message":"'.$count.' results found with \"'.$search_text.'\"","numRows":'.$count.'}';
}
?>