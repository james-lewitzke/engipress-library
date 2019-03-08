<?php 
$schemaURL = 'http://schema.org/';

/* General Schema Calls */
function eng_schema_atts_html() {
    global $schemaURL;
 
    if ( is_blog() ) :
        $type = 'Blog';

    elseif ( is_front_page() ) :
        $type = 'Website';
		
	elseif ( is_page('about') || is_page('about-us') ) :
		$type = 'AboutPage';
		
	elseif ( is_page('contact') || is_page('contact-us') ) :
		$type = 'ContactPage';

    else :
        $type = 'WebPage';
		
	endif;
 
    echo ' itemscope itemtype="' . $schemaURL . $type . '"';
}

function eng_schema_atts_title() {
	$prop = 'name';
	
	echo ' itemprop="' . $prop . '"';
}

function eng_schema_atts_headline() {
	$prop = 'headline';

	echo ' itemprop="' . $prop . '"';
}

function eng_schema_atts_image() {
	$prop = 'image';

	echo ' itemprop="' . $prop . '"';
}

function eng_schema_atts_misc_content() {
	$prop = 'text';

	echo ' itemprop="' . $prop . '"';
}

function eng_schema_atts_misc_date() {
	$prop = 'datePublished';

	echo ' itemprop="' . $prop . '"';
}



/* Automatic Schema */
function eng_schema_atts_nav($nav_menu,$args) {
    global $schemaURL;

    //map out the nav_menu for parsing
    $dom = new DOMDocument();
    @$dom->loadHTML($nav_menu);
    $x = new DOMXPath($dom);

    //parse the <a> nodes
    foreach($x->query("//a") as $node) {
        $node->setAttribute("itemprop","url");
    }

    //parse the <li> nodes
    foreach($x->query("//li") as $node) {
        //$node->setAttribute("itemsomething","xxxx");
    }

    //parse the <ul> nodes
    foreach($x->query("//ul") as $node) {
        //$node->setAttribute("itemsomething","xxxx");
    }

    //parse the <nav> nodes
    foreach($x->query("//nav") as $node) {
        $node->setAttribute("itemscope", "itemscope");
        $node->setAttribute("itemtype", $schemaURL.'SiteNavigationElement');
    }

    //regenerate the html
    //NOTE: this assumes only one nav node. Multiple nav nodes will break this filter
    $nav_menu = $node->c14n();

    return $nav_menu;
}
add_filter( 'wp_nav_menu', 'eng_schema_atts_nav', 10, 2 );

function eng_schema_atts_nav_li( $atts, $item ) {
    $atts['itemprop'] = 'url';
    return $atts;
}
//add_filter( 'nav_menu_link_attributes', 'eng_schema_atts_nav_li', 10, 2 );


function eng_schema_atts_article() {	
	global $schemaURL;
	if ( is_blog() ) :
		$type = 'BlogPosting';
		$prop = 'blogpost';
	else :
		$type = 'Article';
		$prop = 'articleBody';
	endif;

	echo ' itemscope itemtype="' . $schemaURL . $type . '" itemprop="' . $prop . '"';
}


/* Schema Shortcodes */
$sc_schema_heading = new eng_shortcode;
$sc_schema_heading->shortcodename = 'schemaheading';
$sc_schema_heading->functionname = 'eng_schema_atts_headline';
$sc_schema_heading->startshortcode();

$sc_schema_image = new eng_shortcode;
$sc_schema_image->shortcodename = 'schemaimage';
$sc_schema_image->functionname = 'eng_schema_atts_image';
$sc_schema_image->startshortcode();
?>