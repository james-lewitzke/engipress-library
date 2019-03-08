<?php
$shortcode_heading = new eng_shortcode;
$shortcode_heading->shortcodename = 'heading';
$shortcode_heading->functionname = 'eng_sc_heading';
$shortcode_heading->startshortcode();


function eng_sc_heading($atts, $content = null) {
	$params = shortcode_atts( array(
		'type' => '',
		'class' => '',
		'text' => '',
		'font-size' => '',
		'line-height' => '',
		'color' => '',
	), $atts );
	
	$css = $params['font-size'] || $params['line-height'] || $params['color'];
	
	
	if ( $params['type'] ) :
		$html_wrapper_type = $params['type'];
		
	else :
		$html_wrapper_type = 'h1';
	
	endif;
		
	
	if ( $params['class'] ) :
		$html_wrapper_class = ' ' . $params['class'] . '"';
		
	else :
		$html_wrapper_class = '"';
	
	endif;
	
	
	if ( $css ) :
		$html_wrapper_css = ' style="';
	
		if ( $params['font-size'] ) :
			$html_wrapper_css .= 'font-size: ' . $params['font-size'] . ';';
			
		endif;
		
		if ( $params['line-height'] ) :
			$html_wrapper_css .= 'line-height: ' . $params['line-height'] . ';';
		
		endif;
		
		if ( $params['color'] ) :
			$html_wrapper_css .= 'color: ' . $params['color'] . ';';
		
		endif;
		
		$html_wrapper_css .= '"';
			
	else :
		$html_wrapper_css = '';
	
	endif;

	
	$html = '
	<' . $html_wrapper_type . ' class="heading' . $html_wrapper_class . $html_wrapper_css . '>
		<span class="heading-inner">
			' . $params['text'] . '
		</span>
	</' . $html_wrapper_type . '>
	';
	
	return $html;
}
?>