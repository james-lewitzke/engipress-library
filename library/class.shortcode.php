<?php
class eng_shortcode {
	public $shortcodename;
	public $functionname;

	public function startshortcode() {
		add_shortcode($this->shortcodename, $this->functionname);
	}
}


/* The list of Shortcodes that will appear inside the TinyMCE editor */
class eng_shortcodelist {

	public function startshortcodelist() {
		add_action('init', array(&$this, 'add_button'));  
	}

	public function add_button() {
		if ( current_user_can('edit_posts') && current_user_can('edit_pages') ) :
			add_filter('mce_external_plugins', array(&$this, 'add_plugin'));  
			add_filter('mce_buttons_3', array(&$this, 'register_button')); 
			
		endif;
	}

	public function register_button($buttons) {
		$sclist = $this->sclist;
		$name = $sclist['name'];

		foreach ($sclist as $sc => $scitem) :
			$scitems .= $scitem['name'] . ', ';
		endforeach;

		array_push($buttons, $scitems);
		return $buttons;  
	}

	public function add_plugin($plugin_array) {
		$plugin_array['URL'] = ENGCURRENTPLUGINURL . '/library/js/shortcodejs.php';
		return $plugin_array;  
	}

}
?>