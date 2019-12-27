<?php 

/** 
 * Plugin Name: Submissions Dashboard
 * Plugin URI: https://developer.wordpress.org/plugins/intro/
 * Description: A dashboard toolkit with advanced interaction controls.
 * Version: 1.0.0
 * Author: Rafael Peralta Jr
 * Author URI: http://rafaelperaltajr.com
 * License: GPLv2 or later
 * **/

 // * Exit if accessed directly
if( !defined('ABSPATH') ): 
    exit;
endif;

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

// * Load scripts
require_once(plugin_dir_path(__FILE__) . '/includes/load-scripts.php');

// * Create admin menu
require_once(plugin_dir_path(__FILE__) . '/includes/create-admin-menu.php');