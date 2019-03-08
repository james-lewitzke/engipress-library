<?php
$shortcode_social_tumblr = new eng_shortcode;
$shortcode_social_tumblr->shortcodename = 'tumblrURL';
$shortcode_social_tumblr->functionname = 'eng_sc_social_tumblr';
$shortcode_social_tumblr->startshortcode();

function eng_sc_social_tumblr() {
	$socialoptions = get_option(ENGTHEMESLUG . 'social_options');
	return $socialoptions['tumblrURL'];
}
?>