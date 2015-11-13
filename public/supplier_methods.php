<?php
if(!isset($_REQUEST['cmd'])){
	echo '{"result":0,message:"unknown command"}';
	exit();
}
$cmd=$_REQUEST['cmd'];
switch($cmd)
{
	case 1:
		delete_supplier();
		break;
	case 2:
		search_suppliers();
		break;
	default:
		echo '{"result":0,message:"unknown command"}';
		break;
}

function delete_supplier(){
	include_once("suppliers.php");
	$obj=new suppliers();
	$id=$_REQUEST['id'];
	if($obj->delete_supplier($id)){
		echo '{"result":1,"message": "deleted"}';
	}else{
		echo '{"result":0,"message": "Supplier was not removed."}';
	}
}	

function search_suppliers(){
	if(!isset($_REQUEST['st'])){
		echo '{"result":0,"message": "search did not work."}';
	}
	$search_text=$_REQUEST['st'];
	include_once("suppliers.php");
	$obj=new suppliers();
	if(!$obj->search_suppliers($search_text)){
		echo '{"result":0,"message": "search did not work."}';
		return;
	}
	$row=$obj->fetch();
	echo '{"result":1,"suppliers":[';
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