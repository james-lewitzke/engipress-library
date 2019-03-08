<?php
$optionpage_style = new eng_optionpage;
$optionpage_style->title = 'Style';
$optionpage_style->titleprint = ' Style Options';
$optionpage_style->slug = 'style';
$optionpage_style->html = array(

	'11' => array(
	'tagtype' => 'inputtext',
	'class' => 'large-text',
	'size' => '5',
	'title' => 'H1 - Font Size',
	'description' => 'Place the font-size value here (must contain particular format, for example: em or px)',
	'result' => 'h1fontsize',
	),
	
	'13' => array(
	'tagtype' => 'inputcolor',
	'class' => 'large-text',
	'title' => 'H1 - Color',
	'description' => 'Select the color, or value here (must contain # if using the hex color picker)',
	'result' => 'h1color',
	),
	
	'14' => array(
	'tagtype' => 'inputtext',
	'class' => 'large-text',
	'size' => '5',
	'title' => 'H1 - Line Height',
	'description' => 'Place the line-height value here (must contain particular format, for example: em or px)',
	'result' => 'h1lineheight',
	),
	
	'21' => array(
	'tagtype' => 'inputtext',
	'class' => 'large-text',
	'size' => '5',
	'title' => 'H2 - Font Size',
	'description' => 'Place the font-size value here (must contain particular format, for example: em or px)',
	'result' => 'h2fontsize',
	),
	
	'23' => array(
	'tagtype' => 'inputcolor',
	'class' => 'large-text',
	'title' => 'H2 - Color',
	'description' => 'Select the color, or value here (must contain # if using the hex color picker)',
	'result' => 'h2color',
	),
	
	'24' => array(
	'tagtype' => 'inputtext',
	'class' => 'large-text',
	'size' => '5',
	'title' => 'H2 - Line Height',
	'description' => 'Place the line-height value here (must contain particular format, for example: em or px)',
	'result' => 'h2lineheight',
	),
	
	'31' => array(
	'tagtype' => 'inputtext',
	'class' => 'large-text',
	'size' => '5',
	'title' => 'H3 - Font Size',
	'description' => 'Place the font-size value here (must contain particular format, for example: em or px)',
	'result' => 'h3fontsize',
	),
	
	'33' => array(
	'tagtype' => 'inputcolor',
	'class' => 'large-text',
	'title' => 'H3 - Color',
	'description' => 'Select the color, or value here (must contain # if using the hex color picker)',
	'result' => 'h3color',
	),
	
	'34' => array(
	'tagtype' => 'inputtext',
	'class' => 'large-text',
	'size' => '5',
	'title' => 'H3 - Line Height',
	'description' => 'Place the line-height value here (must contain particular format, for example: em or px)',
	'result' => 'h3lineheight',
	),
	
	'41' => array(
	'tagtype' => 'inputtext',
	'class' => 'large-text',
	'size' => '5',
	'title' => 'H4 - Font Size',
	'description' => 'Place the font-size value here (must contain particular format, for example: em or px)',
	'result' => 'h4fontsize',
	),
	
	'43' => array(
	'tagtype' => 'inputcolor',
	'class' => 'large-text',
	'title' => 'H4 - Color',
	'description' => 'Select the color, or value here (must contain # if using the hex color picker)',
	'result' => 'h4color',
	),
	
	'44' => array(
	'tagtype' => 'inputtext',
	'class' => 'large-text',
	'size' => '5',
	'title' => 'H4 - Line Height',
	'description' => 'Place the line-height value here (must contain particular format, for example: em or px)',
	'result' => 'h4lineheight',
	),
	
	'101' => array(
	'tagtype' => 'inputtext',
	'class' => 'large-text',
	'size' => '5',
	'title' => 'P - Font Size',
	'description' => 'Place the font-size value here (must contain particular format, for example: em or px)',
	'result' => 'pfontsize',
	),
	
	'103' => array(
	'tagtype' => 'inputcolor',
	'class' => 'large-text',
	'title' => 'P - Color',
	'description' => 'Select the color, or value here (must contain # if using the hex color picker)',
	'result' => 'pcolor',
	),
	
	'104' => array(
	'tagtype' => 'inputtext',
	'class' => 'large-text',
	'size' => '5',
	'title' => 'P - Line Height',
	'description' => 'Place the line-height value here (must contain particular format, for example: em or px)',
	'result' => 'plineheight',
	),
	
	'100000' => array(
	'tagtype' => 'textarea',
	'class' => 'large-text',
	'cols' => '60%',
	'rows' => '5',
	'title' => 'Custom CSS',
	'description' => 'Display any additional custom CSS here',
	'result' => 'customcss',
	),
	
);
$optionpage_style->startpage();
?>