<?php
$shortcode_themeURL = new eng_shortcode;
$shortcode_themeURL->shortcodename = 'themeURL';
$shortcode_themeURL->functionname = 'eng_sc_themeurl';
$shortcode_themeURL->startshortcode();

function eng_sc_themeurl() {
	return get_bloginfo('template_url');
}
?>