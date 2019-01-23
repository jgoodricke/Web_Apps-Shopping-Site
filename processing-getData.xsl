<?xml version="1.0" encoding="utf-8"?>
<!--
Name: 			James Goodricke
ID:				101082494
Description:	Generates table of unprocessed purchases.
-->

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
	
	<table>
		<!--Table Headers-->
		<tr>
			<th>Item Number</th>
			<th>Name</th>
			<th>Price</th>
			<th>Quantity Available</th>
			<th>Quantity on Hold</th>
			<th>Quantity Sold</th>
		</tr>
		
		<!--Populate table with goods that have 1 or more outstanding purchases-->
		<xsl:for-each select=".//good[sold &gt; 0]">
			<tr>
				<td> <xsl:value-of select="itemNo" />	</td>
				<td> <xsl:value-of select="name" />		</td>
				<td> <xsl:value-of select="price" />	</td>
				<td> <xsl:value-of select="available" /></td>
				<td> <xsl:value-of select="onHold" />	</td>
				<td> <xsl:value-of select="sold" />		</td>
			</tr>
		</xsl:for-each>
		
		<!--Buttons-->
		<tr id="buttons">
			<td colspan="7">		
				<input name="process" type = "button" onClick = "process()" value = "Process" />
			</td>
		</tr>
	</table>

	
</xsl:template>
</xsl:stylesheet>