<?php
$shortcode_day = new eng_shortcode;
$shortcode_day->shortcodename = 'day';
$shortcode_day->functionname = 'eng_sc_day';
$shortcode_day->startshortcode();

function eng_sc_day() {
	return date('d');
}
?>