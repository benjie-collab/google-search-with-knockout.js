<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">
<xsl:output method="html" version="4.0" encoding="UTF-8" indent="yes"/>

<xsl:param name="type"/>
<xsl:param name="points"/>
<xsl:param name="geometric"/>
<xsl:param name="expertise"/>


<xsl:variable name="smallcase" select="'abcdefghijklmnopqrstuvwxyz'" />
<xsl:variable name="uppercase" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ'" />

<xsl:template match="/">
	<xsl:choose>
		<xsl:when test="count(police/item) &gt; 0">
			<div class="wrapper p-10 scrollable" data-height="400">
				<ul class="media-list">		
					<xsl:apply-templates select="police/item"/>
				</ul>	 
			 </div>
		</xsl:when>
		<xsl:otherwise >
			<div class="wrapper p-10 scrollable" data-height="400">
				Nothing to show... 
			 </div>
		</xsl:otherwise>
	</xsl:choose>
	 
</xsl:template>

<xsl:template match="item">
	<li class="media">
		<xsl:element name="img">
		<xsl:attribute name="src" select="concat('../picture', ./picture)"/>
		<xsl:attribute name="class" select="'pull-left media-object'"/>
		<xsl:attribute name="alt" select="./name"/>
		</xsl:element>
		<div class="media-body">
			<div class="name"><a href="#"><xsl:value-of select="./name"/></a></div>	

			<div class="row no-margin">				
				<div class="col-sm-6 no-padding">
					<xsl:apply-templates select="./age"/>
					<xsl:apply-templates select="./race"/>					
					<xsl:apply-templates select="./nric"/>
					<xsl:apply-templates select="./marital_status"/>
					<xsl:apply-templates select="./education"/>										
					<xsl:apply-templates select="./blood_group"/>
					<xsl:apply-templates select="./eye_sight"/>
				</div>
				<div class="col-sm-6 no-padding">
					<xsl:apply-templates select="./expertise"/>
					<xsl:apply-templates select="./description"/>
				</div>
			</div>
		</div>
	</li>
</xsl:template>

<xsl:template match="race|age|expertise|education|nric|marital_status|education|blood_group|eye_sigh|description">
	<abbr>
	<xsl:attribute name="class" select="'text-capitalize text-warning'"/>
	<xsl:attribute name="title" select="translate(name(.), '_', ' ')"/> 
		<xsl:value-of select="translate(name(.), '_', ' ')"/> :
	</abbr>
		<xsl:value-of select="."/>
	<br/>
</xsl:template>



</xsl:stylesheet>