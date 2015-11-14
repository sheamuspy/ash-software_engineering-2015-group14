var curId;
			function sendRequest(u){
				var obj=$.ajax({url:u,async:false});
				var result=$.parseJSON(obj.responseText);
				return result;	
			}
			function addData(){
				$("#contentSpace").load("addlab.php");
                exit.hidden=false;
			}
			function viewData(lab_id){
				$("#contentSpace").load("viewlabs.php?lab_id="+lab_id);
				curId=lab_id;
				exit.hidden=false;
				deleteE.hidden=false;
				edit.hidden=false;
			}
			function editData(lab_id){
				$("#contentSpace").load("editlab.php?lab_id="+curId);
			}
			function deleteData(id){
				var url="http://localhost/software_engineering/EIMS/application/controllers/lab_functions.php?cmd=1&id="+curId;
				var obj=sendRequest(url);
				if(obj.result==1){
					$("#divStatus").text(obj.message);
				}else{
					$("#divStatus").text(obj.message);
					$("#divStatus").css("backgroundColor","red");
				}
				document.location='labpage.php';
				return;
			}
			function search(){
				var search_text=txtSearch.value;
				var strUrl="http://localhost/software_engineering/EIMS/application/controllers/lab_functions.php?cmd=2&st="+search_text;
				var objResult=sendRequest(strUrl);
				if(objResult.result==1){
					obj=objResult.labs;
					var row = '<table class="reportTable" width="100%">';
						row = row+"<tr class='header'><td>Lab Name</td><td>Department Head</td><td>Location</td><td></td><td></td></tr>";
			    	for(var i=0; i<obj.length; i++){
			    	if(i%2==0){
						row=row+"<tr onclick='viewData("+obj[i].lab_id+")' class='row1' style='cursor:pointer'>";
					}else{
						row=row+"<tr onclick='viewData("+obj[i].lab_id+")' class='row2' style='cursor:pointer'>";
					}
			    	row=row+"<td>" + obj[i].lab_name + "</td>";
			    	row=row+"<td>" + obj[i].department_head + "</td>";
			    	row=row+"<td>" + obj[i].lab_location + "</td>";
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