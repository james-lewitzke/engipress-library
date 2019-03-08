<?php
$shortcode_onefourth = new eng_shortcode;
$shortcode_onefourth->shortcodename = 'onefourth';
$shortcode_onefourth->functionname = 'eng_sc_onefourth';
$shortcode_onefourth->startshortcode();

function eng_sc_onefourth($atts, $content = null) {
	return '<div class="onefourth">' . do_shortcode($content) . '</div>';
}
?>