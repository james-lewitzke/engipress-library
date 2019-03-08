<?php
function eng_header() {
	eng_header_start(); 
	eng_head_page_meta(); 
	
	wp_head();
	if ( eng_option('code', 'codebeforehead') ) :
		echo ( eng_option('code', 'codebeforehead') );
	
	endif;
	eng_header_finish(); 
}


function eng_footer() {
	eng_footer_start(); 
	wp_footer();
	if ( eng_option('code', 'codebeforebody') ) :
		echo ( eng_option('code', 'codebeforebody') );
	
	endif;
	eng_footer_finish(); 
}


function eng_header_start() {
	$html = '
	<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>' . wp_title('', false) . '</title>
	<meta http-equiv="Content-Type" content="' . get_bloginfo('html_type') . '" charset="' . get_bloginfo('charset') . '" />
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
	';
	
	echo $html;
}


function eng_header_finish() {
	$html = '
	</head>
	 
	<body id="body-' . get_post_type() . '" class="' . join(' ' , get_body_class() ) . '">
	';
	
	echo $html;
}


function eng_footer_start() {
	$html = '
	';
	
	echo $html;
}


function eng_footer_finish() {
	$html = '
	</body>
	</html>
	';
	
	echo $html;
}


function eng_header_htmllang() {
	$html = '
		<link rel="alternate" href="' . eng_url() . '" hreflang="x-default" />
		<link rel="alternate" href="' . eng_url() . '" hreflang="en" />
	';
	
	echo $html;
}


function eng_head_page_meta() {
	global $post;
	
	$cf_head_code_afteropeninghead = do_shortcode(get_post_meta($post->ID, 'head-code-afteropeninghead', true));
	
	$html = $cf_head_code_afteropeninghead;
	
	echo $html;
}


function eng_classes_body($body_classes) {
	if (  ((function_exists( 'has_sidebar_left' )) && (has_sidebar_left()) ) && ((function_exists( 'has_sidebar_right' )) && (has_sidebar_right()) )  ) :
		$body_classes[] = 'has-sidebar-left-and-right';
	
	elseif ( (function_exists( 'has_sidebar_left' )) && (has_sidebar_left()) ) :
		$body_classes[] = 'has-sidebar-left';

		
	elseif ( (function_exists( 'has_sidebar_right' )) && (has_sidebar_right()) ) :
		$body_classes[] = 'has-sidebar-right';
		
	else :
		$body_classes[] = 'has-no-sidebars';
	
	endif;
	
	
	if ( (function_exists( 'has_system_panels' )) && (has_system_panels()) ) :
		$body_classes[] .= 'has-system-panels';
		
	endif;
	
	
	if ( is_blog() ) :
		$body_classes[] .= 'blog';
	
	elseif ( get_post_types() ) :
		if ( is_page_template() || is_tax() || is_tax_wildcard() ) :
			foreach ( get_post_types() as $posttype ) :
				if ( is_page_template('template-cpt-' . $posttype . '.php') || is_page_template('template-cpt-' . $posttype . '-archives.php') || is_tax($posttype . '-categories') || is_tax_wildcard( $posttype ) ) : 
					$body_classes[] .= $posttype;
				endif;
			endforeach;
		
		else :
			$body_classes[] .= get_post_type();
	
		endif;
	
	endif;
	
	
	if ( is_blog_list() ) :
		$body_classes[] .= 'blog-list';
	
	endif;
	
	
	if ( is_design_main() ) :
		$body_classes[] .= 'design-main';
	
	endif;
	
	
	if ( is_design_main_list() ) :
		$body_classes[] .= 'design-main-list';
		
	elseif ( is_design_main_single() ) :
		$body_classes[] .= 'design-main-single';
	
	endif;
	
	
	if ( is_default_page() ) :
		$body_classes[] .= 'default-page';
	
	endif;
	

	return $body_classes;
}


function eng_classes_main() {
	$main_classes = 'class="';
	
	if ( (function_exists( 'has_system_panels' )) && (has_system_panels()) ) :
		$main_classes .= 'system-panels';
		
	else :
		$main_classes .= 'wrap';
	
	endif;

	$main_classes .= ' floatarea"';
	
	echo $main_classes;
}


function eng_classes_content_main() {
	$content_main_classes = 'class="content';
	
	if (  ((function_exists( 'has_sidebar_left' )) && (has_sidebar_left()) ) && ((function_exists( 'has_sidebar_right' )) && (has_sidebar_right()) )  ) :
		$content_main_classes .= ' col-middle';
	
	elseif ( (function_exists( 'has_sidebar_left' )) && (has_sidebar_left()) ) :
		$content_main_classes .= ' col-middle-full';

		
	elseif ( (function_exists( 'has_sidebar_right' )) && (has_sidebar_right()) ) :
		$content_main_classes .= ' col-middle-full';
		
	else :
		$content_main_classes .= ' col-full';
	
	endif;

	$content_main_classes .= '"';
	
	echo $content_main_classes;
}


