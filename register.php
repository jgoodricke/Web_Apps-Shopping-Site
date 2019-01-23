<?php
/*
Name: 			James Goodricke
ID:				101082494
Description:	Checks user input from the registration page, and creates a new customer account in customers.xml
*/
	//Get values
	$email 		= $_POST["email"];
	$firstName 	= $_POST["firstName"];
	$lastName 	= $_POST["lastName"];
	$password 	= $_POST["password"];
	$password2 	= $_POST["password2"];
	$phone 		= $_POST["phone"];
	
	//path to xml file
	$xmlFile = "../../data/customer.xml";
	
	//Check if phone number was entered
	if($phone != "") {
		$hasPhone = true;
	} else {
		$hasPhone = false;
	}
	
	//Regex Expressions for Number
	$phoneRegex1 = "^0[0-9] [0-9]{8}^";		//0d dddddddd
	//TODO: Figure out why this isn't working
	$phoneRegex2 = "^\\(0[0-9]\\) [0-9]{8}^";	//(0d)dddddddd
	
	//If some fields are empty, return error message
	if($email==""
	|| $firstName==""
	|| $lastName==""
	|| $password==""
	|| $password2=="") 
	{
		echo"Error: some fields are still blank.";
	}
	//If password's don't match, return error message
	else if($password != $password2) 
	{
		echo"Error: password fields don't match";
	}
	//if the email address is invalid, return an error
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		echo"Error: invalid email address.";
	}
	
	//If the phone number has an invalid syntax, return an error message
	else if( $hasPhone && 
	((preg_match($phoneRegex1, $phone) != 1) || 	
	(preg_match($phoneRegex1, $phone) != 1)) ) 
	{
		echo"Error: phone number must be in the following formats:
		<br />0d dddddddd
		<br />(0d)dddddddd";
	}   
	
	//If no error messages have been thrown at this stage, load xml document and check email address.
	else
	{
		$emailExists = false;		//Used to check if email exists
		
		//If customer.xml exists, get data from it, and then check if email already exists
		if(file_exists($xmlFile)) {
			
			//Get DomDocument from XML file
			$dom = DOMDocument::load($xmlFile);
			
			$xmlEmail = $dom->getElementsByTagName("email");
			
			//Check if customer email exists
			foreach($xmlEmail as $node)
			{
				//Get email from xml
				$currentEmail = $xmlEmail -> item(0) -> nodeValue;
				
				//If email is found, set emailExists to true (which returns an error later on)
				if($currentEmail == $email)
				{
					$emailExists = true;
				}
			}
		}
		//If customer.xml doesn't exist, create a new DOM element to store data
		else
		{
			$dom = new DomDocument('1.0');
			$customers = $dom->createElement('customers');
			$customers = $dom->appendChild($customers);
		}
		
		//If email already exists, return an error.
		if($emailExists)
		{
			echo"Error: An account already exists with this email address. <a href='login.htm'>Go to login page<a>.";
		}
		//If email doesn't exist, save details to the xml file and return success.
		else
		{
			$newID = 0; // New id for customer
			
			//Get IDs from xml
			$IDs = $dom->getElementsByTagName("id");
			
			//Get a new ID that's larger than any current ID
			foreach($IDs as $node) {
				$currentID = $node->nodeValue;
				if($newID <= $currentID)	{
					$newID = $currentID + 1;
				}
			}
			//Create Parent node in DOM
			$customersNode = $dom->getElementsByTagName('customers')->item(0);
			
			//Add customer node to customers node
			$customerNode = $dom->createElement('customer');
			$customerNode = $customersNode->appendChild($customerNode);
			
			//Create a ID Element and set its value
			$IDNode = $dom->createElement('id');
			$IDNode = $customerNode->appendChild($IDNode);
			$IDValue = $dom->createTextNode($newID);
			$IDValue = $IDNode->appendChild($IDValue);
			
			//Create a lastlame Element and set its value
			$fNameNode = $dom->createElement('firstname');
			$fNameNode = $customerNode->appendChild($fNameNode);
			$fNameValue = $dom->createTextNode($firstName);
			$fNameValue = $fNameNode->appendChild($fNameValue);
			
			//Create a lastname Element and set its value
			$lNameNode = $dom->createElement('lastname');
			$lNameNode = $customerNode->appendChild($lNameNode);
			$lNameValue = $dom->createTextNode($lastName);
			$lNameValue = $lNameNode->appendChild($lNameValue);
			
			//Create an email Element and set its value
			$emailNode = $dom->createElement('email');
			$emailNode = $customerNode->appendChild($emailNode);
			$emailValue = $dom->createTextNode($email);
			$emailValue = $emailNode->appendChild($emailValue);			
			
			//Create a password Element and set its value
			$pwNode = $dom->createElement('password');
			$pwNode = $customerNode->appendChild($pwNode);
			$pwValue = $dom->createTextNode($password);
			$pwValue = $pwNode->appendChild($pwValue);
			
			//if phone exists, create a phone emement and set its value
			if($hasPhone)
			{
				$phoneNode = $dom->createElement('phone');
				$phoneNode = $customerNode->appendChild($phoneNode);
				$phoneValue = $dom->createTextNode($phone);
				$phoneValue = $phoneNode->appendChild($phoneValue);					
			}
			
			//Output result
			$result = "Registration Successful";
			$result = $result."<br/>Name: ".$firstName." ".$lastName;
			$result = $result."<br/>email: ".$email;
			
			if($hasPhone)
			{
				$result = $result."<br/>Phone: ".$phone;
			}
			$result = $result."<br/><a href='buyonline.htm'>Go back</a>.";
			echo $result;
			
			//Save changes
			$dom->save($xmlFile);
		}
	}
?>