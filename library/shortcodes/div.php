<?php
$shortcode_div = new eng_shortcode;
$shortcode_div->shortcodename = 'div';
$shortcode_div->functionname = 'eng_sc_div';
$shortcode_div->startshortcode();


function eng_sc_div($atts, $content = null) {
	$params = shortcode_atts( array(
		'class' => '',
		'background' => '',
		'color' => '',
		'width' => '',
	), $atts );
	
	if ( $params['background'] || $params['background-cover'] || $params['color'] || $params['width'] ) :
		if ( $params['background'] ) :
			$background = 'background: ' . $params['background'] . ';';
			
		else : 
			$background = '';
			
		endif;
		
		
		if ( $params['color'] ) :
			$color = ' color: ' . $params['color'] . ';';
			
		else : 
			$color = '';
			
		endif;
				
		
		if ( $params['width'] ) :
			$width = ' width: ' . $params['width'] . ';';
			
		else : 
			$width = '';
			
		endif;
		

		$css = ' style="' . $background . $color . $width . '"';
		
		
	else : 
		$css = '';
	
	endif;
	
	
	if ( $params['class'] ) :
		$class = ' class="div ' . $params['class'] . '"';
		
	else : 
		$class = ' class="div"';
		
	endif;
	
	
	$html = '
	<div' . $class . $css . '>
	' . do_shortcode($content) . '
	</div>
	';
	
	return $html;
}
?>