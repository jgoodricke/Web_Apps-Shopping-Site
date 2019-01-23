<?php
/*
Name: 			James Goodricke
ID:				101082494
Description:	Gets table of unprocessed purchases from XSL file.
*/
	$xmlFile = "../../data/goods.xml";
	$xslFile = "processing-getData.xsl";
	if(file_exists($xmlFile)) {
		//Get XML Document
		$xmlDoc = new DOMDocument();
		$xmlDoc->load($xmlFile);
		
		//Get XSL Document
		$xslDoc = new DOMDocument();
		$xslDoc->load($xslFile);
		
		//Create XSLT Processor and apply the XSL Stylesheet to it
		$proc = new XSLTProcessor();
		$proc->importStylesheet($xslDoc);
		
		//Process the XML Document and return result
		echo $proc->transformToXML($xmlDoc);
	}
	else
	{
		echo "Error: XML/XSL file not found";
	}
?>