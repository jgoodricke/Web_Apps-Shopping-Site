<?php
/*
Name: 			James Goodricke
ID:				101082494
Description:	Adds items to the customer's cart.
*/
	//Start Session
	session_start();
	
	//Get passed values
	$itemNo = $_GET["itemNo"];
	$available = 0;
	
	//path to goods xml file
	$xmlFile = "../../data/goods.xml";
	
	//error message and result
	$errorMessage = "Sorry, this item is not available for sale";
	$result = "";
	
	//Get DomDocument from XML file
	$dom = DOMDocument::load($xmlFile);
	$root = $dom->getElementsByTagName("good");
	$goodNode;
	
	//Search for current ID
	foreach($root as $node)
	{
		//Get item number for node
		$currentItemNo = $node->getElementsByTagName("itemNo")->item(0)->nodeValue;
		
		//If the item numbers match, get the available amount from node
		if($itemNo == $currentItemNo)
		{
			$goodNode = $node;
			$available = $node->getElementsByTagName("available")->item(0)->nodeValue;
			break;
		}
	}
	
	//If the item is out of stock, return an error message
	if ($available == 0)
	{
		$result = $errorMessage;
	}
	//If the item is available update and display the cart
	else
	{
		//Update Node values
		$goodNode->getElementsByTagName("available")->item(0)->nodeValue --;
		$goodNode->getElementsByTagName("onHold")->item(0)->nodeValue ++;
		
		//If cart doesn't exist, create cart
		if (!isset($_SESSION["cart"]))
		{
			$_SESSION["cart"] = array($itemNo => 1);
		}
		//If the item isn't in cart yet, create a new item
		else if (!isset($_SESSION["cart"][$itemNo])){
			
			$_SESSION["cart"][$itemNo] = 1;
		}
		//If the item is already in the cart, increment that item
		else {
			$_SESSION["cart"][$itemNo]++;
		}
	}
	//Save changes
	$dom->save($xmlFile);
	
	//Return result
	echo $result;
?>