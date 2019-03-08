<?php 
/* Yoast SEO Plugin SC filters */
add_filter('wpseo_title', 'do_shortcode');
add_filter('wpseo_metadesc', 'do_shortcode');
add_filter('wpseo_metakey', 'do_shortcode');

add_filter('wpseo_strip_shortcode', 'run_shortcodes_in_meta_desc', 100);


function run_shortcodes_in_meta_desc( $text ) {
	return $text;
} 


/* Gravity Form Options */
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

add_filter('pre_option_rg_gforms_disable_css', '__return_true');

add_filter( 'gform_get_form_filter', 'do_shortcode', 11 );




/* Subscribe by Email Options */
function eng_dequeue_sbe_styles() {
   wp_dequeue_style( 'subscribe-by-email-widget-css' );
}
add_action( 'wp_enqueue_scripts', 'eng_dequeue_sbe_styles', 9999 );
?>