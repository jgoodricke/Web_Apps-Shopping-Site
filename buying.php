<HTML XMLns="http://www.w3.org/1999/xHTML">
<!--
Name: 			James Goodricke
ID:				101082494
Description:	Page for users to buy items.
-->
<?php
	//Check user is logged in
	session_start();
	if(isset($_SESSION['type']) ) {
		if($_SESSION['type'] != "Customer"){
			header( 'Location: login.htm' ) ;
		}
	}
	else
	{
		header( 'Location: login.htm' ) ;
	}
?>
<head>
	<title>Buying</title>
	
	<script type="text/javascript" src="xhr.js"></script>
	<script type="text/javascript" src="buying.js"></script>
	<script type="text/javascript" src="cancelPurchase.js"></script>
	
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body onload="init()">
	<a href="logout.htm">logout</a>
	<hr />
	<h1>Shopping Catalogue</h1>
			
	<table id="catalogue">
	<tr>
		<th>Item Number</th>
		<th>Name</th>
		<th>Description</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Add</th>
	</tr>
	</table>
	<div id="result"></div>
	<div id="cart"></div>
</body>