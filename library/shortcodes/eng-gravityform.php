<?php
$shortcode_eng_gravityform = new eng_shortcode;
$shortcode_eng_gravityform->shortcodename = 'eng-gravityform';
$shortcode_eng_gravityform->functionname = 'eng_sc_gravityform';
$shortcode_eng_gravityform->startshortcode();


function eng_sc_gravityform($atts, $content = null) {
	$params = shortcode_atts( array(
		'id' => '',
		'title' => '',
		'description' => '',
		'inactive' => '',
		'ajax' => '',
		'tabindex' => '',
		'field_values' => '',
		'class' => '',
	), $atts );
	
	/*$gravityform = gravity_form( $params['id'], $params['title'], $params['description'], $params['inactive'], $params['field_values'], $params['ajax'],  $params['tabindex'], $echo = false );*/

	if ( $params['class'] ) :
		$html_wrapper_class = ' ' . $params['class'];
		
	else :
		$html_wrapper_class = '';
	
	endif;
	
	
	$html = '
	<div id="eng-gform-wrapper-' . $params['id'] . '" class="eng-gform-wrapper' . $html_wrapper_class . '">
		' . '[gravityform id="' . $params['id'] . '" title="' . $params['title'] . '" description="' . $params['description'] . '"]' . '
	</div>
	';
	
	return do_shortcode($html);
}
?>