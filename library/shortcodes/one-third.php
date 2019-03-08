<?php
$shortcode_onethird = new eng_shortcode;
$shortcode_onethird->shortcodename = 'onethird';
$shortcode_onethird->functionname = 'eng_sc_onethird';
$shortcode_onethird->startshortcode();

function eng_sc_onethird($atts, $content = null) {
	return '<div class="onethird">' . do_shortcode($content) . '</div>';
}
?>