<?php


/*
 * Register the settings
 */
 
 
 function bxt_save_features(){
 
	global $bxttoptions;
	
	$options = $bxttoptions;
	$list = $bxttoptions['features'];
	$new_list = array();
	$new_update = $_POST['bxt-list-item'];
	
	
	foreach ($new_update as $v ){
		$new_list[$v] = $list[$v];
		//array_push($new_list, $list[$v]);
	}
	$options['active'] = $new_list;	
	
	print_r($new_update);
	update_option('bxt_options', $options);
	die(); 
	
 }
 add_action('wp_ajax_bxt_update_features','bxt_save_features');
 
 
 
 
  function bxt_save_key(){
 
	global $bxttoptions;
	
	$options = $bxttoptions;
	$key = $bxttoptions['key'];	
	
	
	
	$new_key = $_POST['bxt_key'];
	$options['key'] = $new_key;	
	update_option('bxt_options', $options);
	
	die(); 
	
 }
 add_action('wp_ajax_bxt_update_key','bxt_save_key');


