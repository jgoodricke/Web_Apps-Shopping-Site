<?php
/*
Name: 			James Goodricke
ID:				101082494
Description:	Confirms the customer's purchase on the buying page.
*/
	session_start();
	
	$xmlFile = "../../data/goods.xml";		//path to goods xml file
	
	//Get DomDocument from XML file
	$dom = DOMDocument::load($xmlFile);
	$root = $dom->getElementsByTagName("good");
	
	$total = 0;	//Total amount owed for purchase
	
	//Update each cart item
	foreach ($_SESSION["cart"] as $itemNo => $amount)
	{
		//Find the matching item in XML
		foreach($root as $node)
		{
			$currentItemNo = $node->getElementsByTagName("itemNo")->item(0)->nodeValue;
			
			if($itemNo == $currentItemNo)
			{
				//Update XML
				$node->getElementsByTagName("sold")->item(0)->nodeValue += $amount;
				$node->getElementsByTagName("onHold")->item(0)->nodeValue -= $amount;
					
				//Update Total
				$total = $total + ($node->getElementsByTagName("price")->item(0)->nodeValue * $amount);
				break;
			}
		}
	}
	//Save XML
	$dom->save($xmlFile);
	
	//Clear Cart
	unset($_SESSION["cart"]);
	
	//Return confirmation message
	echo "Your purchase has been confirmed and total amount due to pay is $".$total.".";
?>