<?php
class eng_query extends WP_Query {

public function startquery() {
	$this->eng_main_query();
}


public function eng_main_query() {
global $postperpage;
global $post;
global $box_system_panels;


if ( $this->pagination == true ) :
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
else : 
	$paged = null;
endif;



if ( $this->args == 'searchresults' ) : 
	global $query_string;
	
	$query_args = explode("&", $query_string);
	$queryargs = array(
		'meta_query'=> array(
			array(
				'key'     => 'eng_mb_search_exclude',
				'value'   => 'on',
				'compare' => 'NOT LIKE',
			),
		),
	);

	foreach($query_args as $key => $string) :
		$query_split = explode("=", $string);
		$queryargs[$query_split[0]] = urldecode($query_split[1]);
	endforeach;

elseif ( $this->args == 'currentpost' ) : 
	$queryargs = array(
		'post_type' => $this->posttype,
		'p' => get_queried_object_id()
	);
	
elseif ( $this->args == 'archives_monthly' ) : 
	$queryargs = array(
		'post_type' => $this->posttype,
		'posts_per_page' => 99999,
		'order' => 'DESC',
	);
	
elseif ( $this->args == 'cpt_loop' ) : 
	$queryargs = array(
		'post_type' => $this->posttype,
		'posts_per_page' => get_option('posts_per_page'),
		'paged' => $paged,
	);
	
elseif ( $this->args ) : // was == array(), loops didn't work
	$queryargs = $this->args;

else :
	$queryargs = array(
		'post_type' => $this->posttype,
		//'posts_per_page' => $this->postsperpage,
		'paged' => $paged,
	);

endif;


$querymain = new WP_Query();
$querymain->query($queryargs);
if ( $querymain->have_posts() ) : while ( $querymain->have_posts() ) : $querymain->the_post(); 

	if ( $this->args == 'archives_monthly' ) :

		if( $querymain->current_post === 0 ) :

		   the_date( 'F Y' );

		else :

			$f = $querymain->current_post - 1;       
			$old_date = mysql2date( 'F', $querymain->posts[$f]->post_date ); 

			if( eng_date('month-old') != $old_date ) :
				the_date( 'F Y' );
				
			endif;
			
		endif;
	endif;

	

if ( isset ($this->elements['wrap']) ) :
	$wrap = $this->elements['wrap'];
endif;

if ( isset ($this->elements['wrap']['tag']) ) :
	$wraptag = $this->elements['wrap']['tag'];
else : 
	$wraptag = 'div';
endif;

if ( isset ($this->elements['wrap']['class']) ) :
	$wrapclass = $this->elements['wrap']['class'];
else : 
	$wrapclass = '';
endif;


echo '<' . $wraptag . ' class="container ' . $this->posttypesingle . '-container';
	if ( has_post_thumbnail() ) :
		$container_thumb_classes = ' floatarea hasthumb';	
		
		if ( isset ($this->elements['thumbnail']['position']['desktop']) ) :
			$container_thumb_classes .= ' hasthumb-desktop-' . $this->elements['thumbnail']['position']['desktop'];
		endif;
		
		if ( isset ($this->elements['thumbnail']['position']['tablet']) ) :
			$container_thumb_classes .= ' hasthumb-tablet-' . $this->elements['thumbnail']['position']['tablet'];
		endif;
		
		if ( isset ($this->elements['thumbnail']['position']['mobile']) ) :
			$container_thumb_classes .= ' hasthumb-mobile-' . $this->elements['thumbnail']['position']['mobile'];
		endif;
		
		
		if ( $this->elements['thumbnail']['type'] == 'custom' ) :
			$container_thumb_classes .= ' hasthumb-' . $this->elements['thumbnail']['name'];
			
		elseif ($this->elements['thumbnail']['type']) :
			$container_thumb_classes .= ' hasthumb-' . $this->elements['thumbnail']['type'];
		
		endif;
		
		echo $container_thumb_classes;
		
	else :
		echo ' nothumb';	
		
	endif;
	
	if ($wrapclass) : echo ' ' . $wrapclass; endif;
	
	if ( is_system_panels() ) :
		if ( isset ($this->elements['panels-off'] )) :
			echo '';
		else : 
			echo ' panel" id="panel-' . get_post_field( 'post_name', get_the_ID() );
		endif;
	endif;
	echo '"';
	
	eng_schema_atts_article();
	
	if ( isset($wrap['css']) ) :
		echo ' style="';
			foreach ( $wrap['css'] as $styleproperty => $stylevalue ) :
				echo $styleproperty . ': ' . $stylevalue . '; ';
			endforeach;
		echo '"';
	elseif ( isset($wrap['cssmeta']) ) :
		echo ' style="';
			foreach ( $wrap['cssmeta'][''] as $styleproperty => $stylevalue ) :
				echo $styleproperty . ': ' . do_shortcode(get_post_meta(get_the_ID(), $stylevalue, true )) . '; ';
			endforeach;
		echo '"';
	elseif ( $wrap['csspanel'] == true ) :
		echo ' style="';
			foreach ( $box_system_panels->vars['fields'] as $styleitem ) :
			
				$csspanelmeta = get_post_meta(get_the_ID(), $styleitem['id'], true );
				if ( ! empty($csspanelmeta) ) :
					if ( $styleitem['cssproperty'] == 'background-image') :
						echo $styleitem['cssproperty'] . ': url(\'' . do_shortcode(get_post_meta(get_the_ID(), $styleitem['id'], true )) . '\');';
					else :
						echo $styleitem['cssproperty'] . ': ' . do_shortcode(get_post_meta(get_the_ID(), $styleitem['id'], true )) . ';';
					endif;
				endif;
			endforeach;
		echo '"';
	endif;
echo '>';


if ( isset ($this->elements['subwrap']['tag']) ) :
	$subwraptag = $this->elements['subwrap']['tag'];
elseif ( is_system_panels() ) :
	if ( isset ($this->elements['panels-off'] )) :
	else :
		$subwraptag = 'div';
	endif;
endif;


if ( isset ($subwraptag) ) :
	echo '<' . $subwraptag . ' class="subcontainer ' . $this->posttypesingle . '-subcontainer';
	
		if ( isset($this->elements['subwrap']['class']) ) : 
			echo ' ' . $this->elements['subwrap']['class']; 
			
		elseif ( isset($this->elements['subwrap']['href']) ) : 
			echo ' link ' . $this->posttypesingle . '-link'; 
			
		elseif ( is_system_panels() ) :
			if ( isset ($this->elements['panels-off'] )) :
			else :
				echo ' panel-inner wrap floatarea';
			endif;
		endif;
		
		echo '"';
		
	
		if ( isset($this->elements['subwrap']['href']) ) : 
			echo ' href="' . do_shortcode(get_post_meta($post->ID, $this->elements['subwrap']['href'], true)) . '"'; 
		endif;
		
		if ( isset($this->elements['subwrap']['target']) ) : 
			echo ' target="' . $this->elements['subwrap']['target'] . '"'; 
		endif;
	
	echo '>';
endif;


	if ( isset ($this->elements) ) :
		$elementsbasic = $this->elements;
	
		uasort($elementsbasic, function($a, $b) {
			return $a['order'] - $b['order'];
		});
	
		foreach ( $elementsbasic as $elementkey => $elementvalue ) :
			$elementsresults = $this->$elementkey();
			echo $elementsresults;
			
		endforeach;
	endif;
	

if ( isset ($subwraptag) ) :
	echo '</' . $subwraptag . '>';
endif;


echo '</' . $wraptag . '>';


endwhile; 

	if ( $this->pagination == true ) :
		echo '<div class="navigation ' . $this->posttypesingle . '-navigation floatarea">';

		$big = 999999999;
		$total_pages = $querymain->max_num_pages;
		
		if ($total_pages > 1) :
			$current_page = max(1, get_query_var('paged'));

			echo '<div>' . paginate_links(array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '/page/%#%',
				'current' => $current_page,
				'total' => $total_pages,
			)) . '</div>';
		endif;
		
