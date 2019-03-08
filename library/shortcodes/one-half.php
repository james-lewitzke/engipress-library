<?php
$shortcode_onehalf = new eng_shortcode;
$shortcode_onehalf->shortcodename = 'onehalf';
$shortcode_onehalf->functionname = 'eng_sc_onehalf';
$shortcode_onehalf->startshortcode();

function eng_sc_onehalf($atts, $content = null) {
	return '<div class="onehalf">' . do_shortcode($content) . '</div>';
}
?>