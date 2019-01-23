<?php
/*
Name: 			James Goodricke
ID:				101082494
Description:	Removes an item from the customer's cart on the buying page.
*/
	session_start();
	
	//Get passed values
	$itemNo = $_GET["itemNo"];
	
	//path to goods xml file
	$xmlFile = "../../data/goods.xml";
	
	//Get amount of items in cart
	$amount = $_SESSION["cart"][$itemNo];
	
	//Get DomDocument from XML file
	$dom = DOMDocument::load($xmlFile);
	$root = $dom->getElementsByTagName("good");
	$goodNode;
	
	//Search for current item number and get that node
	foreach($root as $node)
	{
		$currentItemNo = $node->getElementsByTagName("itemNo")->item(0)->nodeValue;
		
		if($itemNo == $currentItemNo)
		{
			$goodNode = $node;
			break;
		}
	}
	
	//Update XML
	$goodNode->getElementsByTagName("available")->item(0)->nodeValue += $amount;
	$goodNode->getElementsByTagName("onHold")->item(0)->nodeValue -= $amount;

	$dom->save($xmlFile);
	
	//Remove item from cart
	unset($_SESSION["cart"][$itemNo]);

	//Echo nothing, unless there is an error
	echo "";
?>