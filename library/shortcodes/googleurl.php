<?php
$shortcode_social_google = new eng_shortcode;
$shortcode_social_google->shortcodename = 'googleURL';
$shortcode_social_google->functionname = 'eng_sc_social_google';
$shortcode_social_google->startshortcode();

function eng_sc_social_google() {
	$socialoptions = get_option(ENGTHEMESLUG . 'social_options');
	return $socialoptions['googleURL'];
}
?>