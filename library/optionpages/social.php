<?php $optionpage_social = new eng_optionpage;$optionpage_social->title = 'Social';$optionpage_social->titleprint = ' Social Options';$optionpage_social->slug = 'social';$optionpage_social->html = array(	'10' => array(	'tagtype' => 'inputtext',	'class' => 'large-text',	'title' => 'Facebook URL',	'size' => '40',	'description' => 'Type in the URL to the Facebook page here',	'result' => 'facebookURL',	),		'20' => array(	'tagtype' => 'inputtext',	'class' => 'large-text',	'title' => 'Twitter URL',	'size' => '40',	'description' => 'Type in the URL to the Twitter page here',	'result' => 'twitterURL',	),		'30' => array(	'tagtype' => 'inputtext',	'class' => 'large-text',	'title' => 'Linkedin URL',	'size' => '40',	'description' => 'Type in the URL to the Linkedin page here',	'result' => 'linkedinURL',	),		'40' => array(	'tagtype' => 'inputtext',	'class' => 'large-text',	'title' => 'Tumblr URL',	'size' => '40',	'description' => 'Type in the URL to the Tumblr page here',	'result' => 'tumblrURL',	),		'50' => array(	'tagtype' => 'inputtext',	'class' => 'large-text',	'title' => 'Youtube URL',	'size' => '40',	'description' => 'Type in the URL to the Youtube page here',	'result' => 'youtubeURL',	),		'60' => array(	'tagtype' => 'inputtext',	'class' => 'large-text',	'title' => 'Google+ URL',	'size' => '40',	'description' => 'Type in the URL to the Google+ page here',	'result' => 'googleURL',	),		'70' => array(	'tagtype' => 'inputtext',	'class' => 'large-text',	'title' => 'Instagram URL',	'size' => '40',	'description' => 'Type in the URL to the Instagram page here',	'result' => 'instagramURL',	),		'100' => array(	'tagtype' => 'inputtext',	'class' => 'large-text',	'title' => 'Wordpress URL',	'size' => '40',	'description' => 'Type in the URL to the Wordpress page here',	'result' => 'wordpressURL',	),		'1000' => array(	'tagtype' => 'inputtext',	'class' => 'large-text',	'title' => 'RSS URL',	'size' => '40',	'description' => 'Type in the URL to the RSS page here',	'result' => 'rssURL',	),		'1010' => array(	'tagtype' => 'inputtext',	'class' => 'large-text',	'title' => 'Blog URL',	'size' => '40',	'description' => 'Type in the URL to the blog page here',	'result' => 'blogURL',	),	);$optionpage_social->startpage();?>