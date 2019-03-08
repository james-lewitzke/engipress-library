<?php
$shortcode_panel = new eng_shortcode;
$shortcode_panel->shortcodename = 'panel';
$shortcode_panel->functionname = 'eng_sc_panel';
$shortcode_panel->startshortcode();

function eng_sc_panel($atts, $content = null) {
	$params = shortcode_atts( array(
		'bg-image' => '',
		'bg-repeat' => '',
		'bg-position' => '',
		'bg-color' => '',
	), $atts );
	
	
	if ( $params['bg-image'] ) :
		$the_bg_image = 'background-image: ' . $params['bg-image'] . ';';
		
	else : 
		$the_bg_image = '';
	
	endif;
	
	
	if ( $params['bg-repeat'] ) :
		$the_bg_repeat = 'background-repeat: ' . $params['bg-repeat'] . ';';
		
	elseif ( (! $params['bg-repeat']) && $params['bg-image']) :
		$the_bg_repeat = 'background-repeat: no-repeat;';
		
	else : 
		$the_bg_repeat = '';
	
	endif;
	
	
	if ( $params['bg-position'] ) :
		$the_bg_position = 'background-position: ' . $params['bg-position'] . ';';
		
	elseif ( (! $params['bg-position']) && $params['bg-image']) :
		$the_bg_position = 'background-position: fixed center center / cover;';
		
	else : 
		$the_bg_position = '';
	
	endif;
	
	
	if ( $params['bg-color'] ) :
		$the_bg_color = 'background-color: ' . $params['bg-color'] . ';';
		
	else : 
		$the_bg_color = '';
	
	endif;
	
	
	$style = ' style="' . $the_bg_image . $the_bg_repeat . $the_bg_position . $the_bg_color . ';"';
	
	$html = '
	<div class="panel"' . $style . '>
	
	<div class="panel-inner content wrap floatarea">
	';
	$html .= do_shortcode($content);
	$html .= '</div>';
	
	return $html;
}
?>