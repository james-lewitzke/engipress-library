<?php
$shortcode_social_twitter = new eng_shortcode;
$shortcode_social_twitter->shortcodename = 'twitterURL';
$shortcode_social_twitter->functionname = 'eng_sc_social_twitter';
$shortcode_social_twitter->startshortcode();

function eng_sc_social_twitter() {
	$socialoptions = get_option(ENGTHEMESLUG . 'social_options');
	return $socialoptions['twitterURL'];
}
?>