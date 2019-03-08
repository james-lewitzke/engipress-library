<?php
$shortcode_url = new eng_shortcode;
$shortcode_url->shortcodename = 'URL';
$shortcode_url->functionname = 'eng_sc_url';
$shortcode_url->startshortcode();

function eng_sc_url() {
	return home_url();
}
?>