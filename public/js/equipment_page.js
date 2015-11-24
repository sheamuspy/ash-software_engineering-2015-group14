$(document).ready(function (){
    $(".button-collapse").sideNav();
});

var curId;
			
//			function loadEquip(){
//				$("#tableExample").load("equip.php");
//			}

			function sendRequest(theURL){
				var obj = jQuery.ajax({url:theURL, async:false});
				var response = jQuery.parseJSON(obj.responseText);
				return response;
			}
			
            function loadAddEquipmentForm(){
                $("#contentSpace").load("add_equipment.php");
				exit.hidden=false;
				deleteE.hidden=true;
				edit.hidden=true;
            }
            function loadViewEquip(eid){
                $("#contentSpace").load("view.php?id=" + eid);
				curId=eid;
				exit.hidden=false;
				deleteE.hidden=false;
				edit.hidden=false;
            }
            function loadEditEquipmentForm(){
                $("#contentSpace").load("edit_equipment.php?eid="+curId);
            }
			
			function editEquipment(){
				var eName=en.value;
				var serialNum=sn.value;
				var inventNumber=inv.value;
				var labId=lid.value;
				var datePurchased=dp.value;
				var supplierId=sid.value;
				var description=ed.value;
				var objResult= sendRequest("http://localhost/software_engineering/EIMS/application/controllers/equipment_methods.php?cmd=2&eid="+curId+"&en="+eName+"&sn="+serialNum+"&in="+inventNumber+"&lid="+labId+"&dp="+datePurchased+"&sid="+supplierId+"&ed="+description+"&uid="+userId);
				
				if(objResult.result==1){
					addTransaction(curId,"Edited");
					location.reload();
					divStatus.innerHTML = objResult.message;
				}else{
					divStatus.innerHTML = objResult.message;
				}
			}
			
			function addEquipment(){
				var eName=en.value;
				var serialNum=sn.value;
				var inventNumber=inv.value;
				var labId=lid.value;
				var datePurchased=dp.value;
				var supplierId=sid.value;
				var description=ed.value;
				var objResult= sendRequest("http://localhost/software_engineering/EIMS/application/controllers/equipment_methods.php?cmd=1&en="+eName+"&sn="+serialNum+"&in="+inventNumber+"&lid="+labId+"&dp="+datePurchased+"&sid="+supplierId+"&ed="+description+"&uid="+userId);
				if(objResult.result==1){
					var lastResult = sendRequest("equipment_methods.php?cmd=5");
					var eid = lastResult.response;
					addTransaction(eid,"Added");
					location.reload();
					divStatus.innerHTML = objResult.message;
					
				}else{
					divStatus.innerHTML = objResult.message;
				}
				
			}
			
			function addTransaction(eid, pur){
				var objResult= sendRequest("http://localhost/software_engineering/EIMS/application/controllers/transaction_methods.php?cmd=4&uid="+userId+"&eid="+eid+"&pur="+pur);
			}
			
            function search(){
				var search_text=txtSearch.value;
				var strUrl="http://localhost/software_engineering/EIMS/application/controllers/equipment_methods.php?cmd=4&st="+search_text;
				var objResult=sendRequest(strUrl);
				if(objResult.result==1){
					obj=objResult.equipment;
					var row = '<table class="reportTable" width="100%">';
						row = row+"<tr class='header'><td>Serial Number</td><td>Equipment name</td><td>Lab</td><td>Date of Purchase</td></tr>";
			    	for(var i=0; i<obj.length; i++){
			    	if(i%2==0){
						row=row+"<tr onclick='loadViewEquip("+obj[i].equipment_id +")' class='row1' style='cursor:pointer'>";
					}else{
						row=row+"<tr onclick='loadViewEquip("+obj[i].equipment_id +")' class='row2' style='cursor:pointer'>";
					}
			    	row=row+"<td>" + obj[i].serial_number + "</td>";
			    	row=row+"<td>" + obj[i].equipment_name + "</td>";
			    	row=row+"<td>" + obj[i].lab_name + "</td>";
					row=row+"<td>" + obj[i].date_purchased + "</td>";
			    	/*row=row+"<td style='cursor:pointer' onclick= 'editData($id)'>Edit</td><td style='cursor:pointer' onclick= 'deleteData($id)'>Delete</td></tr>";*/
			    	row=row+"</tr>";
			      	}
					row = row+"</table>";
					$("#tableExample").html(row);
					$("#divStatus").html(objResult.message);
					divStatus.style.backgroundColor="green";
				}
			}
			
            function deleteEquip(){
				var objResult= sendRequest("http://localhost/software_engineering/EIMS/application/controllers/equipment_methods.php?cmd=3&eid="+curId);
				if(objResult.result==1){
					location.reload();
					divStatus.innerHTML = objResult.message;
					
				}
            }
            function deleteEquip(eid){
				var objResult= sendRequest("http://localhost/software_engineering/EIMS/application/controllers/equipment_methods.php?cmd=6&id="+eid);
				if(objResult.result==1){
					location.reload();
					divStatus.innerHTML = objResult.message;

				}
            }
			
			function exitView(){
				contentSpace.innerHTML="";
				exit.hidden=true;
				deleteE.hidden=true;
				edit.hidden=true;
			 }
