function sendRequest(theURL) {
    var obj = jQuery.ajax({
        url: theURL,
        async: false
    });
    var response = jQuery.parseJSON(obj.responseText);
    return response;
}


function searchActivities() {
    exitView();
    var search = searchBy.value;
    var txtToSearch = txtSearch.value;
    var objResult = sendRequest("http://localhost/software_engineering/EIMS/application/controllers/transaction_methods.php?cmd=3&sb=" + search + "&st=" + txtToSearch);
    $("#table").html(objResult.tabrow);
    $("#divStatus").html(objResult.message);
    divStatus.style.backgroundColor = "green";

}

function displayActivities() {
    var row;
    var cell;
    for (i = 0; i < activitiesArray.length; i++) {
        row = table.insertRow();
        cell = row.insertCell(0);
        cell.innerHTML = activitiesArray[i].date;
        cell = row.insertCell(1);
        cell.innerHTML = activitiesArray[i].equipment;
        cell = row.insertCell(2);
        cell.innerHTML = activitiesArray[i].user;
        cell = row.insertCell(3);
        cell.innerHTML = activitiesArray[i].purpose;
    }
}

function getHistory() {
    var objResult = sendRequest("http://localhost/software_engineering/EIMS/application/controllers/transaction_methods.php?cmd=1");

    $("#table").html(objResult.tabrow);
}

function veiwTransaction(id) {


    $("#contentSpace").load("http://localhost/software_engineering/EIMS/application/controllers/transaction_methods.php?cmd=2&id=" + id);
    pm_exit.hidden = false;
}

function exitView() {
    contentSpace.innerHTML = "";
    pm_exit.hidden = true;
}
