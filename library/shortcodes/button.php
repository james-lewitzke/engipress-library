<?php
$shortcode_button = new eng_shortcode;
$shortcode_button->shortcodename = 'button';
$shortcode_button->functionname = 'eng_sc_button';
$shortcode_button->startshortcode();


function eng_sc_button($atts, $content = null) {
	$params = shortcode_atts( array(
		'url' => '',
		'text' => '',
		'target' => '',
	), $atts );
	
	if ( $params['target'] ) :
		$target = ' target="' . $params['target'] . '"';
		
	endif;
	
	$html = '
	<a class="eng-button" href="' . $params['url'] . '"' . $target . '>
		' . $params['text'] . '
	</a>
	';
	
	return $html;
}
?>