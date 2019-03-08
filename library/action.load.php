<?php
/* Load Classes */
foreach (glob(ENGPLUGINPATH . '/library/class.*.php') as $libraryfile_class) :
	require_once $libraryfile_class;
endforeach;


/* Load Features */
foreach (glob(ENGPLUGINPATH . '/library/features.*.php') as $libraryfile_feature) :
	require_once $libraryfile_feature;
endforeach;


/* Load Theme Parts */
foreach (glob(ENGPLUGINPATH . '/library/themeparts.*.php') as $libraryfile_themepart) :
	require_once $libraryfile_themepart;
endforeach;


/* Load Media Fields */
foreach (glob(ENGPLUGINPATH . '/library/media/*.php') as $plugin_media) :
	require_once $plugin_media;
endforeach;


/* Load Option Pages */
foreach (glob(ENGPLUGINPATH . '/library/optionpages/*.php') as $plugin_optionpage) :
	require_once $plugin_optionpage;
endforeach;

foreach (glob(get_template_directory() . '/optionpages/*.php') as $theme_optionpage) :
	require_once $theme_optionpage;
endforeach;


/* Load Post Objects */
foreach (glob(get_template_directory() . '/postobjects/*.php') as $postobject) :
    require_once $postobject;
endforeach;


/* Load Metaboxes */
foreach (glob(ENGPLUGINPATH . '/library/metaboxes/*.php') as $plugin_metabox) :
	require_once $plugin_metabox;
endforeach;

foreach (glob(get_template_directory() . '/metaboxes/*.php') as $theme_metabox) :
    require_once $theme_metabox;
endforeach;


/* Load Sidebars */
foreach (glob(get_template_directory() . '/widgetareas/*.php') as $sidebar) :
    require_once $sidebar;
endforeach;


/* Load Shortcodes */
foreach (glob(ENGPLUGINPATH . '/library/shortcodes/*.php') as $shortcode) :
	require_once $shortcode;
endforeach;


require_once 'vars.shortcodes.php';
global $shortcode_editor_row;

$shortcoderow4 = new eng_shortcodelist;
$shortcoderow4->sclist = $shortcode_editor_row;
$shortcoderow4->startshortcodelist();


/* Load Widgets */
add_action( 'widgets_init', 'eng_register_new_widgets');

function eng_register_new_widgets() {
	register_widget('eng_cptloop_widget');
	register_widget('eng_termsviatax_widget');
}
?>