		echo '</div>';
	endif;

else:
	if ( $this->posttype == 'search' ) :
		echo '<div class="404-search">Sorry, no results were found.</div>';
	
	else :
		echo '<div class="404">Sorry, no ' . $this->posttype . ' were found.</div>';

	endif;
endif;


wp_reset_postdata();
}


/* Loop Elements */
public function title() {
	echo '<h3 class="title ' . $this->posttypesingle . '-title data ' . $this->posttypesingle . '-data"';
		eng_schema_atts_headline();
	echo '>';
		if ( $this->elements['title']['link'] == true ) : echo '<a href="' . get_the_permalink() . '">'; endif;
			echo the_title();
		if ( $this->elements['title']['link'] == true ) : echo '</a>'; endif;
	echo '</h3>';
}	

	
public function datetime() {
	echo '<div class="datetime ' . $this->posttypesingle . '-datetime data ' . $this->posttypesingle . '-data">' . $this->elements['datetime']['datetimeprefix'] . get_the_time($this->elements['datetime']['format']) . '</div>';
}


public function thumbnail() {
	global $post;
	
	if ( has_post_thumbnail() ) :
		if ( $this->elements['thumbnail']['type'] == 'custom' ) :
			$thumb_class = $this->elements['thumbnail']['name'] . ' ';
			
		else :
			$thumb_class = $this->elements['thumbnail']['type'] . ' ';
		
		endif;
		
	
		echo '<div class="thumb thumb-' . $thumb_class . $this->posttypesingle . '-thumb">';
		
		if ( $this->elements['thumbnail']['link'] ) :
			echo '<a href="';
		
				if ( $this->elements['thumbnail']['link']['type'] == 'post' ) :
					echo get_permalink();
					
				elseif ( $this->elements['thumbnail']['link']['type'] == 'customfield' ) :
					echo get_post_meta($post->ID, $this->elements['thumbnail']['link']['url'], true);
					
				elseif ( $this->elements['thumbnail']['link']['type'] == 'custom' ) :
					echo $this->elements['thumbnail']['link']['url'];
					
				endif;
			
			echo '"';
				if ( $this->elements['thumbnail']['link']['target'] == '_blank' ) :
					echo ' target="_blank"';
				
				endif;
			
			echo '>';
		endif;
		
		if ( ( $this->elements['thumbnail']['type'] == 'thumbnail' ) || ( $this->elements['thumbnail']['type'] == 'medium' ) | ( $this->elements['thumbnail']['type'] == 'large' ) ||( $this->elements['thumbnail']['type'] == 'full' ) ) :
			the_post_thumbnail( $this->elements['thumbnail']['type'] );
		
		elseif ( $this->elements['thumbnail']['type'] == 'custom' ) :
			the_post_thumbnail($this->elements['thumbnail']['name']);
			
		else :
			the_post_thumbnail($this->elements['thumbnail']['type']);
			
		endif;
		
		if ( $this->elements['thumbnail']['link'] ) :
			echo '</a>';
		endif;
		
		echo '</div>';
	endif;
}


