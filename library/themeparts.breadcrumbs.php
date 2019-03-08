<?php
/* Template Tag Variables */
$homeurl = get_option('home');
$homename = get_bloginfo('name');

/* Markup Variables */
$linkstart = '<a href="';
$linkmiddle = '">';
$linkfinish = '</a>';
$spanstart = '<span class="';
$spanmiddle = '">';
$spanfinish = '</span>';
$next = ' > ';

/* Breadcrumb Navigation */
function eng_breadcrumbs() {
	global $homeurl, $homename, $linkstart, $linkmiddle, $linkfinish, $next;

	$homelink = $linkstart . $homeurl . $linkmiddle . $homename . $linkfinish;
		
	if ( is_category() ) :
		$cattitle = single_cat_title( "", false );
		$cat = get_cat_ID( $cattitle );
		$catresult = $homelink . $next . get_category_parents( $cat, true, $next );
		$catfinal = substr_replace($catresult, '', -2);
		echo $catfinal;

	elseif ( is_single() ) :
		$category = get_the_category();
		$category_id = get_cat_ID( $category[0]->cat_name );
		echo $homelink . $next . get_category_parents( $category_id, true, $next );
		echo the_title('','', false);
		
	elseif ( is_home() ) :
		echo $homelink;
		
	elseif ( is_404() ) :
		echo $homelink . $next . '404 Error';

	elseif ( is_author() ) :
		if(get_query_var('author_name')) :
			$curauth = get_userdatabylogin(get_query_var('author_name'));
		else :
			$curauth = get_userdata(get_query_var('author'));
		endif;
		echo $homelink . $next . $curauth->user_login;

	elseif ( is_page() ) :
		$parent_title = get_the_title($post->post_parent);
		echo $homelink . $next . $parent_title;

	else :
		echo $homelink . $next . the_title('','', false);
		
	endif;
}

?>