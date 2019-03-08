<?php
/* General Functionality Filters */
add_filter('widget_text', 'do_shortcode');

add_filter('body_class', 'eng_classes_body');

add_filter('the_content', 'make_clickable');


/* Hide 3.0 Admin Bar */
if ( function_exists( 'show_admin_bar' ) ) :
	show_admin_bar(false);
endif;


/* Hide Menus from Editors in wp-admin */
function eng_user_roles() {
	if ( current_user_can('editor') ) :
		remove_menu_page('edit-comments.php'); 
		remove_menu_page('edit.php?post_type=popup'); 
		remove_menu_page('edit.php?post_type=wcp_carousel'); 
		remove_menu_page('themes.php'); 
		remove_menu_page('tools.php'); 
		remove_menu_page('cxl-options'); 
		
	endif;
}
add_action('admin_menu', 'eng_user_roles');
?>