public function content() {
	echo '<div class="content ' . $this->posttypesingle . '-content content-' . $this->elements['content']['type'] . ' data ' . $this->posttypesingle . '-data"';
		eng_schema_atts_misc_content();
	echo '>';
	
	if ( $this->elements['content']['type'] == 'excerpt' ) :	
		the_excerpt();
	elseif ( $this->elements['content']['type'] == 'full' ) :	
		the_content();
	endif;
	
	echo '</div>';
}


public function biography() {
	echo '<div class="biography ' . $this->posttypesingle . '-biography floatarea">';
	
	$image = get_avatar( get_the_author_meta( 'ID' ) );
	
	$name = $this->elements['biography']['list']['name']['label'] . get_the_author_meta( $this->elements['biography']['list']['name']['type'] );
	
	$continue_posts = '<a class="link-continue link-continue-posts" href="' . get_author_posts_url( get_the_author_meta('ID')) . '">' . $this->elements['biography']['list']['content']['continue_posts'] . '</a>';
	
	$continue_bio = '<a class="link-continue link-continue-bio" href="' . eng_url() . '/biography/' . get_the_author_meta('user_nicename') . '">' . $this->elements['biography']['list']['content']['continue_bio'] . '</a>';
	
	$content = wp_trim_words( get_the_author_meta( 'description' ), $this->elements['biography']['list']['content']['length'] ) . '<div class="link-continue-wrap">' . $continue_bio . $continue_posts . '</div>';
	
	
	
	
	$bio_list = $this->elements['biography']['list'];

	uasort($bio_list, function($a, $b) {
		return $a['order'] - $b['order'];
	});
	
	foreach ( $bio_list as $bio_list_key => $bio_list_value ) :
		echo '<div class="biography-' . $bio_list_key . '">';
			echo $$bio_list_key;
		echo '</div>';
	endforeach;
	
	echo '</div>';
}	
	
	
public function author() {
	echo '
	<div class="author ' . $this->posttypesingle . '-author data ' . $this->posttypesingle . '-data">
	';
	if ( $this->elements['author']['label'] == true ) :
		echo '<span class="authorlabel">' . $this->elements['author']['label'] . '</span>';
	endif;
	
	if ( $this->elements['author']['link'] == true ) :
		echo '<a href="' . get_author_posts_url( get_the_author_meta('ID')) . '">';
	endif;
	
		echo get_the_author();
		
	if ( $this->elements['author']['link'] == true ) :
		echo '</a>';
	endif;
	
	echo '
	</div>
	';
	
	if ( $this->elements['author']['meta'] ) :
		echo '<div class="metaitem metaauthor ' . $this->posttypesingle . '-metaauthor">' . get_the_author_meta($this->elements['author']['meta']) . '</div>';
	endif;
}
	
	
public function terms() {
	$terms_list = $this->elements['terms']['list'];
	
	uasort($terms_list, function($a, $b) {
		return $a['order'] - $b['order'];
	});

	foreach ( $terms_list as $terms_item_key => $terms_item_value ) :
		echo '<div class="terms ' . $this->posttypesingle . '-terms terms-' . $terms_item_key . ' data ' . $this->posttypesingle . '-data">';
			the_terms($post->ID, $terms_item_key, '<span class="termlabel">' . $terms_item_value['label'] . '</span>', ', ');
		echo '</div>';
	endforeach;
}


