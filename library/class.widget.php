<?php
class eng_cptloop_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'cpt-loop', // Base ID
			'CPT Loop', // Name
			array('description' => __( 'Displays a CPT loop'))
		   );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['widgettitle'] = strip_tags( $new_instance['widgettitle'] );
		$instance['numberOfPosts'] = strip_tags($new_instance['numberOfPosts']);
		$instance['posttype'] = strip_tags($new_instance['posttype']);
		$instance['taxtype'] = strip_tags($new_instance['taxtype']);
		$instance['taxslug'] = strip_tags($new_instance['taxslug']);
		$instance['looptitle'] = strip_tags($new_instance['looptitle']);
		$instance['looptitlelink'] = strip_tags($new_instance['looptitlelink']);
		$instance['loopcontent'] = strip_tags($new_instance['loopcontent']);
		$instance['loopdate'] = strip_tags($new_instance['loopdate']);
		
		return $instance;
	}


	public function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$widgettitle = apply_filters('widget_title', $instance['widgettitle'] );
		$posttype = $instance['posttype'];
		$numberOfPosts = $instance['numberOfPosts'];
		$taxtype = $instance['taxtype'];
		$taxslug = $instance['taxslug'];
		$looptitle = $instance['looptitle'];
		$looptitlelink = $instance['looptitlelink'];
		$loopcontent = $instance['loopcontent'];
		$loopdate = $instance['loopdate'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $widgettitle ) :
			echo $before_title . $widgettitle . $after_title;
		endif;
		
		/* CPT Output */
		$this->getCPTPosts($numberOfPosts, $posttype, $looptitle, $looptitlelink, $loopcontent, $loopdate, $taxtype, $taxslug);


		/* After widget (defined by themes). */
		echo $after_widget;
	}


	public function getCPTPosts($numberOfPosts, $posttype, $looptitle, $looptitlelink, $loopcontent, $loopdate, $taxtype, $taxslug) {
		global $post;
		
		if ( $taxtype ) :
			$cpt_loop_args = array(
				'posts_per_page' => $numberOfPosts,
				'post_type' => $posttype,
				'tax_query' => array(
					array(
						'taxonomy' => $taxtype,
						'field' => 'slug',
						'terms' => $taxslug,
					),
				),
			);	
		
		else : 
			$cpt_loop_args = array(
				'posts_per_page' => $numberOfPosts,
				'post_type' => $posttype,
			);
		
		endif;
		
		$cpt_loop = new WP_Query();
		$cpt_loop->query($cpt_loop_args);
		
		
		echo '<ul class="widget-list-cptloop widget-list-' . $posttype . '">';
		
		if ( $cpt_loop->found_posts > 0 ) : while ( $cpt_loop->have_posts() ) : $cpt_loop->the_post(); 
			$html = '<li>'; 
			
			if ( $looptitle == 'On' ) :
				$html .= '<h4 class="title widget-title">';
				
			endif;
			
				if ( $looptitlelink == 'On' ) :
					$html .= '<a href="' . get_permalink() . '">';
					
				endif;
				
					if ( $looptitle == 'On' ) :
						$html .= get_the_title();
						
					endif;
				
				if ( $looptitlelink == 'On' ) :
					$html .= '</a>';
					
				endif;
			
			if ( $looptitle == 'On' ) :
				$html .= '</h4>';
				
			endif;

			
			if ( $loopcontent == 'Content' ) :
				$html .= '<div class="content widget-content">' . get_the_content() . '</div>';
				
			elseif ( $loopcontent == 'Excerpt' ) :
				$html .= '<div class="excerpt widget-excerpt">' . get_the_excerpt() . '</div>';
			
			endif;
			
			if ( $loopdate == 'On' ) :
				$html .= '<div class="metatime widget-metatime">' . get_the_time('F, j, Y') . '</div>';
			
			endif;
			
			$html .= '</li>'; 
			
			echo $html; 
					
		endwhile;
			wp_reset_postdata(); 
			
		else :
			echo '<li>No ' . $posttype . ' posts found</li>';
			
		endif;
		echo '</ul>';
	}
		
		
	public function form($instance) {
		if( $instance) :
			$widgettitle = esc_attr($instance['widgettitle']);
			$numberOfPosts = esc_attr($instance['numberOfPosts']);
			$posttype = esc_attr($instance['posttype']);
			$taxtype = esc_attr($instance['taxtype']);
			$taxslug = esc_attr($instance['taxslug']);
			$looptitle = esc_attr($instance['looptitle']);
			$looptitlelink = esc_attr($instance['looptitlelink']);
			$loopcontent = esc_attr($instance['loopcontent']);
			$loopdate = esc_attr($instance['loopdate']);
			
		else :
			$widgettitle = '';
			$numberOfPosts = '';
			$posttype = '';
			$taxtype = '';
			$taxslug = '';
			$looptitle = '';
			$looptitlelink = '';
			$loopcontent = '';
			$loopdate = '';
			
		endif;
		?>
		<p>
			<label for="<?php echo $this->get_field_id('widgettitle'); ?>"><?php _e('Widget Title', 'eng_cptloop_widget'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('widgettitle'); ?>" name="<?php echo $this->get_field_name('widgettitle'); ?>" type="text" value="<?php echo $widgettitle; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posttype'); ?>"><?php _e('Post Type', 'eng_cptloop_widget'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('posttype'); ?>" name="<?php echo $this->get_field_name('posttype'); ?>" type="text" value="<?php echo $posttype; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('taxtype'); ?>"><?php _e('Taxonomy Type', 'eng_cptloop_widget'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('taxtype'); ?>" name="<?php echo $this->get_field_name('taxtype'); ?>" type="text" value="<?php echo $taxtype; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('taxslug'); ?>"><?php _e('Taxonomy Slug', 'eng_cptloop_widget'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('taxslug'); ?>" name="<?php echo $this->get_field_name('taxslug'); ?>" type="text" value="<?php echo $taxslug; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numberOfPosts'); ?>"><?php _e('Number of Posts:', 'eng_cptloop_widget'); ?></label>		
			<select id="<?php echo $this->get_field_id('numberOfPosts'); ?>" name="<?php echo $this->get_field_name('numberOfPosts'); ?>">
				<?php for($x=1;$x<=10;$x++): ?>
				<option <?php echo $x == $numberOfPosts ? 'selected="selected"' : '';?> value="<?php echo $x;?>"><?php echo $x; ?></option>
				<?php endfor;?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('looptitle'); ?>"><?php _e('Loop Title:', 'eng_cptloop_widget'); ?></label>		
			<select id="<?php echo $this->get_field_id('looptitle'); ?>" name="<?php echo $this->get_field_name('looptitle'); ?>">
				<option <?php if ( $looptitle == 'On' ) : echo 'selected="selected"'; endif; ?> value="On">On</option>
				<option <?php if ( $looptitle == 'Off' ) : echo 'selected="selected"'; endif; ?> value="Off">Off</option>
			</select>
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id('looptitlelink'); ?>"><?php _e('Loop Title Link:', 'eng_cptloop_widget'); ?></label>		
			<select id="<?php echo $this->get_field_id('looptitlelink'); ?>" name="<?php echo $this->get_field_name('looptitlelink'); ?>">
				<option <?php if ( $looptitlelink == 'On' ) : echo 'selected="selected"'; endif; ?> value="On">On</option>
				<option <?php if ( $looptitlelink == 'Off' ) : echo 'selected="selected"'; endif; ?> value="Off">Off</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('loopcontent'); ?>"><?php _e('Loop Content:', 'eng_cptloop_widget'); ?></label>		
			<select id="<?php echo $this->get_field_id('loopcontent'); ?>" name="<?php echo $this->get_field_name('loopcontent'); ?>">
				<option <?php if ( $loopcontent == 'Off' ) : echo 'selected="selected"'; endif; ?> value="Off">Off</option>
				<option <?php if ( $loopcontent == 'Content' ) : echo 'selected="selected"'; endif; ?> value="Content">Content</option>
				<option <?php if ( $loopcontent == 'Excerpt' ) : echo 'selected="selected"'; endif; ?> value="Excerpt">Excerpt</option>
			</select>
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id('loopdate'); ?>"><?php _e('Loop Date:', 'eng_cptloop_widget'); ?></label>		
			<select id="<?php echo $this->get_field_id('loopdate'); ?>" name="<?php echo $this->get_field_name('loopdate'); ?>">
				<option <?php if ( $loopdate == 'On' ) : echo 'selected="selected"'; endif; ?> value="On">On</option>
				<option <?php if ( $loopdate == 'Off' ) : echo 'selected="selected"'; endif; ?> value="Off">Off</option>
			</select>
		</p>
		<?php
	}
}



