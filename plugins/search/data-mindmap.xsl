<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">
<xsl:output method="html" version="4.0" encoding="UTF-8" indent="yes"/>

<xsl:variable name="smallcase" select="'abcdefghijklmnopqrstuvwxyz'" />
<xsl:variable name="uppercase" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ'" />
<xsl:variable name="directory" select="'/byrushan/plugins/mindmap/'" />

<xsl:template match="/">	
			<div class="accordion tile vt vt-tr m-0">
				<div id="js-mindmap-panel-info-accordion" class="panel-group block m-0">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">
								<a href="#js-mindmap-panel-info" data-parent="#js-mindmap-panel-info-accordion" data-toggle="collapse" class="accordion-toggle">
									<i class="fa fa-info-circle"></i> Information Panel
								</a>
							</h3>
						</div>
						<div class="panel-collapse collapse" id="js-mindmap-panel-info" >							
						</div>
					</div>
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">
								<a href="#" class="accordion-toggle">
									<i class="fa-sitemap fa"></i> Legend
								</a>
							</h3>
						</div>
						<div class="panel-collapse ">	
							<div class="panel-body">
							<table class="table-condensed">
								<tbody>
									<tr>
										<td>
										<xsl:element name="img">
										<xsl:attribute name="src" select="concat($directory,'img/default.png')"/>
										<xsl:attribute name="style" select="'border: 2px dotted #ff0000'"/>
										<xsl:attribute name="class" select="'img-circle'"/>
										<xsl:attribute name="width" select="'24'"/>
										</xsl:element>
										</td>
										<td>Suspect</td>
									</tr>
									<tr>
										<td>
										<xsl:element name="img">
										<xsl:attribute name="src" select="concat($directory,'img/default.png')"/>
										<xsl:attribute name="style" select="'border: 2px dotted #F2FA12'"/>
										<xsl:attribute name="class" select="'img-circle'"/>
										<xsl:attribute name="width" select="'24'"/>
										</xsl:element>
										</td>
										<td>Terrorist</td>
									</tr>
									<tr>
										<td><span class="label label-info">100</span></td>
										<td>Children count</td>
									</tr>
									<tr>
										<td><a href="#" class="node-info-action"><i class="fa fa-share-alt"></i></a></td>
										<td>Show children</td>
									</tr>						
									<tr>
										<td><a href="#" class="node-info-action"><i class="fa fa-dot-circle-o"></i></a></td>
										<td>Full Info</td>
									</tr>
									<tr>
										<td><a href="#" class="node-info-action"><i class="fa fa-cubes"></i></a></td>
										<td>Quick Info</td>
									</tr>
									
								</tbody>
							</table>	
							</div>	
						</div>
					</div>
					
				</div>
			</div>

		
			
	<div id="js-mindmap">
		<xsl:apply-templates select="results/relation/nodes/node"/>		
		<ul id="navigation">
			<xsl:apply-templates select="results/relation/nodes/node/children/*" />
		</ul>	
	</div>	
		
</xsl:template>

<xsl:template match="results/relation/nodes/node">
	<div class="mind-map-root">			
		<xsl:element name="img">
		<xsl:attribute name="src" select="concat($directory,'img/brain.png')"/>
		<xsl:attribute name="class" select="'img-circle'"/>
		<xsl:attribute name="width" select="'100'"/>
		</xsl:element>		
		<span  class="badge badge-success"><xsl:value-of select="./name"/></span>		
		<div class="node-info text-capitalize">
			<!--<a href="#" class="node-info-action"><i class="eicon-share"></i></a>-->
			<a href="#" class="node-info-action"><i class="eicon-info-circled"></i></a>
		</div>
	</div>
</xsl:template> 


<xsl:template match="node">
	<li> 
		<xsl:apply-templates select="./picture" />		
		<p><xsl:value-of select="translate(translate(translate(./name, '_', ' '), $smallcase, $uppercase), '/', ' ')"/></p> 
		<xsl:apply-templates select="./type" />		
		<div class="node-info">
			<xsl:if test="count(./children) &gt; 0">
				<a href="#" class="node-info-action node-show-children"><i class="eicon-share"></i></a>
			</xsl:if>			
			<xsl:call-template name="report">
				<xsl:with-param name="type" select="./type"/>
				<xsl:with-param name="id" select="./id"/>
			</xsl:call-template>
			<xsl:apply-templates select="./infos" />
			
		</div>
		<xsl:if test="count(./children/*) &gt; 0">
			<ul> 
				<xsl:apply-templates select="./children/*" />
			</ul>
		</xsl:if>
	</li> 
