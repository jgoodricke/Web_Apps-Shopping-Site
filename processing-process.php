<?php
/*
Name: 			James Goodricke
ID:				101082494
Description:	Processes outstanding purchases on the processing page
*/
	$xmlFile = "../../data/goods.xml";	//Path to XML document
	//If file exists, do processing
	if(file_exists($xmlFile)) {
		
		//Load data from XML File
		$dom = DOMDocument::load($xmlFile);
		$root = $dom -> getElementsByTagName('good');
		
		forEach($root as $node)
		{
			//Clear Sold
			$node -> getElementsByTagName("sold")->item(0)->nodeValue = 0;

			//remove products that have no items on hold, sold or available
			if(		$node->getElementsByTagName("sold")->item(0)->nodeValue == 0 
				&&	$node->getElementsByTagName("onHold")->item(0)->nodeValue == 0 
				&&	$node->getElementsByTagName("available")->item(0)->nodeValue== 0)
			{
				$node->parentNode->removeChild($node);
			}		
		}
		//Save changes
		$dom->save($xmlFile);
		
		//Echo nothing, unless there's an error
		echo "";
		
	}
?>