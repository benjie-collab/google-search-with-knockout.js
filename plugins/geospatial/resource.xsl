<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0"  
  xmlns:xs="http://www.w3.org/2001/XMLSchema"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:xdmp="http://marklogic.com/xdmp"
  xmlns:fn="http://www.w3.org/2005/xpath-functions"
  xmlns:functx="http://www.functx.com"
  exclude-result-prefixes="xdmp xs functx fn"
  extension-element-prefixes="xdmp xs functx fn">
  <xsl:output method="html" version="4.0" encoding="UTF-8" indent="yes"/>

<xsl:param name="type"/>
<xsl:param name="points"/>
<xsl:param name="geometric"/>
<xsl:param name="radius"/>


<xsl:variable name="smallcase" select="'abcdefghijklmnopqrstuvwxyz'" />
<xsl:variable name="uppercase" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ'" />

<xsl:variable name="pageUri"><xsl:value-of select="xdmp:get-request-protocol()" />://<xsl:value-of select="xdmp:get-request-header('Host')" /></xsl:variable>

<xsl:template match="@*|node()"> 
	<xsl:copy>
		<xsl:apply-templates select="@*|node()"/>		
	</xsl:copy>		
</xsl:template>

<xsl:template match="/">
	 <div class="modal-dialog modal-dialog-sm">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#xd7;</button>
	                <h4 class="modal-title"><xsl:value-of select="name(map/*[1])"/></h4>
	            </div>
	            <div class="modal-body no-padding background-dark">
					<div class="wrapper p-10">		
						<xsl:apply-templates select="map/firestation"/>
						<xsl:apply-templates select="map/airport"/>
						<xsl:apply-templates select="map/policestation"/>
						<xsl:apply-templates select="map/hospital"/>
						<xsl:apply-templates select="map/news"/>
					</div>
				</div>
				<div class="modal-footer">
					<button data-dismiss="modal" class="btn btn-default" type="button">Done</button>
				</div>
			</div>
	</div>
</xsl:template>


<xsl:template match="policestation|firestation|airport|hospital|news">
	<form class="form-horizontal label-left">
	<div class="widget widget-org">
	<div class="row">
        <div class="col-md-3">
            <div class="text-align-center">
            	<xsl:element name="img">
            		<xsl:attribute name="src" select="concat('../picture', ./picture)"/>
            		<xsl:attribute name="class" select="''"/>
            		<xsl:attribute name="width" select="'150'"/>
            	</xsl:element>
            </div>
        </div>
        <div class="col-md-9">
        	<xsl:apply-templates select="./name"/>   
        	<strong class="text-capitalize"><xsl:value-of select="name(.)"/></strong><br/>         
            <address>  
            	<!--<xsl:apply-templates select="./date"/> 
            	<xsl:apply-templates select="./region"/> 
            	<xsl:apply-templates select="./address"/>
            	<xsl:apply-templates select="./state"/>
            	<xsl:apply-templates select="./telephone"/> 
            	<xsl:apply-templates select="./code"/>
            	<xsl:apply-templates select="./date"/> -->
				<xsl:for-each select="./*[name(.) != 'resource' and name(.) != 'picture' and name(.) != 'lat' and name(.) != 'long']">
					<abbr>
					<xsl:attribute name="title" select="name(.)"/>
					<xsl:attribute name="class" select="'text-capitalize text-warning'"/>
					<xsl:value-of select="name(.)"/>:</abbr> <xsl:text>&#xA0;</xsl:text>
					<span>
					<xsl:attribute name="class" select="'text-capitalize'"/>
					<xsl:value-of select="."/>
					</span><br/>				
				</xsl:for-each>
				
            </address>
        </div>
    </div>
	</div>
    
	
		<!--
		<div class="widget widget-org">
		<table class="table table-striped">
		<tbody>
				<xsl:apply-templates select="./summary"/>
				<xsl:apply-templates select="./attacktype"/>  
				<xsl:apply-templates select="./target"/>  
				<xsl:apply-templates select="./weapon"/>  
				<xsl:apply-templates select="./subweapon"/>  
				<xsl:apply-templates select="./weapondetail"/>
				<xsl:apply-templates select="./perpetrator"/>   
		</tbody>
		</table>
		</div>-->
	
	
	
	 
		<xsl:if test="count(./resource) &gt; 0">
		<section class="widget widget-tabs transparent">
			<header>
				<ul class="nav nav-tabs">
					<xsl:for-each select="./resource">
						<li>
						<xsl:if test="position() eq 1">
							<xsl:attribute name="class" select="'active'"/>
						</xsl:if>
							<a>
							<xsl:attribute name="data-toggle" select="'tab'"/>
							<xsl:attribute name="class" select="'text-capitalize'"/>
							<xsl:attribute name="href" select="concat('#cm-geospatial-tabbed-resource-', position())"/>
							<xsl:value-of select="./@type"/>
							</a>
						</li>					
					</xsl:for-each>					
				</ul>
			</header>
			<div class="body tab-content">
				<xsl:apply-templates select="./resource"/>  
			</div>
		</section>	
		</xsl:if>
    </form>