</xsl:template> 

<xsl:template match="picture">
	<span class="img-circle">
	<xsl:if test="../type[1] eq 'suspect' or ../type[1] eq 'nation_suspect'">
		<xsl:attribute name="style" select="'border: 3px dotted #ff0000'"/>
	</xsl:if>
	<xsl:if test="../type[1] eq 'terrorist'">
		<xsl:attribute name="style" select="'border: 3px dotted #F2FA12'"/>
	</xsl:if>
	
		<xsl:element name="img">
		<xsl:choose>
			<xsl:when test=". != ''">
				<xsl:attribute name="src" select="concat($directory, 'img/', .)"/>
			</xsl:when>	
			
			<xsl:when test="./following-sibling::type[1] eq 'Passenger'">
				<xsl:attribute name="src" select="concat($directory, 'img/passengers.png')"/>
			</xsl:when>			
			
			<xsl:when test="./following-sibling::type[1] eq 'Crew'">
				<xsl:attribute name="src" select="concat($directory, 'img/pilot.jpg')"/>
			</xsl:when>
			
			<xsl:when test="./following-sibling::type[1] eq 'tech_crew'">
				<xsl:attribute name="src" select="concat($directory, 'img/pilot.jpg')"/>
			</xsl:when>
			
			<xsl:when test="./following-sibling::type[1] eq 'suspect'">
				<xsl:attribute name="src" select="concat($directory, 'img/default.png')"/>				
			</xsl:when>
			
			<xsl:otherwise>
				<xsl:attribute name="src" select="concat($directory, 'img/default.png')"/>
			</xsl:otherwise>
		</xsl:choose>
		<xsl:attribute name="width" select="'50'"/>
		<xsl:attribute name="class" select="''"/>
		</xsl:element>
	</span>
</xsl:template> 

<xsl:template match="type">
	<xsl:if test=". eq 'nation' or . eq 'travel_type' or . eq 'tech_crew'">
		<span class="label label-info">
			<xsl:value-of select="count(./following-sibling::children[1]/node)"/>
		</span>
	</xsl:if>	
</xsl:template> 

<xsl:template match="infos">
	<xsl:if test="./info[1]/@label != ''">
	<span>
	<xsl:attribute name="class" select="'node-info-action cursor-pointer text-warning'"/>
	<xsl:attribute name="rel" select="'popover'"/>
	<xsl:attribute name="data-title" select="translate(./preceding-sibling::name[1],'/', ' ')"/>	
		<i class="fa fa-info-circle"></i>		
		<div class="hidden node-info-action-popover-content">
			<xsl:apply-templates select="./info"/>			
		</div>
	</span>	
	</xsl:if>
</xsl:template> 

<xsl:template match="info">
	<xsl:if test="./@label != ''">			
		<span class="text-warning"><xsl:value-of select="translate(./@label, $uppercase, $smallcase)"/></span>
		: 		
		<xsl:apply-templates select="./text"/>	
		<br/>
	</xsl:if>
</xsl:template> 

<xsl:template match="text">
	<xsl:if test="count(../text) &gt; 1">
		<br/>
		<i class="fa fa-dot-circle-o"></i>
	</xsl:if>
	<xsl:choose>
		<xsl:when test="(translate(../@label, $uppercase, $smallcase)) eq 'link'">	
			<a>
			<xsl:attribute name="target" select="'_blank'"/>
			<xsl:attribute name="href" select="translate(., $uppercase, $smallcase)"/>
				<xsl:value-of select="translate(., $uppercase, $smallcase)"/>
			</a>
		</xsl:when>		
		<xsl:otherwise>	
			<xsl:value-of select="translate(., $uppercase, $smallcase)"/>
		</xsl:otherwise>
	</xsl:choose>
</xsl:template> 





<xsl:template name="report">
    <xsl:param name="type"/>	
	<xsl:param name="id"/>	
	<xsl:if test="$type eq 'passenger' or $type eq 'crew' or $type eq 'suspect'">
		<a>
		<xsl:attribute name="href" select="'#js-mindmap-panel-info'"/>
		<!--<xsl:attribute name="data-toggle" select="'collapse'"/>-->
		<xsl:attribute name="class" select="'node-info-action cursor-pointer'"/>
		<xsl:attribute name="data-rel" select="'node-info-report'"/>
		<xsl:attribute name="data-id" select="$id"/>			
		<i class="fa fa-cubes"></i>
		</a>
	</xsl:if>   
  </xsl:template>


</xsl:stylesheet>