<?php
$shortcode_social_linkedin = new eng_shortcode;
$shortcode_social_linkedin->shortcodename = 'linkedinURL';
$shortcode_social_linkedin->functionname = 'eng_sc_social_linkedin';
$shortcode_social_linkedin->startshortcode();

function eng_sc_social_linkedin() {
	$socialoptions = get_option(ENGTHEMESLUG . 'social_options');
	return $socialoptions['linkedinURL'];
}
?>