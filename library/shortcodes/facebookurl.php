<?php
$shortcode_social_facebook = new eng_shortcode;
$shortcode_social_facebook->shortcodename = 'facebookURL';
$shortcode_social_facebook->functionname = 'eng_sc_social_facebook';
$shortcode_social_facebook->startshortcode();

function eng_sc_social_facebook() {
	$socialoptions = get_option(ENGTHEMESLUG . 'social_options');
	return $socialoptions['facebookURL'];
}
?>