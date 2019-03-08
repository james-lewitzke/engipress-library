<?php
function eng_social() {
	$html = '<ul class="list-social">';
	
	$library_social_image_facebook = eng_library_url() . '/images/social/facebook.png';
	$theme_social_image_facebook = eng_theme_url() . '/images/social/facebook.png';
	
	$list_social = array(
		'facebook' => array(
			'option_social' => 'facebookURL',
			'image_url' => 'facebook.png',
		),
		'twitter' => array(
			'option_social' => 'twitterURL',
			'image_url' => 'twitter.png',
		),
		'linkedin' => array(
			'option_social' => 'linkedinURL',
			'image_url' => 'linkedin.png',
		),
		'tumblr' => array(
			'option_social' => 'tumblrURL',
			'image_url' => 'tumblr.png',
		),
		'google' => array(
			'option_social' => 'googleURL',
			'image_url' => 'google.png',
		),
		'instagram' => array(
			'option_social' => 'instagramURL',
			'image_url' => 'instagram.png',
		),
		'pinterest' => array(
			'option_social' => 'pinterestURL',
			'image_url' => 'pinterest.png',
		),
		'youtube' => array(
			'option_social' => 'youtubeURL',
			'image_url' => 'youtube.png',
		),
		'soundcloud' => array(
			'option_social' => 'soundcloudURL',
			'image_url' => 'soundcloud.png',
		),
		'wordpress' => array(
			'option_social' => 'wordpressURL',
			'image_url' => 'wordpress.png',
		),
		'rss' => array(
			'option_social' => 'rssURL',
			'image_url' => 'rss.png',
		),
	);
	
	foreach( $list_social as $list_social_item ) :
		if (eng_option('social', $list_social_item['option_social'])) : 
		
			$library_social_image_url = eng_library_url() . '/images/social/' . $list_social_item['image_url'];
			$theme_social_image_url = eng_theme_url() . '/images/social/' . $list_social_item['image_url'];
			$theme_social_image_path = eng_theme_path() . '/images/social/' . $list_social_item['image_url'];
			
			if ( file_exists($theme_social_image_path) ) :
				$list_social_item_image_source = $theme_social_image_url;
				
			else :
				$list_social_item_image_source = $library_social_image_url;
				
			endif;
			
		
			$html .= '
				<li class="list-social-item list-social-item-' . array_search($list_social_item, $list_social) . '">
					<a class="list-social-item-link" target="blank" href="' . eng_option('social', $list_social_item['option_social']) . '">
						<img class="list-social-item-image" src="' . $list_social_item_image_source . '" />
					</a>
				</li>
			'; 
		endif; 
	
	endforeach;

	$html .= '</ul>';

	echo $html;
}
?>