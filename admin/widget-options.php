<?php
	settings_fields( 'bxtsrch_settings' );
	do_settings_sections( __FILE__ );

	//get the older values, wont work the first time
	$options = get_option( 'bxtsrch_settings' ); ?>
	
<!--
<div class="widget-liquid-right">
	<div class="widgets-right">
	<br/>
	<div class="widgets-holder-wrap">
		<div class="widget">	
			<div class="widget-top">
				<div class="widget-title"><h4>Widget 1<span class="in-widget-title"></span></h4></div>
			</div>
			<div class="widget-inside" style="display: block;">
				<form method="post" action="">
				<div class="widget-content">
						<p>
							<label for="widget-meta-2-title">Title:</label> 
							<input type="text" value="" name="widget-meta[2][title]" id="widget-meta-2-title" class="widefat">
						</p>
				</div>				

				<div class="widget-control-actions">
					<div class="alignleft">
					<a href="#remove" class="widget-control-remove">Delete</a> |
					<a href="#close" class="widget-control-close">Close</a>
					</div>
					<div class="alignright">
						<input type="submit" value="Save" class="button button-primary widget-control-save right" id="widget-meta-2-savewidget" name="savewidget">			<span class="spinner"></span>
					</div>
					<br class="clear">
				</div>
				</form>
			</div>

		</div>	
	
	</div>
	</div>
</div>-->

