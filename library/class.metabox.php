<?php
class eng_metabox {
	public $post;
	var $vars = array();

	public function startbox() {
		add_action('admin_menu', array(&$this, 'eng_add_box') );
		add_action('save_post', array(&$this, 'eng_save_data') );
	}


	public function eng_add_box() {
		if ( $this->vars['page'] == 'all' ) :
			$post_types = get_post_types(); 
			foreach ( $post_types as $post_type ) :
				add_meta_box($this->vars['id'], $this->vars['title'], array(&$this, 'eng_show_box'), $post_type, $this->vars['context'], $this->vars['priority']);
			endforeach;
			
		else:
			add_meta_box($this->vars['id'], $this->vars['title'], array(&$this, 'eng_show_box'), $this->vars['page'], $this->vars['context'], $this->vars['priority']);
			
		endif;
	}


	public function eng_show_box() {
	global $post;

		echo '<input type="hidden" name="eng_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo '<table class="form-table">';

		foreach ($this->vars['fields'] as $field) :
			$meta = get_post_meta($post->ID, $field['id'], true);
			
			echo '<tr>',
					'<th><label for="', $field['id'], '">', $field['name'], '</label></th>',
					'<td>';
			switch ($field['type']) :
				case 'input_text':
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
						'<br />', $field['desc'];
					break;
				case 'textarea':
					echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
						'<br />', $field['desc'];
					break;
				case 'editor':
				wp_editor( $meta, $field['id'], $field['settings'] );
					break;
				case 'select':
					echo '<select name="', $field['id'], '" id="', $field['id'], '">';
					foreach ($field['options'] as $option) :
						echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
					endforeach;
					echo '</select>';
					break;
				case 'input_radio':
					foreach ($field['options'] as $option) :
						echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
					endforeach;
					break;
				case 'input_checkbox':  
				if ( $meta ) : $checkvalue = 'on'; else : $checkvalue = 'off'; endif;
					echo '<input type="hidden" value="off" name="' . $field['id'] .'" />';
					echo '<input type="checkbox" value="' . $checkvalue . '" name="' . $field['id'] .'" id="' . $field['id'] . '" ', $meta == 'on' ? 'checked="checked"' : '' ,'/> 
			<label for="' . $field['id'] . '">' . $field['desc'] . '</label>';  
				break; 
			endswitch;
			echo 	'<td>',
				'</tr>';
		endforeach;
		
		echo '</table>';
	}


	public function eng_save_data($post_id) {
		if (!wp_verify_nonce($_POST['eng_meta_box_nonce'], basename(__FILE__))) :
			return $post_id;
		endif;

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) :
			return $post_id;
		endif;
		
		if ('page' == $_POST['post_type']) :
			if (!current_user_can('edit_page', $post_id)) :
				return $post_id;
			endif;
		elseif (!current_user_can('edit_post', $post_id)) :
			return $post_id;
		endif;
		
		foreach ($this->vars['fields'] as $field) :
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
			
			if ($new && $new != $old) :
				update_post_meta($post_id, $field['id'], $new);
			elseif ('' == $new && $old) :
				delete_post_meta($post_id, $field['id'], $old);
			endif;
			
			
		endforeach;
	}

}
?>