<?php
/**
 * @package  XTMPlugin
 */
namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
*
*/
class Admin extends BaseController
{
	public $settings;

	public $callbacks;

	public $pages = array();

	public $subpages = array();

	public function register()
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setPages();

		$this->setSubpages();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

	public function setPages()
	{
		$this->pages = array(
			array(
				'page_title' => 'XTM Connect',
				'menu_title' => 'XTM connect',
				'capability' => 'manage_options',
				'menu_slug' => 'xtm_plugin',
				'callback' => array( $this->callbacks, 'adminDashboard' ),
				'icon_url' => 'dashicons-translation',
				'position' => 110
			)
		);
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'xtm_plugin',
				'page_title' => 'translations',
				'menu_title' => 'translations',
				'capability' => 'manage_options',
				'menu_slug' => 'xtm_translations',
				'callback' => array( $this->callbacks, 'adminTranslations' )
			)
		);
	}
}