function eng_return_logo($location) {
	$html = '<div id="logo';

	if ( $location ) : 
		$html .= '-' . $location;
		
	endif;
	
	$html .= '" class="logo">';
	
	if ( eng_option('ageneral', 'logoURL') ) :
		$html .= '
			<a href="' . eng_url() . '">
				<img src="' . eng_option('ageneral', 'logoURL') . '" alt="" />
			</a>
		';
	
	else : 
		$html .= '
			<h1 id="site-maintitle';
			
			if ( $location ) : 
				$html .= '-' . $location;
				
			endif;
			
			$html .= '" class="primarytitle">
				<a href="' . eng_url() . '">
					' . get_bloginfo('name') . '
				</a>
			</h1>
		';
	
	endif;
	
	$html .= '</div>';
	
	return $html;
}


function eng_logo($location = null) {
	echo eng_return_logo($location);
}


function eng_return_sitename($location) {
	$html = '<h1 id="sitename';

	if ( $location ) : 
		$html .= '-' . $location;
		
	endif;
	
	$html .= '" class="sitename">';
	
	if ( eng_option('phrase', 'sitename') ) : 
		$html .= eng_option('phrase', 'sitename'); 
	
	else : 
		$html .= get_bloginfo('name');
	
	endif;
	
	$html .= '</h1>';
	
	return $html;
}


function eng_sitename($location = null) {
	echo eng_return_sitename($location);
}


function eng_return_tagline($location) {
	$html = '<h2 id="tagline';

	if ( $location ) : 
		$html .= '-' . $location;
		
	endif;
	
	$html .= '" class="tagline">';
	
	if ( eng_option('phrase', 'tagline') ) : 
		$html .= eng_option('phrase', 'tagline'); 
	
	else : 
		$html .= 'No Tagline Available';
	
	endif;
	
	$html .= '</h2>';
	
	return $html;
}


function eng_tagline($location = null) {
	echo eng_return_tagline($location);
}


function eng_return_designmain_tags_list($location) {
	$html = '<div id="designmain-tags';

	if ( $location ) : 
		$html .= '-' . $location;
		
	endif;
	
	$html .= '" class="designmain-tags"><ul class="designmain-tags-list">';
	
	$tags = get_tags();
	
	foreach ( $tags as $tag ) :
		$tag_link = get_tag_link( $tag->term_id );
				
		$html .= '
		<li class="designmain-tag-list-item">
			<a href="' . $tag_link . '" title="' . $tag->name . ' Tag" class="tag-' . $tag->slug . '">
			' . $tag->name . '
			</a>
		</li>
		';
	endforeach;
	
	$html .= '</ul></div>';
	
	return $html;
}


function eng_designmain_tags_list($location = null) {
	echo eng_return_designmain_tags_list($location);
}


function eng_return_title($location) {
	$html = '<h2 id="blog-title';

	if ( $location ) : 
		$html .= '-' . $location;
		
	endif;
	
	$html .= '" class="blog-title">';
	
		
	
		if ( eng_option('phrase', 'blogtitle') ) : 
			$html .= eng_option('phrase', 'blogtitle'); 
		
		else : 
			$html .= 'blog';
		
		endif;
	
	$html .= '</h2>';
	
	return $html;
}


function eng_title($location = null) {
	echo eng_return_title($location);
}


function eng_return_primary_title() {
	global $post;
	
	$html = '
	<div id="primarytitle-container" class="primarytitle-area">
	';

	
	if ( is_search() ) :
		$html .= '<h2 id="primarytitle-search" class="primarytitle">Search Results for &#39;' . get_search_query() . '&#39:</h2>';
		
	elseif ( is_author() ) :
		$html .= '<h2 id="primarytitle-author" class="primarytitle">Posts by ' . get_the_author_meta('display_name') . '</h2>';
		
	elseif ( is_category() ) :
		$html .= '<h2 id="primarytitle-category" class="primarytitle">' . single_cat_title('', false) . '</h2>';

	elseif ( is_tax() ) :
		$html .= '<h2 id="primarytitle-taxonomy" class="primarytitle">' . single_cat_title('', false) . '</h2>';

	elseif ( is_archive() ) :
		$html .= '<h2 id="primarytitle-archives" class="primarytitle">Monthly Archives for ' . get_the_date('F, Y') . '</h2>';
		
	elseif ( is_page() ) :
		$html .= '<h2 id="primarytitle-page" class="primarytitle">' . get_the_title($post->ID) . '</h2>';
		
	elseif ( is_blog() ) :
		$html .= '<h2 id="primarytitle-blog" class="primarytitle">Blog</h2>';
		
	else :
		$html .= '<h2 id="primarytitle-general" class="primarytitle">' . get_the_title($post->ID) . '</h2>';

	endif;
	

	$html .= '
	</div>
	';
	
	return $html;
}


