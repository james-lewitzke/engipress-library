<?php
$shortcode_parallax = new eng_shortcode;
$shortcode_parallax->shortcodename = 'parallax';
$shortcode_parallax->functionname = 'eng_sc_parallax';
$shortcode_parallax->startshortcode();


function eng_sc_parallax($atts, $content = null) {
	$params = shortcode_atts( array(
		'backgroundurl' => '',
	), $atts );
	
	$html = '
	<div class="parallax" style="background: url(\'' . $params['backgroundurl'] . '\') no-repeat fixed center center / cover;">
		<div class="parallax-inner wrap floatarea">
		' . $content . '
		</div>
	</div>
	';
	
	return do_shortcode($html);
}
?>