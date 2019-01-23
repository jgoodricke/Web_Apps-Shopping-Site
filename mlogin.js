/*
Name: 			James Goodricke
ID:				101082494
Description:	Scripts for manager login page.
*/
function login() {
	//Get Variables
	var ID = document.getElementById("ID").value;
	var password = document.getElementById("password").value;
	
	//Set login and arguments
	var url = "mlogin.php"
	var arguments = "ID=" + ID + "&password=" + password;
	
	//Create xhr Object, open connection and set header
	var xhrObject = createXhrObject();
	xhrObject.open("POST", url, true);	
	xhrObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	//Do Query
	xhrObject.onreadystatechange = function() {
		if(xhrObject.readyState == 4 && xhrObject.status == 200) {
			document.getElementById("result").innerHTML = xhrObject.responseText;
		}
	}
	xhrObject.send(arguments);	
}