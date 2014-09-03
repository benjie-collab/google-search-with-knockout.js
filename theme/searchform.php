<form action="<?php esc_url( home_url( '/' ) ); ?>" class="search-form" method="get" role="search">
	<label>
		<span class="screen-reader-text"><?php _x( 'Search for:', 'label' ); ?></span>
		<input type="search" title="Search for:" name="s" value="<?php echo get_search_query(); ?>" placeholder="Search..." class="search-field" data-bind="event: { keyup: enableDetails, mouseout: disableDetails }, value: s">
	</label>
	<input type="submit" value="<?php esc_attr_x( 'Search', 'submit button' ); ?>" class="search-submit">
</form>			