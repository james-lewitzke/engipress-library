<?php 
if ( function_exists( 'add_theme_support' ) ) :
  add_theme_support( 'post-thumbnails' ); 
endif;


function eng_sc_cleanup( $content ) {
    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']'
    );
	
    return strtr( $content, $array );
}
add_filter( 'the_content', 'eng_sc_cleanup' );


/* Enable Excerpt Boxes on Pages */
add_post_type_support( 'page', 'excerpt' );
?>