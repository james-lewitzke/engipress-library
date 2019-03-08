<?php
$shortcode_social_youtube = new eng_shortcode;
$shortcode_social_youtube->shortcodename = 'youtubeURL';
$shortcode_social_youtube->functionname = 'eng_sc_social_youtube';
$shortcode_social_youtube->startshortcode();

function eng_sc_social_youtube() {
	$socialoptions = get_option(ENGTHEMESLUG . 'social_options');
	return $socialoptions['youtubeURL'];
}
?>