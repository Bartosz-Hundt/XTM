<?php
/**
 * @package  XTMplugin
 */
/*
Plugin Name: XTMplugin
Plugin URI: github.com
Description: This is my first attempt on writing a custom Plugin for XTM.
Version: 1.0.0
Author: Bartosz Hundt
Author URI: https://fb.com
License: GPLv3 or later
Text Domain: xtm-plugin
*/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_xtm_plugin() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_xtm_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_xtm_plugin() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_xtm_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
}
