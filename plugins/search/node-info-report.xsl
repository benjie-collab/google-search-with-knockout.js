<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">
<xsl:output method="html" version="4.0" encoding="UTF-8" indent="yes"/>

<xsl:param name="state"/>
<xsl:variable name="smallcase" select="'abcdefghijklmnopqrstuvwxyz'" />
<xsl:variable name="uppercase" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ'" />


<xsl:template match="/"> 
	<div class="panel-body ">	
			<xsl:apply-templates select="results/node"/>			
			<br/>
			<xsl:apply-templates select="results/report/passenger"/>			
	 </div>
</xsl:template>

<xsl:template match="node"> 
	<div class="row">
	    <div class="col-md-5">
			<div class="text-center">
			  <xsl:apply-templates select="./picture"/>
			</div>
	    </div>
	    <div class="col-md-7">
			<xsl:apply-templates select="./name"/>
			<xsl:apply-templates select="./age"/>
			<xsl:apply-templates select="./nationalities"/>	
			<br/>
		</div>
	</div>
</xsl:template>

<xsl:template match="name|age|nationalities|nationality"> 
	<!--<tr>
		<td>-->
		<abbr>
		<xsl:attribute name="class" select="'text-warning text-capitalize'"/>
		<xsl:attribute name="title" select="name(.)"/>
			<xsl:value-of select="name(.)"/>
		</abbr>: 
		<!--
		</td>
		<td class="text-capitalize">-->
		<span class="text-capitalize">
		<xsl:value-of select="translate(translate(translate(., '_', ' '), $uppercase , $smallcase), '/', ' ')"/></span><br/>
		<!--</td>
	</tr>-->
</xsl:template>	


<xsl:template match="passenger"> 	
	
	<div class="tile m-b-0">
		<h2 class="tile-title"> Investigation Report</h2>
		<div class="tile-config dropdown">
			    <a data-toggle="dropdown" href="#" class="tooltips tile-menu" title="Options"></a>
				<ul class="calendar-actions dropdown-menu pull-right text-right">
					<li>
						<a href="#" data-slide-to="0" data-target="#carousel-mindmap-node-report">
							Report
						</a>
					</li>
					<li>
						<a href="#" data-slide-to="1" data-target="#carousel-mindmap-node-report">
							Alias
						</a>
					</li>
				</ul>
							
		</div>
	<!--<xsl:apply-templates select="./picture"/>
	
	<table class="table-condensed table-striped" style="width: 100%">
		<tbody>
			<xsl:for-each select="./*[name(.) != 'picture']">
				<tr>
					<td>
					<abbr>
					<xsl:attribute name="class" select="'text-warning text-capitalize'"/>
					<xsl:attribute name="title" select="name(.)"/>
						<xsl:value-of select="translate(name(.), '_', ' ')"/>
					</abbr>: 
					
					</td>
					<td>
					<xsl:value-of select="translate(translate(translate(., '_', ' '), $smallcase, $uppercase), '/', ' ')"/>
					</td>
				</tr>
			</xsl:for-each>
		</tbody>
	</table>-->
	<div class="p-10">	
		<div class="carousel slide" id="carousel-mindmap-node-report">
			<div class="carousel-inner">
				<div id="carousel-mindmap-node-report-item-0" class="item active" style="height: 180px">
					<h6 class="text-uppercase text-center">More Info</h6>
					<xsl:for-each select="./*[
												name(.) != 'picture' and
												name(.) != 'alias' and	
												name(.) != 'education' and
												name(.) != 'qualification' and
												name(.) != 'family' and
												name(.) != 'name' and
												name(.) != 'nationality' and
												name(.) != 'age' and
												name(.) != 'education' and
												name(.) != 'id' and 
												name(.) != 'weight_score']">
						<div class="text-capitalize">				
							<abbr>
							<xsl:attribute name="class" select="'text-warning text-capitalize'"/>
							<xsl:attribute name="title" select="name(.)"/>
								<xsl:value-of select="translate(name(.), '_', ' ')"/>
							</abbr>:
							
							<xsl:value-of select="translate(translate(translate(., '_', ' '), $uppercase, $smallcase), '/', ' ')"/>
						</div>
					</xsl:for-each>
					<xsl:apply-templates select="./family"/>	
					<xsl:apply-templates select="./education"/>
					<xsl:apply-templates select="./weight_score"/>
				</div>
				<div id="carousel-mindmap-node-report-item-1" class="item" style="height: 180px">				
					<xsl:apply-templates select="./alias"/>							
				</div>
			</div>
		</div>
	
	</div>
	</div>
	

