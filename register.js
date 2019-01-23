/*
Name: 			James Goodricke
ID:				101082494
Description:	Passes user input from registration page to the server.
*/

function register() {
	//Get Variables
	var email = document.getElementById("email").value;
	var firstName = document.getElementById("firstName").value;
	var lastName = document.getElementById("lastName").value;
	var password = document.getElementById("password").value;
	var password2 = document.getElementById("password2").value;
	var phone = document.getElementById("phone").value;
	
	var url = "register.php"

	//Set XHR Arguments
	var arguments = "email=" + email;
	arguments += "&firstName=" + firstName;
	arguments += "&lastName=" + lastName;
	arguments += "&password=" + password;
	arguments += "&password2=" + password2;
	arguments += "&phone=" + phone;
	
	//Create XHR OBject
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