<?php 
class eng_postobject {
	public function startpostobject() {
		add_action( 'init', array($this, 'eng_register_new_object') );
/*
		if ( is_admin() ) :
			if ( $this->type == 'taxonomy' ) :
				$managecolumns = 'manage_' . $this->name . '_posts_columns';
				$managecustomcolumns = 'manage_' . $this->name . '_posts_custom_column';
				
				add_filter( $managecolumns, $this->eng_cpt_columns );
				add_action( $managecustomcolumns, $this->eng_cpt_custom_column, 10, 2);
			endif;
		endif;*/
	}


	public function eng_register_new_object() {
		if ( $this->type == 'cpt' ) :
			register_post_type( $this->name, $this->args);

		elseif ( $this->type == 'taxonomy' ) :
			register_taxonomy( $this->name, $this->posttypeassign, $this->args);

		endif;
	}

	public function eng_cpt_columns($defaults) {
		$defaults[$this->name] = $this->args['label'];
		return $defaults;
	}

	public function eng_cpt_custom_column($column_name, $post_id) {
		$taxonomy = $column_name;
		$post_type = get_post_type($post_id);
		$terms = get_the_terms($post_id, $taxonomy);
	 
		if ( !empty($terms) ) :
			foreach ( $terms as $term ) :
				$post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
				echo join( ', ', $post_terms );
			endforeach;
			
		else :
			echo '<i>No terms.</i>';
			
		endif;
	}

}
?>