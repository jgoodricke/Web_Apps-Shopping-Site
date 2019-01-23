<?php
/*
Name: 			James Goodricke
ID:				101082494
Description:	Checks user input on login page and creates user session.
*/

	//Start Session
	session_start();
	
	//Get values
	$email 		= $_POST["email"];
	$password 	= $_POST["password"];
	
	//path to xml file
	$xmlFile = "../../data/customer.xml";
	
	//Redirect Filename
	$redirect = "buying.php";
	
	//used to check if user credentials checked out
	$authenticated = false;
	
	//Error Message
	$errorMessage = "Error: Username or Password is incorrect.";
	$result = "";
	//$successMessage = "SOMETHING SOMETHING LOGGED IN"
	//If file doesn't exist, tell user to register
	if(!file_exists($xmlFile))
	{
		$result = $errorMessage;
	}
	//If file doesn't exist, check username and password
	else
	{
		$dom = DOMDocument::load($xmlFile);
		
		//Check Email
		$customers = $dom->getElementsByTagName("customer");
		
		foreach($customers as $node)
		{
			//Get email and password from DOMDocument
			$currentEmail = $node -> getElementsByTagName("email") -> item(0) -> nodeValue;
			$currentPassword = $node -> getElementsByTagName("password") -> item(0) -> nodeValue;
					
			//If email is found, set emailExists to true (which returns an error later on)
			if($currentEmail == $email && $currentPassword == $password)
			{
				$authenticated = true;
				break;
			}			
		}
		
		//If authenticated, login and return redirect URL
		if($authenticated)
		{
			$_SESSION['username']=$email;
			$_SESSION['type']="Customer";
		}
		//If authentication failed, show error
		else
		{
			$result = $errorMessage;
		}
	}
	echo $result;
?>