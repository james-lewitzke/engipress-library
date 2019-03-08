<?php
$shortcode_year = new eng_shortcode;
$shortcode_year->shortcodename = 'year';
$shortcode_year->functionname = 'eng_sc_year';
$shortcode_year->startshortcode();

function eng_sc_year() {
	return date('Y');
}
?>