</xsl:template>	

<xsl:template match="picture"> 
	<xsl:element name="img">
	<xsl:attribute name="src" select="concat('../picture', .)"/>
	<xsl:attribute name="class" select="''"/>
	<xsl:attribute name="width" select="'80px'"/>
	</xsl:element>
</xsl:template>	

<xsl:template match="family">
	<h6 class="text-uppercase text-center">Family</h6>
	<xsl:for-each select="./*">
		<div class="text-capitalize">				
			<abbr>
			<xsl:attribute name="class" select="'text-warning text-capitalize'"/>
			<xsl:attribute name="title" select="name(.)"/>
				<xsl:value-of select="translate(name(.), '_', ' ')"/>
			</abbr>:				
			<xsl:value-of select="translate(translate(translate(., '_', ' '), $uppercase, $smallcase), '/', ' ')"/>
		</div>
	</xsl:for-each>	
</xsl:template>	

<xsl:template match="weight_score"> 
	<h6 class="text-uppercase text-center">Score</h6>
	<xsl:for-each select="./*">
		<div class="text-capitalize">				
			<abbr>
			<xsl:attribute name="class" select="'text-warning text-capitalize'"/>
			<xsl:attribute name="title" select="name(.)"/>
				<xsl:value-of select="translate(name(.), '_', ' ')"/>
			</abbr>:				
			<xsl:value-of select="translate(translate(translate(., '_', ' '), $uppercase, $smallcase), '/', ' ')"/>
		</div>
	</xsl:for-each>	
</xsl:template>	


<xsl:template match="education"> 
	<h6 class="text-uppercase text-center">Education</h6>
	<xsl:apply-templates select="./school"/>
</xsl:template>	

<xsl:template match="school"> 
	<xsl:if test=".[./name != '']">
		<div class="text-capitalize">	
			<abbr>
			<xsl:attribute name="class" select="'text-warning text-capitalize'"/>
			<xsl:attribute name="title" select="name(.)"/>
				<xsl:value-of select="./@type"/>
			</abbr>:
		</div>	
		<div class="text-capitalize">
			<xsl:text>&#x9;</xsl:text>
			<abbr>
			<xsl:attribute name="class" select="'text-capitalize'"/>
			<xsl:attribute name="title" select="Name"/>
				Name: 
			</abbr>			
			<xsl:value-of select="./name"/>
		</div>
		
		<div class="text-capitalize">		
			<xsl:text>&#x9;</xsl:text>
			<abbr>
			<xsl:attribute name="class" select="'text-capitalize'"/>
			<xsl:attribute name="title" select="Address"/>
				Address: 
			</abbr>
			<xsl:value-of select="./address"/>
		</div>
	</xsl:if>
</xsl:template>	


<xsl:template match="alias"> 

	<div class="row">
	    <div class="col-md-5">
			<div class="text-center">
			  <xsl:apply-templates select="./picture"/>
			</div>
	    </div>
	    <div class="col-md-7">
			<xsl:apply-templates select="./name"/>
			<xsl:apply-templates select="./age"/>
			<xsl:apply-templates select="./nationality"/>	
			<br/>
		</div>
	</div>
	
	
	
	
	<div class="wrapper " data-height="450">
		<h6 class="text-uppercase text-center">Basic Info</h6>
		<xsl:for-each select="./*[
								name(.) != 'picture' and
								name(.) != 'name' and	
								name(.) != 'nationality' and
								name(.) != 'age' and
								name(.) != 'id' and 
								name(.) != 'family' and
								name(.) != 'weight_score']">
			<div class="text-capitalize">				
				<abbr>
				<xsl:attribute name="class" select="'text-warning text-capitalize'"/>
				<xsl:attribute name="title" select="name(.)"/>
					<xsl:value-of select="translate(name(.), '_', ' ')"/>
				</abbr>:				
				<xsl:value-of select="translate(translate(translate(., '_', ' '), $uppercase, $smallcase), '/', ' ')"/>
			</div>
		</xsl:for-each>	
		<xsl:apply-templates select="./family"/>	
		<xsl:apply-templates select="./education"/>
		<xsl:apply-templates select="./weight_score"/>
			
	</div>
	
</xsl:template>	


</xsl:stylesheet>