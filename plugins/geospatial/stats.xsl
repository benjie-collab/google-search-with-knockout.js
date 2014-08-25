<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">
<xsl:output method="html" version="4.0" encoding="UTF-8" indent="yes"/>

<xsl:param name="state"/>
<xsl:param name="imgpath"/>
<xsl:param name="imgsize"/>

<xsl:template match="/"> 

	<section class="widget">
	    <header>
	        <h4>
	        	<i class="fa fa-bar-chart-o"></i> 
	        	Statistics of <small style="display: inline !important;" class="hidden-xs">	
	       		Victims in <xsl:value-of select="$state"/>
				</small>
			</h4>
			<div class="actions">
				<button data-target="#carousel-mha-geospatial" data-slide-to="0" class="btn btn-transparent btn-xs">Done <i class="glyphicon glyphicon-remove"></i></button>
	        </div>
	    </header>
	    <div class="body">
	    	<div class="row">
	    		<div class="col-sm-6">
	    			<!-- <section class="widget transparent">
	                    <header>
	                        <h4>
	                            <i class="fa fa-users"></i>
	                            Victims 
	                            <span class="label label-info"><xsl:value-of select="count(/result/patient)"/></span>
	                        </h4>
	                    </header>
	                    <div class="body"> -->
	                    <div class="wrapper scrollable" data-height="300">
			    			<table class="table table-striped">
					            <thead>
					            <tr>
					                <th>#</th>
					                <th>Patients</th>
					                <th class="hidden-xs-portrait">Programs</th>
					                <th>Group Type</th>
					            </tr>
					            </thead>
					            <tbody>
					            	<xsl:apply-templates select="/result/patient"/>
					            </tbody>
					        </table>
					    </div><!-- 
					      </div>
					</section> -->
	    		</div>
	    		
	    		<div class="col-sm-6">
	    			<section class="widget transparent">
				         <header>
				             <h4><i class="fa fa-list-ol"></i> Available Programs
				             <span class="label label-info"><xsl:value-of select="count(/result/program)"/></span>
				             </h4>
				             
				         </header>
				         <div class="body">
				         	<div id="victims-stats-programs" style="height: 220px"></div>	
				         </div>
				     </section>
	    		</div>
	    	</div>
	    </div>
	 </section>
	 
	 
     <div class="row">
     	<div class="col-sm-6">
     		<section class="widget">
	          <header>
	              <h4><i class="fa fa-fire-extinguisher"></i> Type of Abuse in Sex Trafficking
	              <span class="label label-info"><xsl:value-of select="count(/result/drugtype)"/></span>
	              </h4>
	              
	          </header>
	          <div class="body">
	          		<div id="victims-stats-drugtype" style="height: 220px"></div>
	          </div>
	      </section>
     	</div>
     	<div class="col-sm-6">
     		<section class="widget ">
	          <header>
	              <h4><i class="fa fa-users"></i> Victim Group
	              <span class="label label-info"><xsl:value-of select="count(/result/patientgroup)"/></span>
	              </h4>
	          </header>
	          <div class="body">
	          		<div id="victims-stats-patientgroup" style="height: 220px"></div>
	          </div>
	      </section>
     	
     	</div>     
     </div>
     
      
      
      

</xsl:template>


<xsl:template match="patient">	
     <tr>
         <td><xsl:value-of select="position()"/></td>
         <td><xsl:value-of select="./name"/></td>
         <td class="hidden-xs-portrait"><xsl:value-of select="./program"/></td>
         <td><xsl:value-of select="./grouptype"/></td>
     </tr>
</xsl:template>





</xsl:stylesheet>