<?php
function eng_banner($position_banner_image = null, $classes_banner_items = null, $toggle_title = null, $toggle_date = null, $toggle_content = null) {
	global $post;
	
	$cf_banner_bgimage = do_shortcode(get_post_meta($post->ID, 'banner-bgimage', true));
	$cf_banner_bgimage_child = do_shortcode(get_post_meta($post->post_parent, 'banner-bgimage', true));
	$cf_banner_bgvideo = do_shortcode(get_post_meta($post->ID, 'banner-bgvideo', true));
	$cf_banner_bgyoutube = do_shortcode(get_post_meta($post->ID, 'banner-bgyoutube', true));
	$cf_banner_title = do_shortcode(get_post_meta($post->ID, 'banner-title', true));
	$cf_banner_tagline = do_shortcode(get_post_meta($post->ID, 'banner-tagline', true));
	
	$library_banner_image_url_designmain = eng_library_url() . '/images/banners/designmain.png';
	$library_banner_image_url_home = eng_library_url() . '/images/banners/home.png';
	$library_banner_image_url_default = eng_library_url()  . '/images/banners/default.png';
	$theme_banner_folder_url_cpt = eng_theme_url() . '/images/banners/cpts/';
	$theme_banner_folder_path_cpt = eng_theme_path() . '/images/banners/cpts/';
	$theme_banner_image_url_designmain = eng_theme_url() . '/images/banners/designmain.png';
	$theme_banner_image_path_designmain = eng_theme_path() . '/images/banners/designmain.png';
	$theme_banner_image_url_home = eng_theme_url() . '/images/banners/home.png';
	$theme_banner_image_path_home = eng_theme_path() . '/images/banners/home.png';
	$theme_banner_image_url_default = eng_theme_url() . '/images/banners/default.png';
	$theme_banner_image_path_default = eng_theme_path() . '/images/banners/default.png';
	
	
	if ( file_exists($theme_banner_image_path_designmain) ) :
		$banner_image_URL_designmain = $theme_banner_image_url_designmain;
		
	else :
		$banner_image_URL_designmain = $library_banner_image_url_designmain;
		
	endif;
	
	
	if ( file_exists($theme_banner_image_path_home) ) :
		$banner_image_URL_home = $theme_banner_image_url_home;
		
	else :
		$banner_image_URL_home = $library_banner_image_url_home;
		
	endif;
	
	
	if ( eng_option('ageneral', 'sitedefaultbannerURL') ) :
		$banner_image_URL_default = eng_option('ageneral', 'sitedefaultbannerURL');
	
	elseif ( file_exists($theme_banner_image_path_default) ) :
		$banner_image_URL_default = $theme_banner_image_url_default;
		
	else :
		$banner_image_URL_default = $library_banner_image_url_default;
		
	endif;
	
	
	if ( $cf_banner_bgimage ) : 
		$banner_image_URL = $cf_banner_bgimage;	
	
	elseif ( $cf_banner_bgimage_child ) :
		$banner_image_URL = $cf_banner_bgimage_child;
	
	elseif ( is_design_main() ) :
		foreach ( get_post_types() as $posttype ) :
			if ( is_posttype($posttype) ) :
				$banner_image_URL = $theme_banner_folder_url_cpt . $posttype . '.png';
				
			elseif ( is_blog() ) :
				$banner_image_URL = $banner_image_URL_designmain;
				
			endif;

		endforeach;
			
	
	elseif ( has_post_thumbnail() ) : 
		$banner_image_URL = get_the_post_thumbnail_url();
			
	elseif ( is_front_page() ) :
		$banner_image_URL = $banner_image_URL_home;
		
	else :
		$banner_image_URL = $banner_image_URL_default;
		
	endif;
	
	
	if ( $position_banner_image ) : 
		$banner_image_position = $position_banner_image;
	
	else: 
		$banner_image_position = 'no-repeat center center / cover';
		
	endif;
	
	if ( $classes_banner_items ) : 
		$banner_items_classes = ' ' . $classes_banner_items;
		
	endif;
	
	
	if ( $cf_banner_bgvideo ) :
		$html = '
			<div id="banner-container" class="banner-area banner-area-video">
				<video preload="auto" autoplay loop muted poster="' . $banner_image_URL . '"><source src="' . $cf_banner_bgvideo . '" type="video/mp4" /></video>
				<div class="banner-area-overlay-video"></div>
		';
		
	elseif ( $cf_banner_bgyoutube ) :
		$embedhtmlold = '[embed]' . $cf_banner_bgyoutube . '[/embed]';
		$embedhtml = '<iframe src="' . $cf_banner_bgyoutube . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
		$html = '
			<div id="banner-container" class="banner-area banner-area-youtube">
			<div class="banner-area-overlay-youtube"></div>
		' . 
			$embedhtml
		;
	
	else :
		$html = '
			<div id="banner-container" class="banner-area banner-area-default" style="background: url(\'' . $banner_image_URL . '\') ' . $banner_image_position . '">
		';
	
	endif;
	

	if ( $cf_banner_title ) : 
		$banner_title = $cf_banner_title;
		
	elseif ( is_tax() ) :
		$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$banner_title = $term->name;
		
	elseif ( is_home() ) :
		$banner_title = 'Blog';
		
	else :
		$banner_title = single_post_title('', false);
		
	endif;
	
		
	if ( is_front_page() ) :		
		if ( eng_option('ageneral', 'homebannercontentleft') ) :
			$banner_content .= '<div id="home-banner-content-left" class="banner-content-left">' . eng_option('ageneral', 'homebannercontentleft') . '</div>';
		endif;
		
		if ( eng_option('ageneral', 'homebannercontentright') ) :
			$banner_content .= '<div id="home-banner-content-right" class="banner-content-right">' . eng_option('ageneral', 'homebannercontentright') . '</div>';
		endif;

		
	elseif ( is_design_main() ) :
		if ( eng_option('ageneral', 'designmainbannercontentleft') ) :
			$banner_content .= '<div id="designmain-banner-content-left" class="banner-content-left">' . eng_option('ageneral', 'designmainbannercontentleft') . '</div>';
		endif;
		
		if ( eng_option('ageneral', 'designmainbannercontentright') ) :
			$banner_content .= '<div id="designmain-banner-content-right" class="banner-content-right">' . eng_option('ageneral', 'designmainbannercontentright') . '</div>';
		endif;
		
		
	elseif ( is_page() ) :
		if ( eng_option('ageneral', 'insidepagebannercontentleft') ) :
			$banner_content .= '<div id="insidepage-banner-content-left" class="banner-content-left">' . eng_option('ageneral', 'insidepagebannercontentleft') . '</div>';
		endif;
		
		if ( eng_option('ageneral', 'insidepagebannercontentright') ) :
			$banner_content .= '<div id="insidepage-banner-content-right" class="banner-content-right">' . eng_option('ageneral', 'insidepagebannercontentright') . '</div>';
		endif;
		
	endif;
	
	
	if ( ($toggle_title == 'title-on') && (! (($toggle_date == 'date-on') || ($toggle_content == 'content-on')) ) ) : 
		$banner_items_toggled = ' banner-title-only';
		
	elseif ( ($toggle_date == 'date-on') && (! (($toggle_title == 'title-on') || ($toggle_content == 'content-on')) ) ) :
		$banner_items_toggled = ' banner-date-only';

	elseif ( ($toggle_content == 'content-on') && (! (($toggle_date == 'date-on') || ($toggle_title == 'title-on')) ) ) :
		$banner_items_toggled = ' banner-content-only';
	
	endif;
	
	
	if ( ($toggle_title == 'title-on') || ($toggle_date == 'date-on') || ($toggle_content == 'content-on') ) : 
		$html .= '
			<div id="banner-items" class="banner-items' . $banner_items_classes . $banner_items_toggled . '">
		';
	endif;
		
		if ( $toggle_title == 'title-on' ) : 
			$html .= '
				<h1 id="banner-title" class="primarytitle">
					<span id="banner-title-span" class="primarytitle-span">' . $banner_title . '</span>
				</h1>
			';
		endif;
		
		if ( $toggle_date == 'date-on' ) : 
			$html .= '
				<div id="banner-date" class="metadate">
					<span id="banner-date-span" class="metadate-span">' . date('F, j Y') . '</span>
				</div>
			';
		endif;
		
		if ( $toggle_content == 'content-on' ) : 
			$html .= '
				<div id="banner-content" class="content">
					<div id="banner-content-div" class="content-div floatarea">' . $banner_content . '</div>
				</div>
			';
		endif;
	
	if ( ($toggle_title == 'title-on') || ($toggle_date == 'date-on') || ($toggle_content == 'content-on') ) : 
		$html .= '
			</div>
		';
	endif;
	
	
	$html .= '
		</div>
	';
	
	
	echo $html;
}
?>