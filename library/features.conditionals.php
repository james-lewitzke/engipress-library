<?php 
/* GET Conditionals */
function get_cpts() {
	foreach ( get_post_types() as $posttype ) :
		if ( in_array( $posttype, array(
			is_singular($posttype),
			is_page_template('template-cpt-' . $posttype . '.php'),
			is_page_template('template-cpt-' . $posttype . '-archives.php'),
			is_tax( get_object_taxonomies($posttype) ),
			is_tax_wildcard( $posttype )
		)) && (! in_array( $posttype, array(
			'post',
			'page',
			'attachment',
		)))) :
			return true;
		endif;
	endforeach;
}


function get_cpt_lists() {
	foreach ( get_post_types() as $posttype ) :
		if ( in_array( $posttype, array(
			is_page_template('template-cpt-' . $posttype . '.php'),
			is_page_template('template-cpt-' . $posttype . '-archives.php'),
			is_tax( get_object_taxonomies($posttype) ),
			is_tax_wildcard( $posttype )
		)) ) :
			return true;
		endif;
	endforeach;
}


function get_cpt_singles() {
	foreach ( get_post_types() as $posttype ) :
		if ( in_array( $posttype, array(
			is_singular($posttype)
		)) && (! in_array( $posttype, array(
			'post',
			'page',
			'attachment',
		)))) :
			return true;
		endif;
	endforeach;
}



/* IS Conditionals */
function is_blog() {
	$cpt = is_post_type_archive() || is_tax();

	return 
		is_singular('post') || 
		( is_category() && ! $cpt ) || 
		is_search() || 
		is_home() ||
		is_page_template('template-blog-archives.php') ||
		is_child_page('biography') ||
		( is_archive() && ! $cpt )
	;
}


function is_blog_list() {
	$cpt = is_post_type_archive() || is_tax();

	return 
		( is_category() && ! $cpt ) || 
		is_search() || 
		is_home() ||
		is_page_template('template-blog-archives.php') ||
		( is_archive() && ! $cpt )
	;
}


function is_design_main() {
	return 
		is_blog() || 
		get_cpts()
	;
}


function is_design_main_list() {
	return 
		is_blog_list() || 
		get_cpt_lists()	
	;
}


function is_design_main_single() {
	return 
		is_singular('post') || 
		get_cpt_singles()	
	;
}


function is_system_panels() {
	
	if ( function_exists('has_system_panels') ) :
		return 
			has_system_panels()
		;
	endif;
}


function is_default_page() {
    return 
		( is_page() && (! ( is_front_page() || is_page_template() || is_child_page('biography') ) ) )
	;
}


function is_posttype($posttype) {
    return 
		is_singular($posttype) || 
		is_page_template('template-cpt-' . $posttype . '.php') || 
		is_page_template('template-cpt-' . $posttype . '-archives.php') || 
		is_tax( get_object_taxonomies($posttype) ) || 
		is_tax_wildcard( $posttype )
	;
}


function is_tax_wildcard($posttype = null) {
    //OPTION 1: get the list of all taxonomies
    //$taxonomies = get_taxonomies( $args);
    
    //OPTION 2: get the list of all CUSTOM taxonomies    
    $args = array(
        'public'   => true,
        '_builtin' => false
    );
    $taxonomies = get_taxonomies($args);
    
    if ( $taxonomies ) :
        foreach ( $taxonomies  as $taxonomy ) :
            //loop through this list and find any that match the $pre variable
            if(strstr($taxonomy, $posttype.'-')) :
                //test if this is_tax()
                if(is_tax($taxonomy)) return true;
            endif;
        endforeach;
        //return false if no matches found
        return false;
    endif;
}


/* Page Level Conditionals */
function is_child_page( $page_id_or_slug ) {
    global $post; 
    if ( (! is_page()) || ($post->post_parent == 0) ) :
        return false;
	endif;

    if( !is_int( $page_id_or_slug ) ) :
        $page = get_page_by_path( $page_id_or_slug );
        $page_id_or_slug = $page->ID;
    endif;
	
	return $post->post_parent == $page_id_or_slug;
}


function is_descendant_page( $page_id_or_slug ) { 
    global $post; 
    if ( (! is_page()) || ($post->post_parent == 0) ) :
        return false;
	endif;

    if( !is_int( $page_id_or_slug ) ) :
		$ancestors = get_post_ancestors($post);
        $page = get_page_by_path( $page_id_or_slug );
        $page_id_or_slug = $page->ID;
    endif;

	return in_array($page_id_or_slug, $ancestors);
}


function is_in_tree( $page_slug ) { // $page_id_or_slug = The ID of the page we're engipressing for pages underneath.
	global $post;

	if ( ! is_page() ) :
        return false;
	endif;
	
		$page = get_page_by_path( $page_slug ); // Important to make sure you have the whole path here if it includes child pages, not just the current slug
		$page_ID = $page->ID;
	
	if ( $post->post_parent == $page_ID || ( is_page( $page_ID ) || in_array($page_ID, $post->ancestors) ) )
		return true;
	else
		return false;
}


if ( ! function_exists('is_subcategory') ) :
function is_subcategory ($id) {
	$in_subcategory = false;
	
	foreach( explode( "/", get_category_children($id) ) as $child_category ) :
		if( in_category($child_category) ) :
			$in_subcategory = true;
		endif;
	endforeach;
	
	return $in_subcategory;
}
endif;
?>