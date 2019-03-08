<?php
$shortcode_threefourths = new eng_shortcode;
$shortcode_threefourths->shortcodename = 'threefourths';
$shortcode_threefourths->functionname = 'eng_sc_threefourths';
$shortcode_threefourths->startshortcode();

function eng_sc_threefourths($atts, $content = null) {
	return '<div class="threefourths">' . do_shortcode($content) . '</div>';
}
?>