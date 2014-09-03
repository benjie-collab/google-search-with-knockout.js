<?php
/*
Plugin Name: Benznext Google Search
Description: Replace Wordpress Search with Google Search
Author: Benjie Bantecil
Version: 0.1
*/




define('bxtgooglesearch', WP_PLUGIN_URL."/".dirname( plugin_basename( __FILE__ ) ) );

$bxttoptions = get_option( 'bxt_options' );


/********************************
* Includes
********************************/


include( dirname( __FILE__ ) . '/includes/scripts.php');
include( dirname( __FILE__ ) . '/includes/process-ajax.php');
include( dirname( __FILE__ ) . '/includes/admin-page.php');


include( plugin_dir_path( __FILE__ ) . 'widget-images.php');
include( plugin_dir_path( __FILE__ ) . 'widget-videos.php');
include( plugin_dir_path( __FILE__ ) . 'widget-blog.php');
include( plugin_dir_path( __FILE__ ) . 'widget-news.php');
include( plugin_dir_path( __FILE__ ) . 'widget-books.php');
include( plugin_dir_path( __FILE__ ) . 'widget-patent.php');



/** GET json from external

$url = 'http://192.168.2.175:8016/xquery/src/getmappoints.xqy?radius=200&type=json&legend=crisis&geometric=polygon&geo=&subcategory=';


$body = array(
    'auth_token' => 'xxxxxx',
    'list_id' => 'xxxxx',
    'name' => 'Office',
    'campaign_id' => 'xxxxx',
);

$response = wp_remote_post($url, array(
    'body'=>$body, 
    'sslverify' => false // this is needed if your server doesn't have the latest CA certificate lists
    ) );
if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
    // error handling goes here
}
$results = wp_remote_retrieve_body( $response );
// $results has the actual results in it

GET json from external **/





/**

function ajaxloadpost_enqueuescripts() {	
    wp_enqueue_script('ajaxloadpost', bxtgooglesearch.'/js/ajaxloadpost.js', array('jquery'));
    wp_localize_script( 'ajaxloadpost', 'ajaxloadpostajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_enqueue_scripts', ajaxloadpost_enqueuescripts);

function ajaxloadpost_ajaxhandler() {
    if ( !wp_verify_nonce( $_POST['nonce'], "ajaxloadpost_nonce")) {
        exit("Wrong nonce");
    }
 
    $results = '';
    $content_post = get_post($_POST['postid']);
    $results = $content_post->post_content;
 
    die($results);
}
add_action( 'wp_ajax_nopriv_ajaxloadpost_ajaxhandler', 'ajaxloadpost_ajaxhandler' );
add_action( 'wp_ajax_ajaxloadpost_ajaxhandler', 'ajaxloadpost_ajaxhandler' );

function ajaxloadpost_show_latest_posts($number = '5'){
 
    $results ='';
    $the_query = new WP_Query( 'posts_per_page='.$number );
 
    while ( $the_query->have_posts() ) :
        $the_query->the_post();
        $nonce = wp_create_nonce("ajaxloadpost_nonce");
 
        $arguments =  get_the_ID().",'".$nonce."'";
 
        $link = ' <a onclick="ajaxloadpost_loadpost('.$arguments.');">'. get_the_title().'</a>';
 
        $result.= '<li>' . $link . '</li>';
    endwhile;
    wp_reset_postdata();
 
    $result.=  '<div id="loadpostresult"></div>';
 
    return $result;
}
 
function ajaxloadpost_shortcode_function( $atts ){
    return ajaxloadpost_show_latest_posts();
}
add_shortcode( 'AJAXLOADPOST', 'ajaxloadpost_shortcode_function' );


**/




