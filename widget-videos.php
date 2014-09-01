<?php
/* Google Images Widget
*/



class gg_vids_plugin extends WP_Widget {

	// constructor
	function gg_vids_plugin() {
		parent::WP_Widget(false, $name = __('Google Videos', 'ggvids_widget_plugin') );
	}

	// widget form creation
	function form($instance) {	
		// Check values
		if( $instance) {
			 $title = esc_attr($instance['title']);
			 $id = esc_attr($instance['id']);
			 $textarea = esc_textarea($instance['textarea']);
		} else {
			 $title = '';
			 $id = '';
			 $textarea = '';
		}
		?>

		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ggvids_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Container ID:', 'ggvids_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Textarea:', 'ggvids_widget_plugin'); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
		</p>
		<?php
	}

	// widget update
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
			  // Fields
			  $instance['title'] = strip_tags($new_instance['title']);
			  $instance['id'] = strip_tags($new_instance['id']);
			  $instance['textarea'] = strip_tags($new_instance['textarea']);
			 return $instance;
		}

		// widget display
		function widget($args, $instance) {
			extract( $args );
		   // these are the widget options
		   $title = apply_filters('widget_title', $instance['title']);
		   $id = $instance['id'];
		   $textarea = $instance['textarea'];
		   echo $before_widget;
		   // Display the widget
		   echo '<div class="widget-text ggvids_widget_plugin_box widget_twentyfourteen_ephemera">';
   
		   
		   // Check if title is set
		   if ( $title ) {
			  echo $before_title . $title . $after_title;
		   }

		   
		   // Check if textarea is set
		   if( $textarea ) {
			 echo '<p class="ggvids_widget_plugin_textarea">'.$textarea.'</p>';
		   }
		   
		   $instance['id'] = $instance['id']!=='' ? substr($instance['id'], 1) : 'grid-gallery';
		   
		   echo 
				'<div id="' . $instance['id'] . '" class="grid-gallery">' .
					'<ol data-bind="foreach:  videoResult">' .
						'<li>' .
						'<article class="post type-post hentry">' .
							'<div class="entry-content">' .
								'<!-- ko if: typeof(playUrl) != "undefined" -->' .
								'<iframe data-bind="attr: { src:  url.replace(\'http://www.youtube.com/watch?v=\', \'http://www.youtube.com/embed/\')  , type: videoType }" type="text/html" webkitAllowFullScreen allowFullScreen allowTransparency="true" mozallowfullscreen width="100%" height="203" frameborder="0" class="vzaar-video-player"></iframe>' .
								'<!-- /ko -->' . 
								'<!-- ko if: typeof(playUrl) == "undefined" -->' .
								'<a rel="bookmark" data-bind="attr: { href: url }">' .
								'<img data-bind="attr: {src: tbUrl}" class="aligncenter"/>' .
								'</a>' .
								'<!-- /ko -->' . 
							'</div>' .							
							'<header class="entry-header">' .
								'<div class="entry-meta">' .
									'<h4 class="entry-title">' .
										'<!-- ko if: typeof(playUrl) != "undefined" -->' .
										'<a rel="bookmark" data-bind="html: title, attr: { href: playUrl }"></a>' .
										'<!-- /ko -->' . 
										'<!-- ko if: typeof(playUrl) == "undefined" -->' .
										'<a rel="bookmark" data-bind="html: title, attr: { href: url }"></a>' .
										'<!-- /ko -->' . 
									'</h4>' .
									'<span class="entry-date">' .
										'<a rel="bookmark" href="#">' .
										'<time data-bind="text: published" class="entry-date"></time>' .
										'</a>' .
									'</span> ' .
									' | ' .
									'<span class="author vcard">' .
										'<a rel="author" data-bind="text: publisher" class="url fn n"></a>' .
									'</span>' .	
									' | ' .
									'<span class="author vcard" data-bind="text: duration">' .
									'</span>' .	
								'</div>' .
							'</header>' .
						'</article>' .
						'</li>' .
					'</ol>' .
				'</div>';
				
		   
		   echo '</div>';
		   echo $after_widget;
		   
		   
		   gg_vids_enqueuescripts_fn($instance);
		}
}
// register widget
add_action('widgets_init', create_function('', 'return register_widget("gg_vids_plugin");'));






function gg_vids_enqueuescripts_fn($args){	
	add_action('wp_enqueue_scripts', gg_vids_enqueuescripts($args));
}

function gg_vids_enqueuescripts($args){	
	
	/**
	wp_register_script( 'modernizr', bxtgooglesearch.'/lib/GridGallery/js/modernizr.custom.js' );
	wp_register_script( 'imagesloaded', bxtgooglesearch.'/lib/GridGallery/js/imagesloaded.pkgd.min.js' );
	wp_register_script( 'masonry', bxtgooglesearch.'/lib/GridGallery/js/masonry.pkgd.min.js' );
	wp_register_script( 'classie', bxtgooglesearch.'/lib/GridGallery/js/classie.js' );
	wp_register_script( 'cbpGridGallery', bxtgooglesearch.'/lib/GridGallery/js/cbpGridGallery.js' );
	wp_register_script( 'ggvids_widget_gallery', bxtgooglesearch.'/js/gallery.js' );
	
		
	wp_enqueue_script(array('jquery', 'modernizr'));
	wp_enqueue_script(array('jquery', 'imagesloaded'));
	wp_enqueue_script(array('jquery', 'masonry'));
	wp_enqueue_script(array('jquery', 'classie'));
	wp_enqueue_script(array('jquery', 'cbpGridGallery'));
	
	wp_localize_script( 'ggvids_widget_gallery', 'ggvids_options', $args);
	wp_enqueue_script(array('jquery', 'ggvids_widget_gallery'));**/
		
}






function gg_vids_enqueuestyles() {

       /*
        * It will be called only on your plugin admin page, enqueue our stylesheet here
        */		
		wp_register_style( 'cbpGridGalleryStylesheet', bxtgooglesearch.'/lib/GridGallery/css/component.css'   );
        wp_enqueue_style( 'cbpGridGalleryStylesheet' );	
		
   }
add_action('wp_enqueue_scripts', gg_vids_enqueuestyles);












