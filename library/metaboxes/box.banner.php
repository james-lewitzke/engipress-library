<?php$box_banner = new eng_metabox;$box_banner->vars = array(	'id' => 'banner',	'title' => 'Banner',	'page' => 'page',	'context' => 'normal',	'priority' => 'high',	'fields' => array(		array(			'name' => 'Banner Image URL',			'desc' => 'If this page should have a custom banner image, place it\'s URL here.',			'id' => 'banner-bgimage',			'type' => 'input_text',			'std' => '',		),	),);$box_banner->startbox();?>