/*
Name: 			James Goodricke
ID:				101082494
Description:	Scripts for the logout page.
*/

//Cancels any unfinished purchase
function cancelPurchase()
{
	var url = "buying-cancelPurchase.php"

	var xhrObject = createXhrObject();
	xhrObject.open("POST", url, true);	
	xhrObject.onreadystatechange = function() {
		if(xhrObject.readyState == 4 && xhrObject.status == 200) {
			//response = xhrObject.responseText;
			//If PHP response is blank, logout. Otherwise show error.
			//if(response == "") {
			logout();
			//}
			//document.getElementById("error").innerHTML = response;
		}
	}
	xhrObject.send(null);			
}

//Logs the user out
function logout()
{
	var url = "logout.php"

	var xhrObject = createXhrObject();
	xhrObject.open("POST", url, true);	
	xhrObject.onreadystatechange = function() {
		if(xhrObject.readyState == 4 && xhrObject.status == 200) {
			document.getElementById("result").innerHTML = xhrObject.responseText;
		}
	}
	xhrObject.send(null);			
}