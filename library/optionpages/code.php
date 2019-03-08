<?php
$optionpage_code = new eng_optionpage;
$optionpage_code->title = 'Code';
$optionpage_code->titleprint = ' Code Options';
$optionpage_code->slug = 'code';
$optionpage_code->html = array(

	'1' => array(
	'tagtype' => 'textarea',
	'class' => 'large-text',
	'rows' => '4',
	'cols' => '50%',
	'title' => 'Before Closing Head',
	'description' => 'Type in the code that appears before the closing head tag',
	'result' => 'codebeforehead',
	),

	'11' => array(
	'tagtype' => 'textarea',
	'class' => 'large-text',
	'rows' => '4',
	'cols' => '50%',
	'title' => 'Before Closing Body',
	'description' => 'Type in the code that appears before the closing body tag',
	'result' => 'codebeforebody',
	),
	
);
$optionpage_code->startpage();
?>