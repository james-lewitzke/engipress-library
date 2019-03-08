<?php
$shortcode_social_rss = new eng_shortcode;
$shortcode_social_rss->shortcodename = 'rssURL';
$shortcode_social_rss->functionname = 'eng_sc_social_rss';
$shortcode_social_rss->startshortcode();

function eng_sc_social_rss() {
	$socialoptions = get_option(ENGTHEMESLUG . 'social_options');
	return $socialoptions['rssURL'];
}
?>