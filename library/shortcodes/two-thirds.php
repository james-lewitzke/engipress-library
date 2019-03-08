<?php
$shortcode_twothirds = new eng_shortcode;
$shortcode_twothirds->shortcodename = 'twothirds';
$shortcode_twothirds->functionname = 'eng_sc_twothirds';
$shortcode_twothirds->startshortcode();

function eng_sc_twothirds($atts, $content = null) {
	return '<div class="twothirds">' . do_shortcode($content) . '</div>';
}
?>