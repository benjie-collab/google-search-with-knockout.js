<?php


/*
 * Register the settings
 */
function bxt_options_validate($args){  	
	if(!isset($args['bxt_key']) || $args['bxt_key']==''){
        //add a settings error because the email is invalid and make the form field blank, so that the user can enter again
        $args['bxt_key'] = '';
		add_settings_error('bxt_options', 'bxt_invalid_key', 'You need to provide your API Key.!', $type = 'error');   
    }	
    //make sure you return the args
    return $args;
}

function bxt_admin_scripts() {
   /*
	* It will be called only on your plugin admin page, enqueue our stylesheet here
	*/		
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-tabs');
	
	wp_enqueue_script('update-list', bxtgooglesearch . '/js/update-list.js');	
	wp_register_style( 'bxtStylesheet', bxtgooglesearch. '/css/bxtsrch-admin.css' );
	wp_enqueue_style( 'bxtStylesheet' );
	wp_register_style( 'fontawesome', 'http:////netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', '', '4.0.3', 'all' );
	wp_enqueue_style('fontawesome'); 
	
	
   }   


//The markup for your plugin settings page
function bxt_admin_page_callback(){ 
	ob_start();
	?>
    <div class="wrap" id="bxt-option-page">				
		<h2>Custom Search Settings</h2>

		<?php
		include( plugin_dir_path( __FILE__ ) . 'search-options.php');		
		
		include( plugin_dir_path(__FILE__) . 'data/tb-websearch.php');
		include( plugin_dir_path(__FILE__) . 'data/tb-blogsearch.php');
		include( plugin_dir_path(__FILE__) . 'data/tb-booksearch.php');
		include( plugin_dir_path(__FILE__) . 'data/tb-imagesearch.php');
		include( plugin_dir_path(__FILE__) . 'data/tb-newssearch.php');
		include( plugin_dir_path(__FILE__) . 'data/tb-patentsearch.php');
		include( plugin_dir_path(__FILE__) . 'data/tb-videosearch.php');	
	?>
	</div>
<?php echo  ob_get_clean();

	}


function bxt_admin_page(){
	add_thickbox();
	add_options_page( 'Custom Search For Wordpress', 'Custom Search', 'manage_options', 'bxt', 'bxt_admin_page_callback' );	
	add_action( 'admin_enqueue_scripts', 'bxt_admin_scripts' ); 	
}
add_action('admin_menu', 'bxt_admin_page');


function bxt_register_settings(){
    register_setting('bxt_options', 'bxt_options', 'bxt_options_validate');		
}
add_action('admin_init', 'bxt_register_settings');

?>
