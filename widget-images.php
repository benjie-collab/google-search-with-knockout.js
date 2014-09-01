<?php
/* Google Images Widget
*/

class gg_imgs_plugin extends WP_Widget {

	// constructor
	function gg_imgs_plugin() {
		parent::WP_Widget(false, $name = __('Google Images', 'ggimgs_widget_plugin') );
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
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ggimgs_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Container ID:', 'ggimgs_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Textarea:', 'ggimgs_widget_plugin'); ?></label>
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
		   echo '<div class="widget-text ggimgs_widget_plugin_box ">';   
		   
		   // Check if title is set
		   if ( $title ) {
			  echo $before_title . $title . $after_title;
		   }

		   
		   // Check if textarea is set
		   if( $textarea ) {
			 echo '<p class="ggimgs_widget_plugin_textarea">'.$textarea.'</p>';
		   }
		   
		   $instance['id'] = $instance['id']!=='' ? substr($instance['id'], 1) : 'grid-gallery';
		   
		   echo 
				'<div id="' . $instance['id'] . '" class="grid-gallery">' .
					'<section class="grid-wrap">' .
						'<ul class="grid" data-bind="foreach:  imageResult">' .
							'<!-- ko if: $index() == 0 --><li class="grid-sizer"></li><!-- /ko --> <!-- for Masonry column width -->' .
							'<li>' .
								'<figure>' .
									'<img data-bind="attr: { src: url, title:  titleNoFormatting}"/>' .
									//'<figcaption><h3 data-bind="text: titleNoFormatting">Letterpress asymmetrical</h3></figcaption>' .
								'</figure>' .
							'</li>' .
						'</ul>' .
					'</section>' .
					'<section class="slideshow">' .
					'<ul data-bind=" foreach: { data: imageResult, afterRender: imgrdHandler}, gridGallery: imageResult">' .
						'<li>' .
							'<figure>' .
								'<figcaption>' .
									'<h3><a data-bind="href: unescapedUrl, html: title"></a></h3>' .
									'<p data-bind="html: content"></p>' .
								'</figcaption>' .
								'<img data-bind="attr: { src: url, title:  titleNoFormatting}"/>' .
							'</figure>' .
						'</li>' .
					'</ul>' .
					'<nav>' .
						'<span class="icon nav-prev"></span>' .
						'<span class="icon nav-next"></span>' .
						'<span class="icon nav-close"></span>' .
					'</nav>' .
					'<div class="info-keys icon">Navigate with arrow keys</div>' .
					'</section>' .
				'</div>';
				
		   
		   echo '</div>';
		   echo $after_widget;
		   
		   
		   gg_images_enqueuescripts_fn($instance);
		}
}

function gg_images_enqueuescripts_fn($args){	
	add_action('wp_enqueue_scripts', gg_images_enqueuescripts($args));
}

function gg_images_enqueuescripts($args){	
	
	wp_register_script( 'modernizr', bxtgooglesearch.'/lib/GridGallery/js/modernizr.custom.js' );
	wp_register_script( 'imagesloaded', bxtgooglesearch.'/lib/GridGallery/js/imagesloaded.pkgd.min.js' );
	wp_register_script( 'masonry', bxtgooglesearch.'/lib/GridGallery/js/masonry.pkgd.min.js' );
	wp_register_script( 'classie', bxtgooglesearch.'/lib/GridGallery/js/classie.js' );
	wp_register_script( 'cbpGridGallery', bxtgooglesearch.'/lib/GridGallery/js/cbpGridGallery.js' );
	wp_register_script( 'ggimgs_widget_gallery', bxtgooglesearch.'/js/gallery.js' );
	
		
	wp_enqueue_script(array('jquery', 'modernizr'));
	wp_enqueue_script(array('jquery', 'imagesloaded'));
	wp_enqueue_script(array('jquery', 'masonry'));
	wp_enqueue_script(array('jquery', 'classie'));
	wp_enqueue_script(array('jquery', 'cbpGridGallery'));
	
	wp_localize_script( 'ggimgs_widget_gallery', 'ggimgs_options', $args);
	wp_enqueue_script(array('jquery', 'ggimgs_widget_gallery'));
		
}

function gg_images_enqueuestyles() {

       /*
        * It will be called only on your plugin admin page, enqueue our stylesheet here
        */		
		wp_register_style( 'cbpGridGalleryStylesheet', bxtgooglesearch.'/lib/GridGallery/css/component.css'   );
        wp_enqueue_style( 'cbpGridGalleryStylesheet' );	
		
   }
   
   
// register widget
if(isset($bxttoptions['features']['ImageSearch']) && $bxttoptions['features']['ImageSearch'] == 1){
	add_action('widgets_init', create_function('$bxttoptions', 'return register_widget("gg_imgs_plugin");'));
	add_action('wp_enqueue_scripts', gg_images_enqueuestyles);
}












