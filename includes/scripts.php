<?php

/********************************
* Add Scrips
********************************/


function bxt_enqueuelib() {
	
	global $query;
	$query =  (get_search_query() !== "") ? get_search_query() : '' ; 
	$bxttoptions['s'] = $query;
	
	wp_enqueue_script('knockoutjs', bxtgooglesearch.'/lib/knockout-3.1.0.js', array('jquery'));	
	
	
	if(isset($query) && $query != ''){
	
		wp_register_script( 'bxt_wiki_ext', 'http://www.google.com/jsapi?key='. ($bxttoptions['key'] != ''? $bxttoptions['key'] : 'AIzaSyBi5wR618yBfgz9p388VhKE2gDn_-R5Gdo')  );
		wp_register_script( 'bxt_wiki', bxtgooglesearch.'/js/wiki.js' );
		wp_register_script( 'bxt_js_search', bxtgooglesearch.'/js/search.js' );
		wp_register_script( 'bxt_model_search', bxtgooglesearch.'/js/models/model-search.js' );
		
			
		wp_enqueue_script(array('jquery', 'bxt_wiki_ext'));
		wp_enqueue_script(array('jquery', 'bxt_wiki'));		
		wp_localize_script( 'bxt_js_search', 'bxt_options', $bxttoptions);
		wp_enqueue_script(array('jquery', 'bxt_js_search'));
		wp_enqueue_script(array('jquery', 'bxt_model_search'));		
		
		wp_register_style( 'bxt_pagination', bxtgooglesearch. '/css/pagination.css' );		
		wp_enqueue_style( 'bxt_pagination');
		

	}	
	
}
add_action('wp_enqueue_scripts', bxt_enqueuelib);

