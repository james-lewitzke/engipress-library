<?php
function eng_script_init() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'jquery-ui-widget' );
	wp_enqueue_script( 'jquery-ui-accordion' );
	wp_enqueue_script('comment-reply');
	
	if (! is_admin() ) :
	/* Styles */
	wp_register_style( 'core', eng_library_url() .'/css/core.css' );
	wp_enqueue_style( 'core' );
	wp_register_style( 'design-main', eng_library_url() .'/css/design-main.css' );
	wp_enqueue_style( 'design-main' );
	
	/* Scripts */
	wp_register_script( 'lib-jqueryfunctions', eng_library_url() .'/js/jqueryfunctions.js' );
	wp_enqueue_script( 'lib-jqueryfunctions');
    endif;
}
add_action('init', 'eng_script_init');


function eng_html5shiv() {
	echo '<!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> <![endif]-->'; 
}
add_action('wp_head', 'eng_html5shiv');
?>