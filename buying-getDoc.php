<?php
/*
Name: 			James Goodricke
ID:				101082494
Description:	Returns the goods XML file.
*/
	$xmlFile = "../../data/goods.xml";
	$dom = DOMDocument::load($xmlFile);
	echo $dom->saveXML();
?>