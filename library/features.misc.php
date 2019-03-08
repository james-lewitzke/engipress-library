<?php 
/* URL Functions */
function eng_url() {
	return home_url();
}

function eng_theme_url() {
	return get_template_directory_uri();
}

function eng_theme_path() {
	return get_template_directory();
}

function eng_library_url() {
	return ENGCURRENTPLUGINURL . '/library';
}

function eng_library_path() {
	return ENGPLUGINPATH . '/library';
}


/* Miscellaneous Functions */
function eng_date($type) {
	if ($type == 'month-current' ) :
		$date = date('F');
		
	elseif ($type == 'year-current' ) :
		$date = date('Y');
	
	elseif ($type == 'month-old' ) :
		$date = get_the_date('F');
		
	elseif ($type == 'year-old' ) :
		$date = get_the_date('Y');
		
	endif;
	
	return $date;
}


function eng_option($optionpage, $option) {
	$optionpage_items = get_option(ENGTHEMESLUG . $optionpage . '_options');
	
	$optionpage_result = do_shortcode($optionpage_items[$option]);
	
	return $optionpage_result;
}
?>