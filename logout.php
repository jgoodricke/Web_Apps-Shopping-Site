<?php
/*
Name: 			James Goodricke
ID:				101082494
Description:	Destroys user session when logging out.
*/
	session_start();
	
	$name = $_SESSION['username'];
	$type = $_SESSION['type'];
	
	session_destroy();
	
	echo "You have now been logged out. Thanks, ".$name." (".$type.").";
?>