</xsl:template> 




<xsl:template match="name">
	<h3 class="no-margin"><xsl:value-of select="."/></h3>
</xsl:template> 

<xsl:template match="address|state|telephone|date|region">
	<abbr>
	<xsl:attribute name="title" select="name(.)"/><xsl:value-of select="name(.)"/>:</abbr> <xsl:text>&#xA0;</xsl:text><xsl:value-of select="."/><br/>
</xsl:template> 

<xsl:template match="code">
	<abbr><xsl:value-of select="."/>:</abbr> <xsl:text>&#xA0;</xsl:text><xsl:value-of select="./@value"/><br/>
</xsl:template> 



<xsl:template match="summary|attacktype|target|weapon|subweapon|weapondetail|perpetrator">
	<tr>
        <td><strong><xsl:value-of select="name(.)"/></strong></td>
        <td><xsl:value-of select="."/></td>
    </tr>
    
</xsl:template> 



<xsl:template match="resource">
	<div>
	<xsl:attribute name="id" select="concat('cm-geospatial-tabbed-resource-', position())"/>
	<xsl:choose>
		<xsl:when test="position() eq 1">
			<xsl:attribute name="class" select="'tab-pane active clearfix'"/>
		</xsl:when>
		<xsl:otherwise >
			<xsl:attribute name="class" select="'tab-pane clearfix'"/>
		</xsl:otherwise>
	</xsl:choose> 
	
		<h4 class="text-capitalize"><xsl:value-of select="./@type"/> Available</h4>	
			<div>
			<xsl:attribute name="id" select="concat('cm-geospatial-accordion-', ./@type, '-', position())"/>
			<xsl:attribute name="class" select="'panel-group'"/>			
				<xsl:apply-templates select="./item"/>  
			</div>
	</div>
</xsl:template> 

<xsl:template match="item">	     
	<xsl:variable name="uriProfile" select="concat($pageUri, '/xquery/expertise.xqy?type=parsed&#038;expertise=', translate(translate(., $uppercase, $smallcase),' ','_'), '&#038;stylesheet=/byrushan/plugins/geospatial/expertise.xsl')"/>	
	<div class="panel panel-default">
		<div class="panel-heading">
			<a>
			<xsl:attribute name="class" select="concat('accordion-toggle collapsed resource-accordion-', ../@type ,'-ajax')"/>
			<xsl:attribute name="href" select="concat('#cm-geospatial-accordion-', ../@type, '-panel-', position())"/>
			<xsl:attribute name="data-toggle" select="'collapse'"/>		
			<xsl:attribute name="data-url" select="concat('../xquery/expertise.xqy?type=parsed&#038;expertise=', translate(translate(., $uppercase, $smallcase),' ','_'), '&#038;stylesheet=/byrushan/plugins/geospatial/expertise.xsl')"/>
				<span class="label label-info pull-right"><xsl:value-of select="./@count"/> </span> <xsl:value-of select="."/>
			</a>
		</div>
		<div>
		<xsl:attribute name="class" select="'panel-collapse collapse'"/>
		<xsl:attribute name="id" select="concat('cm-geospatial-accordion-', ../@type, '-panel-', position())"/>
			<div class="panel-body">
			<!--
			<xsl:copy select="@*">
				<xsl:copy-of select="xdmp:document-get($uriProfile)"/>
			</xsl:copy>-->
			</div>
		</div>
	</div>
	
</xsl:template> 


</xsl:stylesheet>