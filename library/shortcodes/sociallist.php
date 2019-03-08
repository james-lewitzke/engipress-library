<?php
$shortcode_social_list = new eng_shortcode;
$shortcode_social_list->shortcodename = 'social-list';
$shortcode_social_list->functionname = 'eng_sc_social_list';
$shortcode_social_list->startshortcode();

function eng_sc_social_list() {
	ob_start();
		eng_social();
	return ob_get_clean();
}
?>