<?php


/*
 * Register the settings
 */
 


add_thickbox(); 
 
add_action('admin_init', 'bxtsrch_register_settings');
function bxtsrch_register_settings(){
    //this will save the option in the wp_options table as 'bxtsrch_options'
    //the third parameter is a function that will validate your input values
    register_setting('bxtsrch_options', 'bxtsrch_options', 'bxtsrch_options_validate');		
}


/*
 * Add the admin page
 */
add_action('admin_menu', 'bxtsrch_admin_page');
function bxtsrch_admin_page(){
    //add_menu_page('bxtsrch Settings', 'bxtsrch', 'administrator', 'bxtsrch-settings', 'bxtsrch_admin_page_callback');
	add_options_page( 'Custom Search For Wordpress', 'Custom Search', 'manage_options', 'bxtsrch', 'bxtsrch_admin_page_callback' );
	
	add_action( 'admin_enqueue_scripts', 'bxtsrch_admin_styles' ); 
	
}



function bxtsrch_options_validate($args){
    //$args will contain the values posted in your settings form, you can validate them as no spaces allowed, no special chars allowed or validate emails etc.
    /**if(!isset($args['bxtsrch_email']) || !is_email($args['bxtsrch_email'])){
        //add a settings error because the email is invalid and make the form field blank, so that the user can enter again
        $args['bxtsrch_email'] = '';
		add_settings_error('bxtsrch_settings', 'bxtsrch_invalid_email', 'Please enter a valid email!', $type = 'error');   
    }**/
	
	
	if(!isset($args['key']) || $args['key']==''){
        //add a settings error because the email is invalid and make the form field blank, so that the user can enter again
        $args['key'] = '';
		add_settings_error('bxtsrch_options', 'bxtsrch_invalid_key', 'You need to provide your API Key.!', $type = 'error');   
    }
	
    //make sure you return the args
    return $args;
}




function bxtsrch_admin_styles() {
       /*
        * It will be called only on your plugin admin page, enqueue our stylesheet here
        */	
	
		wp_register_style( 'bxtsrchStylesheet', plugins_url( 'bxtsrch-admin.css' , __FILE__ )   );
        wp_enqueue_style( 'bxtsrchStylesheet' );
		
		
		
   }
   

//Display the validation errors and update messages
/*
 * Admin notices
 
add_action('admin_notices', 'bxtsrch_admin_notices');
function bxtsrch_admin_notices(){
   settings_errors();
}*/

//The markup for your plugin settings page
function bxtsrch_admin_page_callback(){ ?>
    <div class="wrap" id="bxtsrch-option-page">
		<h2>Custom Search Settings</h2>
		<?php
		include( plugin_dir_path( __FILE__ ) . 'search-options.php');
		include( plugin_dir_path( __FILE__ ) . 'widget-options.php');
		?>
	</div>
<?php }
?>
