/*
Name: 			James Goodricke
ID:				101082494
Description:	Checks user input on the login page and redirects to buying page.
*/
function login()
{
	//Get User Details
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;
	
	//Redirect String
	destFile = "buying.php";
	
	//If fields missing, show error
	if(email == "" || password == "")
	{
		document.getElementById("result").innerHTML = "Error: username or password is blank.";
	}
	//If all fields filled in, attempt to log in
	else
	{
		//PHP file path and arguments
		var url = "login.php"
		var arguments = "email=" + email + "&password=" + password;
		
		//Create XHR Object
		var xhrObject = createXhrObject();
		xhrObject.open("POST", url, true);	
		xhrObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Do Query
		xhrObject.onreadystatechange = function() {
			if(xhrObject.readyState == 4 && xhrObject.status == 200) {
				responseText = xhrObject.responseText;
				//If return value is empty, redirect to buying.php
				if (responseText == "")
				{
					window.location.replace(destFile);
				}
				//If PHP returns an error, display it.
				else
				{
					document.getElementById("result").innerHTML = xhrObject.responseText;
				}

			}
		}
		xhrObject.send(arguments);	
	}
}
