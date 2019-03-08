<?php 
/* Add Text Spans for additional menu structure */	
function eng_menu_span( $item_output, $item, $depth, $args ) {
	return preg_replace( '~(<a[^>]*>)([^<]*)</a>~', '$1<span class="menu-item-text">$2</span></a>', $item_output);
}
add_filter( 'walker_nav_menu_start_el', 'eng_menu_span', 10, 4 );



/* Add Mobile Menu HTML */	
function eng_wnm_html_items_wrap($mobile_toggle = null, $mobile_logo = null) {
	if ( $mobile_logo == 'mobile-logoURL' ) :
		$output .= eng_return_logo('menu-mobile');
		
	else :	
		$output .= '<a href="' . eng_url() . '"><img src="' . $mobile_logo . '" alt="" /></a>';
		
	endif;
	
	
	if ( $mobile_toggle == 'mobile-toggle' ) :
		$output .= '
			<div id="%1$s-mobile-toggle" class="menu-mobile-toggle">
				<div class="menu-mobile-toggle-bar1 menu-mobile-toggle-bar"></div>
				<div class="menu-mobile-toggle-bar2 menu-mobile-toggle-bar"></div>
				<div class="menu-mobile-toggle-bar3 menu-mobile-toggle-bar"></div>
			</div>
			
		';
	endif;
	
	$output .= '<ul id="%1$s" class="%2$s">%3$s</ul>';

	return $output;
}


?>