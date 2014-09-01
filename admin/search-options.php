	<div class="wrap">
		<form action="options.php" method="post">
		<?php
		settings_fields( 'bxtsrch_options' );
		do_settings_sections( __FILE__ );

		//get the older values, wont work the first time
		$options = get_option( 'bxtsrch_options' ); ?>	
		
		<br/>
		<h3>Google API Key</h3>
		
		<table class="widefat">
			<tr>				
				<td>					
					<label>
						<input class="widefat" placeholder="API Key" name="bxtsrch_options[key]" type="text" id="bxtsrch_key" value="<?php echo (isset($options['key']) && $options['key'] != '') ? $options['key'] : ''; ?>"/>						
					</label>		
					
				</td>
			</tr>
		</table>
		<p class="description">Get yours <a href="https://code.google.com/apis/console#:access" target="_blank">here</a>.</p>
		
		
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
						<input class="widefat" name="bxtsrch_options[features][WebSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['WebSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['WebSearch']) && $options['features']['WebSearch'] == 1) ? 'checked' : ''; ?>/>						
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
							<input class="widefat" name="bxtsrch_options[features][VideoSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['VideoSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['VideoSearch']) && $options['features']['VideoSearch'] == 1) ? 'checked' : ''; ?>/>
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
							<input class="widefat" name="bxtsrch_options[features][BlogSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['BlogSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['BlogSearch']) && $options['features']['BlogSearch'] == 1) ? 'checked' : ''; ?>/>
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
							<input class="widefat" name="bxtsrch_options[features][NewsSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['NewsSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['NewsSearch']) && $options['features']['NewsSearch'] == 1) ? 'checked' : ''; ?>/>
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
							<input class="widefat" name="bxtsrch_options[features][ImageSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['ImageSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['ImageSearch']) && $options['features']['ImageSearch'] == 1) ? 'checked' : ''; ?>/>
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
							<input class="widefat" name="bxtsrch_options[features][BookSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['BookSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['BookSearch']) && $options['features']['BookSearch'] == 1) ? 'checked' : ''; ?>/>
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
							<input class="widefat" name="bxtsrch_options[features][PatentSearch]" type="checkbox" id="" value="<?php echo (isset($options['features']['PatentSearch'])) ? 1 : 0; ?>" <?php echo (isset($options['features']['PatentSearch']) && $options['features']['PatentSearch'] == 1) ? 'checked' : ''; ?>/>
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
		
		</form>
		
		
	</div>

	
	
	<?php 
	
	include( plugin_dir_path(__FILE__) . 'data/tb-websearch.php');
	include( plugin_dir_path(__FILE__) . 'data/tb-blogsearch.php');
	include( plugin_dir_path(__FILE__) . 'data/tb-booksearch.php');
	include( plugin_dir_path(__FILE__) . 'data/tb-imagesearch.php');
	include( plugin_dir_path(__FILE__) . 'data/tb-newssearch.php');
	include( plugin_dir_path(__FILE__) . 'data/tb-patentsearch.php');
	include( plugin_dir_path(__FILE__) . 'data/tb-videosearch.php');
