<?php
/*
Name: 			James Goodricke
ID:				101082494
Description:	Adds a new listing to the goods.xml file
*/
	//User input
	$name = $_GET["name"];
	$price = $_GET["price"];
	$quantity = $_GET["quantity"];
	$desc = $_GET["desc"];

	$xmlFile = "../../data/goods.xml";	//path to xml file
	
	//If xml file exists, Import into a DOM Document
	if(file_exists($xmlFile)) {
		$dom = DOMDocument::load($xmlFile);
	}
	//If xml file doesn't exist, create a new DOM document
	else
	{
		$dom = new DomDocument('1.0');
		$root = $dom->createElement('goods');
		$root = $dom->appendChild($root);
	}

	//Generate a new item number
	$data = $dom -> getElementsByTagName("itemNo");
	$itemNo = 1;
	forEach($data as $node)
	{
		$currentNo = $node -> nodeValue;
		
		if ($itemNo <= $currentNo)
		{
			$itemNo = $currentNo + 1;
		}
	}
	//Put item in XML Document
	$root = $dom -> documentElement;
	
	//Create a new good node
	$goodNode = $dom -> createElement('good');
	$goodNode = $root -> appendChild($goodNode);
	
	//Create a itemNo node and add value
	$itemNoNode = $dom -> createElement('itemNo');
	$itemNoNode = $goodNode -> appendChild($itemNoNode);
	$itemNoValue = $dom -> createTextNode($itemNo);
	$itemNoValue = $itemNoNode -> appendChild($itemNoValue);
	
	//Create a name node and add value
	$nameNode = $dom -> createElement('name');
	$nameNode = $goodNode -> appendChild($nameNode);
	$nameValue = $dom -> createTextNode($name);
	$nameValue = $nameNode -> appendChild($nameValue);	
	
	//Create a description node and add value
	$descNode = $dom -> createElement('desc');
	$descNode = $goodNode -> appendChild($descNode);
	$descValue = $dom -> createTextNode($desc);
	$descValue = $descNode -> appendChild($descValue);	
	
	//Create a price node and add value
	$priceNode = $dom -> createElement('price');
	$priceNode = $goodNode -> appendChild($priceNode);
	$priceValue = $dom -> createTextNode($price);
	$priceValue = $priceNode -> appendChild($priceValue);
	
	//Create an available node and add value
	$availableNode = $dom -> createElement('available');
	$availableNode = $goodNode -> appendChild($availableNode);
	$availableValue = $dom -> createTextNode($quantity);
	$availableValue = $availableNode -> appendChild($availableValue);		
	
	//Create a onHold node and add value
	$onHoldNode = $dom -> createElement('onHold');
	$onHoldNode = $goodNode -> appendChild($onHoldNode);
	$onHoldValue = $dom -> createTextNode("0");
	$onHoldValue = $onHoldNode -> appendChild($onHoldValue);	
	
	//Create a sold node and add value
	$soldNode = $dom -> createElement('sold');
	$soldNode = $goodNode -> appendChild($soldNode);
	$soldValue = $dom -> createTextNode("0");
	$soldValue = $soldNode -> appendChild($soldValue);
	
	//Save Document
	$dom -> save($xmlFile);
	
	//Return confirmation message with Item Number
	echo "The item has been listed in the system, and the item number is: ".$itemNo;
?>