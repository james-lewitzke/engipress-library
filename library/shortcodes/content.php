<?php
$shortcode_content = new eng_shortcode;
$shortcode_content->shortcodename = 'content';
$shortcode_content->functionname = 'eng_sc_content';
$shortcode_content->startshortcode();


function eng_sc_content($atts, $content = null) {
	$html = '
	<div class="content-inner wrap floatarea">
	' . do_shortcode($content) . '
	</div>
	';
	
	return $html;
}
?>