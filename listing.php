<HTML XMLns="http://www.w3.org/1999/xHTML">
<!--
Name: 			James Goodricke
ID:				101082494
Description:	Page for creating new listings
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
	<title>Manager Listing</title>
	
	<!--Scripts-->
	<script type="text/javascript" src="xhr.js"></script>
	<script type="text/javascript" src="listing.js"></script>

	<!--Styles-->	
	 <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<!--HEADER-->
	<p>
		<a href = "listing.php">listing</a>
		&nbsp; &nbsp; &nbsp; &nbsp;<!--Four Spaces-->
		<a href = "processing.php">processing</a>
		&nbsp; &nbsp; &nbsp; &nbsp;<!--Four Spaces-->
		<a href = "logout.htm">logout</a>
	</p>
	<hr />
	
	<h1>Add a New Item</h1>
	<table>
		<tr>
			<td>Item Name: </td>
			<td> 
				<input type="text" id="name"> 
			</td>
		</tr>		
		<tr>
			<td>Item Price:</td>
			<td> <input type="text" id="price"> </td>
		</tr>		
		<tr>
			<td>Item Quantity:</td>
			<td> <input type="text" id="quantity"> </td>
		</tr>		
		<tr>
			<td>Item Description:</td>
			<td><textarea id="description"></textarea></td>
		</tr>		
		<tr id="buttons">
			<td id="buttons"> 
				<input type = "button" onClick = "addListing()" value = "Add Item"> 
			</td>
			<td> 
				<input type = "button" onClick = "resetFields()" value = "Reset"> 
			</td>
		</tr>
	</table>
	
	<div id="result"></div>
</body>