<?php
class eng_widgetarea {
	public $name;
	public $posttype;

	public function startwidgetarea() {
		if ( function_exists('dynamic_sidebar') ) :
			register_sidebar(array(
				'name' => $this->name,
				'id' => $this->name,
				'before_widget' => '<div class="widget ' . $this->posttype . '-widget">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widgettitle ' . $this->posttype . '-widgettitle">',
				'after_title' => '</h3>',
				'description' => 'Widget area on ' . $this->posttype . ' Template'
			));
		endif;
	}
}

?>