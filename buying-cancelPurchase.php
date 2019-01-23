<?php
/*
Name: 			James Goodricke
ID:				101082494
Description:	Cancels the customer's purchase on the buying page.
*/
	//Start Session
	session_start();
	
	$result = "";
	
	//Check if cart exists
	if(isset($_SESSION["cart"]))
	{
		$xmlFile = "../../data/goods.xml";	//path to goods xml file
		
		//Get DomDocument from XML file
		$dom = DOMDocument::load($xmlFile);
		$root = $dom->getElementsByTagName("good");
		
		//Update each cart item
		foreach ($_SESSION["cart"] as $itemNo => $amount)
		{
			//Find the matching item in XML and update it
			foreach($root as $node)
			{
				$currentItemNo = $node->getElementsByTagName("itemNo")->item(0)->nodeValue;
				
				if($itemNo == $currentItemNo)
				{
					$node->getElementsByTagName("available")->item(0)->nodeValue += $amount;
					$node->getElementsByTagName("onHold")->item(0)->nodeValue -= $amount;
					break;
				}
			}
		}
		//Save XML
		$dom->save($xmlFile);
		
		//Clear Cart
		unset($_SESSION["cart"]);
		
		//Return confirmation message
		$result = "Your purchase request has been cancelled, welcome to shop next time.";
	}
	echo $result;
?>