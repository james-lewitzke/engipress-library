<?php
/*
Plugin Name: Engipress Library
Plugin URI: http://engipressmke.com/wp-repo/engipress-library
Description: This is the plugin that powers all Engipress Themes.
Version: 2.0
Author: James Lewitzke
Author URI: http://engipress.com/
*/


/* Some Starting Constants */
define('ENGPLUGINPATH', dirname(__FILE__));
define('ENGCURRENTPLUGINURL', WP_PLUGIN_URL . '/engipress-library');

$theme_data = wp_get_theme( get_bloginfo('stylesheet_url') );
$theme_filedata = get_file_data( get_bloginfo('stylesheet_url'), array('Slug' => 'Slug') );
define('ENGTHEMESLUG', $theme_filedata['Slug']);


/* Start Engipress Library Load */
foreach (glob(ENGPLUGINPATH . '/library/action.*.php') as $libraryfile_action) :
    require_once $libraryfile_action;
endforeach;
?>