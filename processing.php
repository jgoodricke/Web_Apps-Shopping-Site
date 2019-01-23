<HTML XMLns="http://www.w3.org/1999/xHTML">
<!--
Name: 			James Goodricke
ID:				101082494
Description:	Page for processing purchases.
-->
<?php
	//Check user is logged in
	session_start();
	if(isset($_SESSION['type']) ) {
		if($_SESSION['type'] != "Manager"){
			header( 'Location: mlogin.htm' ) ;
		}
	}
	else
	{
		header( 'Location: mlogin.htm' ) ;
	}
?>
<head>
	<title>Manager Processing</title>
	
	<script type="text/javascript" src="xhr.js"></script>
	<!--Process Input-->
	<script type="text/javascript" src="processing.js"></script>	
	<!--Styles-->	
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body onload="getData()">
	<p>
		<a href = "listing.php">listing</a>
		&nbsp; &nbsp; &nbsp; &nbsp;<!--Four Spaces-->
		<a href = "processing.php">processing</a>
		&nbsp; &nbsp; &nbsp; &nbsp;<!--Four Spaces-->
		<a href = "logout.htm">logout</a>
	</p>
	<hr />
	<h1>Process Sold Items</h1>
	
	<div id="result"></div>
	<div id="debugging"></div>
</body>