public function comments() {
	if ( $this->elements['comments']['number'] == true ) :
		echo '<div class="comments comments-number">';
			comments_number();
		echo '</div>';
	endif;

	if ( $this->elements['comments']['template'] == true ) :
		echo '<div class="comments comments-template">';
			comments_template();
		echo '</div>';
	endif;
}


public function customfields() {
	global $post;
	
	$customfields_list = $this->elements['customfields']['list'];
	
	echo '<div class="customfields floatarea">';
	
	foreach ( $customfields_list as $customfield_item_key => $customfield_item_value ) :	
		echo '<div class="customfield customfield-' . $customfield_item_value['type'] . ' ' . $this->posttypesingle . '-customfield data ' . $this->posttypesingle . '-data">';
		
		
		if ( $customfield_item_value['type'] == 'link' ) :	
			echo '<a';
			
			if ( $customfield_item_value['parts']['href'] ) : 
				echo ' href="' . do_shortcode(get_post_meta($post->ID, $customfield_item_value['parts']['href'], true)) . '"'; 
			endif;
			
			if ( $customfield_item_value['parts']['target'] ) : 
				echo ' target="' . $customfield_item_value['parts']['target'] . '"'; 
			endif;

			echo '>';
			
		endif;
		
		if ( $customfield_item_value['prefix'] ) :
			echo $customfield_item_value['prefix'];
			
		endif;
		
		
		if ( get_post_meta($post->ID, $customfield_item_value['parts']['text'], true) ) :
			 echo  do_shortcode(get_post_meta($post->ID, $customfield_item_value['parts']['text'], true));
			 
		elseif ( $customfield_item_value['parts']['text'] ) :
			echo $customfield_item_value['parts']['text'];
			
		endif;
		
		
		if ( $customfield_item_value['type'] == 'link' ) :	
			echo '</a>';

		endif;
		
		echo '</div>';

	endforeach;
	
	echo '</div>';
}


public function otherposts() {
	echo '<div class="navigation ' . $this->posttypesingle . '-navigation floatarea">';
		previous_post_link('<span class="prev">&laquo; %link</span>');
		next_post_link('<span class="next">%link &raquo;</span>'); 
	echo '</div>';
}


public function separator() {
	echo '<hr class="separator ' . $this->posttype . '-separator" />';
}
}
?>