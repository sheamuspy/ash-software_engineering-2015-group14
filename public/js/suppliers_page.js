var curId;
			function sendRequest(u){
				var obj=$.ajax({url:u,async:false});
				var result=$.parseJSON(obj.responseText);
				return result;	
			}
			function addData(){
				$("#contentSpace").load("add_supplier.php");
                exit.hidden=false;
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
				var url="http://localhost/software_engineering/EIMS/application/controllers/supplier_methods.php?cmd=1&id="+curId;
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
				var strUrl="http://localhost/software_engineering/EIMS/application/controllers/supplier_methods.php?cmd=2&st="+search_text;
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