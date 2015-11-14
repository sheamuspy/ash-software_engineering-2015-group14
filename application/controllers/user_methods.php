<?php
	if(!isset($_REQUEST['cmd'])){
		exit();
	}
	$cmd = $_REQUEST['cmd'];
	
	switch($cmd){
		case 1:
			validate();
			break;
		default:
	
	}
	
	function validate(){
		include("../models/users.php");
		$username=$_REQUEST['username'];
		$password=$_REQUEST['password'];
		$obj= new users();
		$obj->connect();
		$obj->user_password_validation($username, $password);
		
		if($row=$obj->fetch()){
			echo'{"status":1, "message":"User found"}';
		}else{
			echo'{"status":0, "message":"User not found"}';
		}
	}
	
?>