function eng_primary_title() {
	echo eng_return_primary_title();
}


function eng_return_primary_desc() {
	global $post;
	
	$html = '
	<div id="primarydesc-container" class="primarydesc-area">
	';

	if ( is_tax() ) :
		$html .= '<div id="primarydesc-taxonomy" class="primarydesc">' . category_description() . '</div>';
		
	else :
		$html .= '<h1 id="primarydesc-general" class="primarydesc">' . get_the_excerpt($post->ID) . '</h1>';

	endif;
	

	$html .= '
	</div>
	';
	
	return $html;
}


function eng_primary_desc() {
	echo eng_return_primary_desc();
}


function eng_return_parent_title() {
	global $post;
	
	$html = '
	<div id="parenttitle-container" class="parenttitle-area">
	';
		
	if ( is_page() ) :
		$html .= '<h2 id="parenttitle-page" class="parenttitle">' . get_the_title($post->post_parent) . '</h2>';
		
	else :
		$html .= '<h2 id="parenttitle-general" class="parenttitle">' . get_the_title($post->post_parent) . '</h2>';

	endif;
	

	$html .= '
	</div>
	';
	
	return $html;
}


function eng_parent_title() {
	echo eng_return_parent_title();
}



function eng_return_phone($location) {
	$html = '<div id="phone';

	if ( $location ) : 
		$html .= '-' . $location;
		
	endif;
	
	$html .= '" class="phone">';
	
	if ( eng_option('phrase', 'phoneprefix') ) : 
		$html .= '<span class="phone-prefix">' . eng_option('phrase', 'phoneprefix') . '</span>'; 
	
	endif;
	
	if ( eng_option('phrase', 'phone') ) : 
		$html .= '<a href="tel:' . eng_option('phrase', 'phone') . '">' . eng_option('phrase', 'phone') . '</a>'; 
	
	else : 
		$html .= 'No Phone Available';
	
	endif;
	
	$html .= '</div>';
	
	return $html;
}


function eng_phone($location = null) {
	echo eng_return_phone($location);
}


function eng_return_address($location) {
	$html = '<div id="address';

	if ( $location ) : 
		$html .= '-' . $location;
		
	endif;
	
	$html .= '" class="address">';
	
	if ( eng_option('phrase', 'address') ) : 
		$html .= eng_option('phrase', 'address'); 
	
	else : 
		$html .= 'No Address Available';
	
	endif;
	
	$html .= '</div>';
	
	return $html;
}


function eng_address($location = null) {
	echo eng_return_address($location);
}


function eng_return_credit() {
	$html = '
		<div id="engipress-credit">
			Theme Developed by <a href="http://engipress.com/">Engipress</a>
		</div>
	';
	
	if ( eng_option('ageneral', 'eng_credit') == 'enable' ) :
		return $html;

	else :
		return;
	
	endif;
}


function eng_credit() {
	echo eng_return_credit();
}


function eng_return_copyright($location) {
	$html = '<div id="copyright';

	if ( $location ) : 
		$html .= '-' . $location;
		
	endif;
	
	$html .= '" class="copyright">';
	
	if ( eng_option('phrase', 'copyright') ) : 
		$html .= eng_option('phrase', 'copyright'); 
	
	else : 
		$html .= 'Copyright ' . date('Y');
	
	endif;
	
	$html .= '</div>';
	
	return $html;
}


function eng_copyright($location = null) {
	echo eng_return_copyright($location);
}


function eng_return_poweredby($location = null) {
	$html = '<div id="poweredby';

	if ( $location ) : 
		$html .= '-' . $location;
		
	endif;
	
	$html .= '" class="poweredby">';
	
	if ( eng_option('phrase', 'poweredby') ) : 
		$html .= eng_option('phrase', 'poweredby'); 
	
	else : 
		$html .= 'Powered by Engipress';
	
	endif;
	
	$html .= '</div>';
	
	return $html;
}


function eng_poweredby($location = null) {
	echo eng_return_poweredby($location);
}
?>