/**
function mlsearch_start(){	
	$result = '';
	//get the older values, wont work the first time
	$options = get_option( 'bxtsrch_settings' ); 
	
	foreach ( $options as $key => $value ){
        $result .='<li>'.$key.' = '. $value .'</li>';
	}
    return '<ul>'.json_encode($options).'</ul>';
}
function mlsearch_shortcode_function( $atts ){
    return mlsearch_start();	
}
add_shortcode( 'mlsearch', 'mlsearch_shortcode_function' );



function bxtsrch_result(){	
    return '<div id="bxtsrch_result">' .
				'<div class="row listing-row bg-info p-0">' .	
					'<div class="col-md-12 bg-info">' .
						'<div class="ribbon-wrapper-red"><div class="ribbon-red">&nbsp;<span lang="en">Announcement</span></div></div>' .
						'<div data-interval="false" data-ride="carousel" data-wrap="false" class="carousel p-10" id="specialCarousel"> ' .    
						  '<div class="carousel-inner" data-bind="foreach: webResult">' .			
							'<div class="item" data-bind="css: { active: $index() === 0}" style="min-height: 150px;">' .
								'<div class="p-10">' .
								  '<h1 data-bind="html: title">Example headline.</h1>' .
								  '<small  class="muted" data-bind="html: url"></small>' .
								  '<p data-bind="html: content"></p>' .
								'</div>' .
							'</div>' .
							'</div>' .
							'<div class="text-right">' .
								'<a data-slide="prev" role="button" href="#specialCarousel" class="left"><i class="fa fa-chevron-circle-left"></i></a>' .
								'<a data-slide="next" role="button" href="#specialCarousel" class="right"><i class="fa fa-chevron-circle-right"></i></a>' .
							'</div>' .
						'</div>	' .		
					'</div>	' .	
				'</div>' .
				'<p class="text-right"><a href="#" class="text-muted"><small>Unsubscribe</small></a></p>' .			
				
				'<div class="row listing-row m-t-20 m-b-10"><small>About 581,000,000 results (0.36 seconds) </small></div>' .
				
				'<div data-bind="foreach: newsResult">' .
					'<div class="row listing-row ">' .
						'<div class="col-sm-2" data-bind="if : image!==null, css : { hidden: image === null } ">' .
							'<a class="thumbnail " href="#"><img alt="176 * 120" data-bind="attr: { src: image.tbUrl }"></a>' .
						'</div>' .

						'<div data-bind="css: { \'col-sm-12\' : image === null, \'col-sm-10\' : image !== null  }" >' .
							'<h3><a href="details.html" data-bind="html: title"></a></h3>' .
							'<!--<p class="muted" data-bind="html: url"></p>-->' .
							'<p class="muted"><span data-bind="text: publishedDate">Posted Feb 05, 2014</span> by <a class="underline" href="#" data-bind="text: publisher"></a></p>' .
							'<p data-bind="html: content"></p>' .							
						'</div>' .
					'</div>' .
				'</div>' .
				
				'<div class="featured-gallery no-padding">' .
					'<br/>' .
					'<h5 class="m-0"><a href="#"><span lang="en" class="text-capitalize">Image</span> <span lang="en">results</span></a></h5>' .
					'<div class="row listing-row" data-bind="foreach: imageResult">' .
						'<div data-bind="attr: {src: titleNoFormatting}" data-placement="top" data-toggle="tooltip" class="col-sm-2 col-xs-2 featured-thumbnail">' .
							'<a class="" href="#">' .
								'<img style="width: 100%; height: auto"  data-bind="attr: {src: tbUrl}"  alt="">' .
							'</a>' .
						'</div>' .
					'</div>' .
				'</div>' .
			'</div>';
}
function fn_bxtsrch_result( $atts ){
    return bxtsrch_result();	
}
add_shortcode( 'bxtsrch_result', 'fn_bxtsrch_result' );





function search_enqueuescripts(){	
	$bxttoptions['search']['s'] =  (get_search_query() !== ""? get_search_query() : '' ); 
	
	
	if(!empty($bxttoptions)){
		wp_register_script( 'bxtsrch_wiki_ext', 'http://www.google.com/jsapi?key='. ($bxttoptions['key'] != ''? $bxttoptions['key'] : 'AIzaSyBi5wR618yBfgz9p388VhKE2gDn_-R5Gdo')  );
		wp_register_script( 'bxtsrch_wiki', bxtgooglesearch.'/js/wiki.js' );
		wp_register_script( 'bxtsrch_js_search', bxtgooglesearch.'/js/search.js' );
		wp_register_script( 'bxtsrch_model_search', bxtgooglesearch.'/js/models/model-search.js' );
		
			
		wp_enqueue_script(array('jquery', 'bxtsrch_wiki_ext'));
		wp_enqueue_script(array('jquery', 'bxtsrch_wiki'));		
		wp_localize_script( 'bxtsrch_js_search', 'bxt_options', $bxttoptions);
		wp_enqueue_script(array('jquery', 'bxtsrch_js_search'));
		wp_enqueue_script(array('jquery', 'bxtsrch_model_search'));		
		
		wp_register_style( 'bxtsrch_pagination', plugins_url('css/pagination.css', __FILE__) );		
		wp_enqueue_style( 'bxtsrch_pagination');	

	}	
}
add_action('wp_enqueue_scripts', search_enqueuescripts);**/





	
function bgs_install(){

	$bxttoptions = get_option( 'bxt_options' );	
	if(!isset($bxttoptions)){
		$opts = array(
			"features" 	=> array(
						"WebSearch"		,
						"VideoSearch"	,
						"BlogSearch"	,
						"NewsSearch"	,
						"ImageSearch"	,
						"BookSearch"	,
						"PatentSearch"	),
			"active" 	=> array(),
			"key"		=> ""
		
		);
		
		add_option('bxt_options', $opts);	
	
	}
}
register_activation_hook(__FILE__, 'bgs_install');

/**
update_option('bxt_options', array(
			"features" 	=> array(
						"WebSearch"		,
						"VideoSearch"	,
						"BlogSearch"	,
						"NewsSearch"	,
						"ImageSearch"	,
						"BookSearch"	,
						"PatentSearch"	),
			"active" 	=> array(),
			"key"		=> ""
		
		));**/

/**



include( plugin_dir_path( __FILE__ ) . 'admin/administrator.php');**/












