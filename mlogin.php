<?php
/*
Name: 			James Goodricke
ID:				101082494
Description:	Checks user input and creates login session for the manager login page.
*/
	//Values from client
	$id = $_POST["ID"];
	$password = $_POST["password"];
	
	//used to determine user authentication
	$verified = false;
	$result = "";
	
	//Import details from text document
	//Source: http://php.net/manual/en/function.fgetcsv.php
	$handle = fopen("../../data/manager.txt", "r");
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)	{
		//TODO: Put this back
		if ($data[0] == $id && $data[1] == $password){
			$verified = true;
		}
	}	
		fclose($handle);
	//}
	//If login succesful, echo success message and links, and set session.
	if($verified)
	{
		//Start Session
		if(isset($_SESSION)){
			session_destroy();
		}
		session_start();
		$_SESSION['username']=$id;
		$_SESSION['type']="Manager";
		
		//Confirmation message and links.
		$result = $_SESSION['type']." login successful. Welcome back, ".$_SESSION['username'].".";
		$result = $result."<br/> <br/> <a href = 'listing.php'>listing</a>";
		$result = $result."<br/> <a href = 'processing.php'>processing</a>";		
	}
	//If login unsuccessful, echo error message
	else
	{
		$result = "Error: username or password is incorrect.";
	}
	
	echo $result;
?>