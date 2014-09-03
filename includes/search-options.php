	<div class="wrap">
		
		<?php
		settings_fields( 'bxt_options' );
		do_settings_sections( __FILE__ );

		//get the older values, wont work the first time
		$options = get_option( 'bxt_options' ); 		
		
		//print_r($options);
		?>
		
		<h3>Google API Key</h3>
			<form name="bxt-option-form" method="post">
			<table class="widefat">
				<tfoot>
					<tr>
						<td colspan="4">
						<button type="reset" class="button button-secondary">Reset</button>
						<button type="submit" class="button button-primary">Save Settings</button>
					</td>
					</tr>
				</tfoot>
				<tbody>
				<tr>				
					<td>					
						<label>
							<input class="widefat" placeholder="API Key" name="bxt_key" type="text" id="bxt_key" value="<?php echo (isset($options['key']) && $options['key'] != '') ? $options['key'] : ''; ?>"/>						
						</label>		
						
					</td>
				</tr>
				</tbody>
			</table>
			</form>
		<p class="description">Get yours <a href="https://code.google.com/apis/console#:access" target="_blank">here</a>.</p>
		
		<br/>
				
		<div class="widget-liquid-left">
			<div id="widgets-left">
				
				<h3>Available Search </h3>
				<div id="available-widgets">
					<p class="">To activate a widget drag it to a sidebar or click on it. To deactivate a widget and delete its settings, drag it back.</p>
					
					<br/>
					
					<!--
					<div id="tabs">
					<ul>
					<li><a href="#tabs-1">Nunc tincidunt</a></li>
					<li><a href="#tabs-2">Proin dolor</a></li>
					<li><a href="#tabs-3">Aenean lacinia</a></li>
					</ul>
					<div id="tabs-1">
					<p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
					</div>
					<div id="tabs-2">
					<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
					</div>
					<div id="tabs-3">
					<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
					<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
					</div>
					</div>

					<div id="accordion">
						<h3>Section 1</h3>
						<div>
						<p>
						Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
						ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
						amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
						odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
						</p>
						</div>
						<h3>Section 2</h3>
						<div>
						<p>
						Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
						purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
						velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
						suscipit faucibus urna.
						</p>
						</div>
						<h3>Section 3</h3>
						<div>
						<p>
						Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
						Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
						ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
						lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
						</p>
						<ul>
						<li>List item one</li>
						<li>List item two</li>
						<li>List item three</li>
						</ul>
						</div>
						<h3>Section 4</h3>
						<div>
						<p>
						Cras dictum. Pellentesque habitant morbi tristique senectus et netus
						et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
						faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
						mauris vel est.
						</p>
						<p>
						Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
						Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
						inceptos himenaeos.
						</p>
						</div>
						</div>
					-->
					
					<div class="widget-list" id="bxt-list-sortable">		
						&nbsp;
						<?php 
						foreach ($options['features'] as $key => $ft) : ?>
							<?php if (!in_array($ft, $options['active'])) : ?>
							<div class="widget bxt-list-sortable-items" id="bxt-list-item-<?php echo $key ?>">
								<div class="widget-top">
									<div class="widget-title">
										<h4><?php echo ($ft) ?><span class="in-widget-title"></span></h4>
									</div>
									<div class="widget-title-action">
										<a href="#TB_inline?width=600&height=550&inlineId=bxtsrch-opt-vdsrch" title="<?php echo ($ft) ?>" class="thickbox widget-action hide-if-no-js"><small>What's this?</small></a>
									</div>
								</div>
								<div class="widget-description">
									A monthly archive of your site’s Posts.
								</div>
							</div>		
							<?php endif;?>		
						<?php endforeach;?>							
					</div>
				</div>
		
		
		
				<!--
				
				<br/>
				<h3>Search Features</h3>
				<table class="wp-list-table widefat fixed pages bxt-list" id="bxt-list-draggable">
					<thead>
					<tr>	
						<th scope="row">Name</th>
						<th>
							Activate
						</th>
						<th>
							Set Primary
						</th>
						<th>
							Info
						</th>
					</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="4">
							<button type="reset" class="button button-primary">Reset</button>
							<button type="submit" class="button button-primary">Save Settings</button>
						</td>
						</tr>
					</tfoot>
					<tbody>
						<?php 
						foreach ($options['features'] as $key => $ft) { ?>
							
							<tr class="bxt-list-draggable-items" id="bxt-list-item-<?php echo $key ?>">	
								<th scope="row"><?php _e( $ft, 'bxt' ); ?></th>
								<td>
									<label>
										<input class="widefat" name="bxtsrch_options[features][WebSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['WebSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['WebSearch'])) ? 'checked' : ''; ?>/>						
									</label>					
								</td>
								<td>
									<label>
										<input class="widefat" name="bxtsrch_options[features][primary]" type="radio" id="" value="WebSearch" <?php echo (isset($options['features']['primary']) && $options['features']['primary'] == 'WebSearch') ? 'checked' : ''; ?>/>						
									</label>					
								</td>
								<td>
								<a href="#TB_inline?width=600&height=550&inlineId=bxtsrch-opt-wbsrch" title="Web Search" class="thickbox"><small>What's this?</small></a>
								</td>
							</tr>		
							
						<?php }	?>	
					<tbody>
				</table>-->
			
			</div>
		</div>
		
		
		
		
		
		<div class="widget-liquid-right">
			<div id="widgets-right">
				<div class="sidebars-column-1">
					<div class="widgets-holder-wrap">
						<div id="sidebar-1" class="widgets-sortables ui-sortable">
							<div class="sidebar-name">
								<div class="sidebar-name-arrow"><br></div>
								<h3>Actived Search Features <span class="spinner"></span></h3>
							</div>
							<div class="sidebar-description"><p class="description">Main sidebar that appears on the left.</p></div>
							<div id="bxt-list-dropped">
							&nbsp;
							<?php 
							foreach ($options['active'] as $key => $ft) : ?>
								
								<div class="widget bxt-list-sortable-items" id="bxt-list-item-<?php echo $key ?>">
									<div class="widget-top">
										<div class="widget-title">
											<h4><?php echo ($ft) ?><span class="in-widget-title"></span></h4>
										</div>
										<div class="widget-title-action">
											<a href="#TB_inline?width=600&height=550&inlineId=bxtsrch-opt-vdsrch" title="<?php echo ($ft) ?>" class="thickbox widget-action hide-if-no-js"><i class="fa fa-info-circle"></i></a>
										</div>
									</div>
									<div class="widget-description">
										A monthly archive of your site’s Posts.
									</div>
									<input type="hidden" value="<?php echo($ft) ?>" name="bxt_options[features]"/>
								</div>		
								
							<?php endforeach;?>	
							</div>
						</div>							
					</div>
				</div>			
			</div>
		</div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<!--
		
		
		
		
		<br/>
		<h3>Search Features</h3>
		<table class="wp-list-table widefat fixed pages">
			<thead>
			<tr>	
				<th scope="row">Name</th>
				<th>
					Activate
				</th>
				<th>
					Set Primary
				</th>
				<th>
					Info
				</th>
			</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="4">
					<button type="reset" class="button button-primary">Reset</button>
					<button type="submit" class="button button-primary">Save Settings</button>
				</td>
				</tr>
			</tfoot>
			<tbody>
			<tr>	
				<th scope="row">Web Search</th>
				<td>
					<label>
						<input class="widefat" name="bxtsrch_options[features][WebSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['WebSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['WebSearch'])) ? 'checked' : ''; ?>/>						
					</label>					
				</td>
				<td>
					<label>
						<input class="widefat" name="bxtsrch_options[features][primary]" type="radio" id="" value="WebSearch" <?php echo (isset($options['features']['primary']) && $options['features']['primary'] == 'WebSearch') ? 'checked' : ''; ?>/>						
					</label>					
				</td>
				<td>
				<a href="#TB_inline?width=600&height=550&inlineId=bxtsrch-opt-wbsrch" title="Web Search" class="thickbox"><small>What's this?</small></a>
				</td>
			</tr>
			<tr>	
				<th scope="row">Video Search</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[features][VideoSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['VideoSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['VideoSearch'])) ? 'checked' : ''; ?>/>
						</label>
					
				</td>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[features][primary]" type="radio" id="" value="VideoSearch" <?php echo (isset($options['features']['primary']) && $options['features']['primary'] == 'VideoSearch') ? 'checked' : ''; ?>/>						
						</label>
					
				</td>
				<td>
				<a href="#TB_inline?width=600&height=550&inlineId=bxtsrch-opt-vdsrch" title="Video Search" class="thickbox"><small>What's this?</small></a>
				</td>
			</tr>
			<tr>	
				<th scope="row">Blog Search</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[features][BlogSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['BlogSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['BlogSearch'])) ? 'checked' : ''; ?>/>
						</label>
					
				</td>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[features][primary]" type="radio" id="" value="BlogSearch" <?php echo (isset($options['features']['primary']) && $options['features']['primary'] == 'BlogSearch') ? 'checked' : ''; ?>/>						
						</label>
					
				</td>
				<td>
				<a href="#TB_inline?width=600&height=550&inlineId=bxtsrch-opt-bgsrch" title="Blog Search" class="thickbox"><small>What's this?</small></a>
				</td>
			</tr>
			<tr>	
				<th scope="row">News Search</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[features][NewsSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['NewsSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['NewsSearch'])) ? 'checked' : ''; ?>/>
						</label>
					
				</td>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[features][primary]" type="radio" id="" value="NewsSearch" <?php echo (isset($options['features']['primary']) && $options['features']['primary'] == 'NewsSearch') ? 'checked' : ''; ?>/>						
						</label>
					
				</td>
				<td>
				<a href="#TB_inline?width=600&height=550&inlineId=bxtsrch-opt-nwsrch" title="News Search" class="thickbox"><small>What's this?</small></a>
				</td>
			</tr>
			<tr>	
				<th scope="row">Image Search</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[features][ImageSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['ImageSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['ImageSearch'])) ? 'checked' : ''; ?>/>
						</label>
					
				</td>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[features][primary]" type="radio" id="" value="ImageSearch" <?php echo (isset($options['features']['primary']) && $options['features']['primary'] == 'ImageSearch') ? 'checked' : ''; ?>/>						
						</label>
					
				</td>
				<td>
				<a href="#TB_inline?width=600&height=550&inlineId=bxtsrch-opt-imsrch" title="Image Search" class="thickbox"><small>What's this?</small></a>
				</td>
			</tr>
			<tr>	
				<th scope="row">Book Search</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[features][BookSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['BookSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['BookSearch'])) ? 'checked' : ''; ?>/>
						</label>
					
				</td>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[features][primary]" type="radio" id="" value="BookSearch" <?php echo (isset($options['features']['primary']) && $options['features']['primary'] == 'BookSearch') ? 'checked' : ''; ?>/>						
						</label>
					
				</td>
				<td>
				<a href="#TB_inline?width=600&height=550&inlineId=bxtsrch-opt-bksrch" title="Book Search" class="thickbox"><small>What's this?</small></a>
				</td>
			</tr>
			<tr>	
				<th scope="row">Patent Search</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[features][PatentSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['PatentSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['PatentSearch'])) ? 'checked' : ''; ?>/>
						</label>
					
				</td>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[features][primary]" type="radio" id="" value="PatentSearch" <?php echo (isset($options['features']['primary']) && $options['features']['primary'] == 'PatentSearch') ? 'checked' : ''; ?>/>						
						</label>
					
				</td>
				<td>
				<a href="#TB_inline?width=600&height=550&inlineId=bxtsrch-opt-ptsrch" title="Patent Search" class="thickbox"><small>What's this?</small></a>
				</td>
			</tr>
			</tbody>
			
		</table>
					
		<!--
		<br/>
		
		<h3>Parameters</h3>
		<table class="widefat">		
			<tr>
				<th scope="row">Action</th>
				<td>
					
						<label>
							<select class="widefat" name="bxtsrch_options[params][action]" id="bxtsrch_action">
								<option value="query" <?php selected( $options['params']['action'], 'query' ); ?>>query</option>
								<option value="suggest" <?php selected( $options['params']['action'], 'suggest' ); ?>>suggest</option>
								<option value="images" <?php selected( $options['params']['action'], 'images' ); ?>>images</option>
							</select>												
						</label>
						
					
				</td>
			</tr>
			<tr>
				<th scope="row">prop</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[params][prop]" type="text" id="bxtsrch_prop" value="<?php echo (isset($options['params']['prop']) && $options['params']['prop'] != '') ? $options['params']['prop'] : 'extracts|pageimages'; ?>"/>						
						</label>
					
				</td>
			</tr>
			<tr>
				<th scope="row">Format</th>
				<td>
					
						<label>
							<select class="widefat" name="bxtsrch_options[params][format]" id="bxtsrch_format">
								<option value="json" <?php selected( $options['params']['format'], 'json' ); ?>>json</option>
								<option value="xml" <?php selected( $options['params']['format'], 'xml' ); ?>>xml</option>
								<option value="html" <?php selected( $options['params']['format'], 'html' ); ?>>html</option>
							</select>												
						</label>
					
				</td>
			</tr>
			<tr>
				<th scope="row">exchars</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[params][exchars]" type="text" id="bxtsrch_exchars" value="<?php echo (isset($options['params']['exchars']) && $options['params']['exchars'] != '') ? $options['params']['exchars'] : '250'; ?>"/>						
						</label>
					
				</td>
			</tr>
			<tr>
				<th scope="row">exlimit</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[params][exlimit]" type="text" id="bxtsrch_exlimit" value="<?php echo (isset($options['params']['exlimit']) && $options['params']['exlimit'] != '') ? $options['params']['exlimit'] : '10'; ?>"/>						
						</label>
					
				</td>
			</tr>
			
			
			<tr>
				<th scope="row">exintro</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[params][exintro]" type="text" id="bxtsrch_exintro" value="<?php echo (isset($options['params']['exintro']) && $options['params']['exintro'] != '') ? $options['params']['exintro'] : ''; ?>"/>						
						</label>
					
				</td>
			</tr>
			<tr>
				<th scope="row">excontinue</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[params][excontinue]" type="text" id="bxtsrch_excontinue" value="<?php echo (isset($options['params']['excontinue']) && $options['params']['excontinue'] != '') ? $options['params']['excontinue'] : 'continue'; ?>"/>						
						</label>
					
				</td>
			</tr>
			<tr>
				<th scope="row">piprop</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[params][piprop]" type="text" id="bxtsrch_piprop" value="<?php echo (isset($options['params']['piprop']) && $options['params']['piprop'] != '') ? $options['params']['piprop'] : 'thumbnail'; ?>"/>						
						</label>
					
				</td>
			</tr>
			<tr>
				<th scope="row">pithumbsize</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[params][pithumbsize]" type="text" id="bxtsrch_pithumbsize" value="<?php echo (isset($options['params']['pithumbsize']) && $options['params']['pithumbsize'] != '') ? $options['params']['pithumbsize'] : '120'; ?>"/>						
						</label>
					
				</td>
			</tr>
			<tr>
				<th scope="row">pilimit</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[params][pilimit]" type="text" id="bxtsrch_pilimit" value="<?php echo (isset($options['params']['pilimit']) && $options['params']['pilimit'] != '') ? $options['params']['pilimit'] : '10'; ?>"/>						
						</label>
					
				</td>
			</tr>
			<tr>
				<th scope="row">titles</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[params][titles]" type="text" id="bxtsrch_titles" value="<?php echo (isset($options['params']['titles']) && $options['params']['titles'] != '') ? $options['params']['titles'] : ''; ?>"/>						
						</label>
					
				</td>
			</tr>
			<tr>
				<th scope="row">generator</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[params][generator]" type="text" id="bxtsrch_generator" value="<?php echo (isset($options['params']['generator']) && $options['params']['generator'] != '') ? $options['params']['generator'] : 'search'; ?>"/>						
						</label>
					
				</td>
			</tr>
			<tr>
				<th scope="row">gsrsearch</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[params][gsrsearch]" type="text" id="bxtsrch_gsrsearch" value="<?php echo (isset($options['params']['gsrsearch']) && $options['params']['gsrsearch'] != '') ? $options['params']['gsrsearch'] : ''; ?>"/>						
						</label>
					
				</td>
			</tr>
			<tr>
				<th scope="row">gsrlimit</th>
				<td>
					
						<label>
							<input class="widefat" name="bxtsrch_options[params][gsrlimit]" type="text" id="bxtsrch_gsrlimit" value="<?php echo (isset($options['params']['gsrlimit']) && $options['params']['gsrlimit'] != '') ? $options['params']['gsrlimit'] : '10'; ?>"/>						
						</label>
					
				</td>
			</tr>
		</table>-->
		
		
	</div>

	
