<?php
/**
 * Utilies
 */
namespace SiteFunctionality\Util;

use SiteFunctionality\Abstracts\Base;
use SiteFunctionality\Util\Comments;
use SiteFunctionality\Util\Filters;
use SiteFunctionality\Util\Security;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Util extends Base {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name ) {
		parent::__construct( $version, $plugin_name );
		$this->init();
	}

	/**
	 * Init
	 *
	 * @return void
	 */
	public function init() {
		include_once SITE_CORE_DIR . '/src/Util/Comments.php';
		$comments = new Comments( $this->version, $this->plugin_name );
	}

}
