<?php
/**
 * @package  XTMPlugin
 */
namespace Inc\Base;

class Activate
{
	public static function activate() {
		flush_rewrite_rules();

		$default = array();

		if ( ! get_option('xtm_plugin_translation')) {
			update_option('xtm_plugin_translation',$default);
		}
		
	}
}
