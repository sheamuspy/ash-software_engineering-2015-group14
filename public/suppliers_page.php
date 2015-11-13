<?php
	session_start();
	if(!isset($_SESSION['USERNAME'])){
		header("location:login.php");
	}

?>
<html>
	<head>
		<title>Suppliers</title>
		<link rel="stylesheet" href="css/style.css">
		<script src="jquery-2.1.3.js"></script>
		<script>
			var curId;
			function sendRequest(u){
				var obj=$.ajax({url:u,async:false});
				var result=$.parseJSON(obj.responseText);
				return result;	
			}
			function addData(){
				$("#contentSpace").load("add_supplier.php");
			}
			function viewData(supplier_id){
				$("#contentSpace").load("view_suppliers.php?supplier_id="+supplier_id);
				curId=supplier_id;
				exit.hidden=false;
				deleteE.hidden=false;
				edit.hidden=false;
			}
			function editData(lab_id){
				$("#contentSpace").load("edit_supplier.php?supplier_id="+curId);
			}
			function deleteData(id){
				var url="supplier_methods.php?cmd=1&id="+curId;
				var obj=sendRequest(url);
				if(obj.result==1){
					$("#divStatus").text(obj.message);
				}else{
					$("#divStatus").text(obj.message);
					$("#divStatus").css("backgroundColor","red");
				}
				document.location='suppliers_page.php';
				return;
			}
			function search(){
				var search_text=txtSearch.value;
				var strUrl="supplier_methods.php?cmd=2&st="+search_text;
				var objResult=sendRequest(strUrl);
				if(objResult.result==1){
					obj=objResult.suppliers;
					var row = '<table class="reportTable" width="100%">';
						row = row+"<tr class='header'><td>Supplier Name</td><td>Supplier Address</td><td>Phone Number</td></tr>";
			    	for(var i=0; i<obj.length; i++){
					if(i%2==0){
						row=row+"<tr onclick='viewData("+obj[i].supplier_id+")' class='row1' style='cursor:pointer'>";
					}else{
						row=row+"<tr onclick='viewData("+obj[i].supplier_id+")' class='row2' style='cursor:pointer'>";
					}
			    	row=row+"<td>" + obj[i].supplier_name + "</td>";
			    	row=row+"<td>" + obj[i].address + "</td>";
			    	row=row+"<td>" + obj[i].phone_number + "</td>";
			    	/*row=row+"<td style='cursor:pointer' onclick= 'editData($id)'>Edit</td><td style='cursor:pointer' onclick= 'deleteData($id)'>Delete</td></tr>";*/
			    	row=row+"</tr>";
			      	}
					row = row+"</table>";
					$("#tableExample").html(row);
					$("#divStatus").html(objResult.message);
					divStatus.style.backgroundColor="green";
				}
			}
			function exitView(){
				contentSpace.innerHTML="";
				exit.hidden=true;
				deleteE.hidden=true;
				edit.hidden=true;
			 }
		</script>
	</head>
	<body>
		<table align='center'>
			<tr>
				<td colspan="2" id="pageheader">
					<b>Ashesi Engineering Inventory</b>
				</td>
			</tr>
			<tr>
				<td id="mainnav">
					<div><?php echo $_SESSION['USERNAME']?><br> logged in</div>
					<a href="index.php" style="text-decoration:none"><div class="menuitem">Home</div></a>
					<a href="equipment_page.php" style="text-decoration:none"><div class="menuitem">Equipment</div></a>
					<a href="labpage.php" style="text-decoration:none"><div class="menuitem">Labs</div></a>
					<a href="suppliers_page.php" style="text-decoration:none"><div class="menuitem"><b>Supplier</b></div></a>
					<a href="history.php" style="text-decoration: none;"><div class="menuitem">History</div></a>
					<a href="logout.php" style="text-decoration: none;"><div class="menuitem">Logout</div></a>
				</td>
				<td id="content">
					<div id="divPageMenu">
					<div style="float:left">
						<span class="menuitem" onclick="addData()">Add Lab</span>
						<span class="menuitem" id="edit" onclick="editData()" hidden="true">Edit</span> 
						<span class="menuitem" id="deleteE" onclick="deleteData()" hidden="true">Delete</span>
						<span class="menuitem" id="exit" onclick="exitView()" hidden="true">Exit</span>
					</div>
					<div align="right">
						<input type="text" id="txtSearch" placeholder="Search for suppliers by name"/>
						<span class="menuitem" onclick="search()">search</span>
							</div>		
					</div>
					<div id="divStatus" class="status">
						status message
					</div>
					<div id="divContent">
						<div id="contentSpace"></div>
						<table id="tableExample" class="reportTable" width="100%">
							<?php
								include_once("suppliers.php");
								$obj = new suppliers();
								$obj->get_suppliers();
								echo "<tr class='header'>
										<td>Supplier Name</td>
										<td>Supplier Address</td>
										<td>Phone Number</td>
										</tr>";
									$row_indicator = 0;
									$count=0;
								while($row=$obj->fetch()){
									if($row_indicator==0){
										$class = 'row1';
										$row_indicator = 1;
									}else{
										$class = 'row2';
										$row_indicator = 0;
									}
									$id=$row['supplier_id'];
									echo "<tr class=$class onclick='viewData($id)' style='cursor:pointer'>
									<td >{$row['supplier_name']}</td>
									<td>{$row['address']}</td>
									<td>{$row['phone_number']}</td>
									</tr>";
								}
							?>
						</table>
					</div>
				</td>
			</tr>
		</body>
</html>	