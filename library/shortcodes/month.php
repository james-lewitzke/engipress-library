<?php
$shortcode_month = new eng_shortcode;
$shortcode_month->shortcodename = 'month';
$shortcode_month->functionname = 'eng_sc_month';
$shortcode_month->startshortcode();

function eng_sc_month() {
	return date('m');
}
?>