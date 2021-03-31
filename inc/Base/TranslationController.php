<?php
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
*
*/
class TranslationController extends BaseController
{
	public $settings;

	public $callbacks;

	public $subpages = array();

	public function register()
	{
		if ( ! $this->activated( 'translation_manager' ) ) return;

		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->settings->addSubPages( $this->subpages )->register();
	}

}
