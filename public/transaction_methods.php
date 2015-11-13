<?php
	if(!isset($_REQUEST['cmd'])){
		include("transaction.php");
	
		$obj = new transaction();
		$obj->connect();
		$obj->select_transactions();
		$table_row="<tr class='header'><td>Name</td><td>Equipment</td><td>Date of transaction</td><td>Purpose</td></tr>";
		$row;
		$row_indicator = 0;
		$count=0;
		while($row = $obj->fetch()){
			
			if($row_indicator==0){
				$class = 'row1';
				$row_indicator = 1;
			}else{
				$class = 'row2';
				$row_indicator = 0;
			}
			$table_row=$table_row."<tr class=$class onclick='veiwTransaction({$row['transaction_id']})' style='cursor:pointer'>";
			$table_row=$table_row."<td>{$row['user_name']}</td><td>{$row['equipment_name']}</td><td>{$row['transaction_date']}</td><td>{$row['purpose']}</td>";
			$table_row=$table_row."</tr>";
			$count++;
		}
		echo $table_row;
		exit();
	}

	$cmd = $_REQUEST['cmd'];
	
	switch($cmd){
	case 1:
		include("transaction.php");
	
		$obj = new transaction();
		$obj->connect();
		$obj->select_transactions();
		$table_row="<tr class='header'><td>Name</td><td>Equipment</td><td>Date of transaction</td><td>Purpose</td></tr>";
		$row;
		$row_indicator = 0;
		$count=0;
		while($row = $obj->fetch()){
			
			if($row_indicator==0){
				$class = 'row1';
				$row_indicator = 1;
			}else{
				$class = 'row2';
				$row_indicator = 0;
			}
			$table_row=$table_row."<tr class=$class onclick='veiwTransaction({$row['transaction_id']})' style='cursor:pointer'>";
			$table_row=$table_row."<td>{$row['user_name']}</td><td>{$row['equipment_name']}</td><td>{$row['transaction_date']}</td><td>{$row['purpose']}</td>";
			$table_row=$table_row."</tr>";
			$count++;
		}
		echo '{"status":1, "numRows":'.$count.', "message":"'.$count.' results found","tabrow":"'.$table_row.'"}';
		break;
		
	case 2:
		$id=$_REQUEST['id'];
		include("transaction.php");
		$obj= new transaction();
		$obj->connect();
		$obj->get_transaction($id);
		
		$transaction=$obj->fetch();
		$response = "<table>";
		$response = $response."<tr><td>User that completed task</td><td>{$transaction['user_name']}</td></tr>";
		$response = $response."<tr><td>Equipment name</td><td>{$transaction['equipment_name']}</td></tr>";
		$response = $response."<tr><td>Date transaction was completed</td><td>{$transaction['transaction_date']}</td></tr>";
		$response = $response."<tr><td>Purpose of transaction</td><td>{$transaction['purpose']}</td></tr>";
		$response = $response."</table>";
		echo $response;
		break;
		
	case 3:
	
		$search_by = $_REQUEST['sb'] ;
		$search_txt = $_REQUEST['st'];
		include("transaction.php");
	
		$obj = new transaction();
		$obj->connect();
		switch($search_by){
			case 0:
				
			case 1:
				$obj->select_transactions_by_equipment($search_txt);
				break;
			case 2:
				$obj->select_transactions_by_date($search_txt);
				break;
			case 3:
				$obj->select_transactions_by_name($search_txt);
				break;
			default:
		
		}
		
		$table_row="<tr class='header'><td>Name</td><td>Equipment</td><td>Date of transaction</td><td>Purpose</td></tr>";
		$row;
		$row_indicator = 0;
		$count=0;
		while($row = $obj->fetch()){
			
			if($row_indicator==0){
				$class = 'row1';
				$row_indicator = 1;
			}else{
				$class = 'row2';
				$row_indicator = 0;
			}
			$table_row=$table_row."<tr class=$class onclick='veiwTransaction({$row['transaction_id']})' style='cursor:pointer'>";
			$table_row=$table_row."<td>{$row['user_name']}</td><td>{$row['equipment_name']}</td><td>{$row['transaction_date']}</td><td>{$row['purpose']}</td>";
			$table_row=$table_row."</tr>";
			$count++;
		}
		echo '{"status":1, "numRows":'.$count.', "message":"'.$count.' results found with \"'.$search_txt.'\"","tabrow":"'.$table_row.'"}';
		break;
		
	
	case 4:
		add_transaction();
		break;
	default:
		break;
	
	
	}
	
	function add_transaction(){
	
		$uid=$_REQUEST['uid'];
		$eid=$_REQUEST['eid'];
		$pur=$_REQUEST['pur'];
		include_once("transaction.php");
		
		$trans= new transaction();
		$trans->connect();
		if(!$trans->add_transaction($uid, $eid, $pur)){
			echo '{"result":0,"message": "Could not add transaction."}';
		}else{
			echo '{"result":1,"message": "transaction added."}';
		}
}
?>