class eng_termsviatax_widget extends WP_Widget {

public function __construct() {
	parent::__construct(
		'terms-via-tax', // Base ID
		'Terms via Taxonomy', // Name
		array('description' => __( 'Displays a list of terms belonging to a particular taxonomy'))
	   );
}

public function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	/* Strip tags (if needed) and update the widget settings. */
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['taxonomy'] = strip_tags($new_instance['taxonomy']);
	$instance['hierarchical'] = $new_instance['hierarchical'];

	return $instance;
}


public function widget( $args, $instance ) {
	extract( $args );

	/* User-selected settings. */
	$title = apply_filters('widget_title', $instance['title'] );
	$taxonomy = $instance['taxonomy'];
	$hierarchical = $instance['hierarchical'];

	/* Before widget (defined by themes). */
	echo $before_widget;

	/* Title of widget (before and after defined by themes). */
	if ( $title ) :
		echo $before_title . $title . $after_title;
	endif;
	
	/* Terms Output */
	$this->getTerms($taxonomy, $hierarchical);


	/* After widget (defined by themes). */
	echo $after_widget;
}


public function getTerms($taxonomy, $hierarchical) {
	global $post;
	
	$cat_args = array(
		'taxonomy' => $taxonomy,
		'hierarchical' => $hierarchical,
		'title_li' => ''
	);
	echo '<ul>';
	wp_list_categories( $cat_args );
	echo '</ul>';
}
	
	
public function form($instance) {
	if ( $instance ) :
		$title = esc_attr($instance['title']);
		$taxonomy = esc_attr($instance['taxonomy']);
		$hierarchical = $instance['hierarchical'];
	else :
		$title = '';
		$taxonomy = '';
		$hierarchical = '';
	endif;
	?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'eng_termsviatax_widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy', 'eng_termsviatax_widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>" type="text" value="<?php echo $taxonomy; ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e('Show Hierarchy', 'eng_termsviatax_widget'); ?></label>
		<input class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>" type="checkbox" value="<?php echo $hierarchical; ?>" <?php echo checked(isset($hierarchical) ? 1 : 0);; ?> />
		</p>
	<?php
	}
}