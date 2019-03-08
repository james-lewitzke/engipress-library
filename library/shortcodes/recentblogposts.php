<?php /*
$shortcode_recentblogposts = new eng_shortcode;
$shortcode_recentblogposts->shortcodename = 'recentblogposts';
$shortcode_recentblogposts->functionname = 'eng_sc_recentblogposts';
$shortcode_recentblogposts->startshortcode();

function eng_sc_recentblogposts($atts) {
	$params = shortcode_atts( array(
		'number' => '',
		'title' => '',
	), $atts );
	
	
	if ( $params['number'] == 1 ) :
		$class_fraction = '';
		
	elseif ( $params['number'] == 2 ) :
		$class_fraction = 'onehalf';
		
	else :
		$class_fraction = 'onethird';
		
	endif;
		
	
	if ( $params['title'] ) :
		$recentblogpoststitle = ' ' . $params['title'];
		
	else :
		$recentblogpoststitle = 'Recent Blog Posts';
	
	endif;
		
	
	
	$html = '
	<div class="recentblogposts">
		<div class="recentblogposts-inner wrap floatarea">
			<h2 class="title recentblogposts-title">' . $recentblogpoststitle . '</h2>
	';
	
	ob_start();
	$loop_blog_recent_posts = new eng_query;
	$loop_blog_recent_posts->posttype = 'post';
	$loop_blog_recent_posts->posttypesingle = 'post';
	$loop_blog_recent_posts->elements = array(
		'wrap' => array(
			'tag' => 'article',
			'class' => $class_fraction,
		),
		'title' => array(
			'titlelink' => true,
			'order' => 10,
		),
		'customfield' => array(
			'name' => 'eng_mb_subtitle',
			'label' => 'subtitle',
			'order' => 15,
		),
		'datetime' => array(
			'format' => 'm.d.y',
			'order' => 5,
		),
		'content' => array(
			'type' => 'excerpt',
			'order' => 30,
		),
	);
	$loop_blog_recent_posts->args = array(
		'posts_per_page' => $params['number'],
		);
	$loop_blog_recent_posts->startquery();
	$html .= ob_get_clean();
	
	$html .= '
	</div>
	</div>
	';
	
	return $html;

}*/
?>