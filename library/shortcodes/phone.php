<?php
$shortcode_phrase_phone = new eng_shortcode;
$shortcode_phrase_phone->shortcodename = 'phone';
$shortcode_phrase_phone->functionname = 'eng_sc_phrase_phone';
$shortcode_phrase_phone->startshortcode();

function eng_sc_phrase_phone() {
	$phraseoptions = get_option(ENGTHEMESLUG . 'phrase_options');
	return $phraseoptions['phone'];
}
?>