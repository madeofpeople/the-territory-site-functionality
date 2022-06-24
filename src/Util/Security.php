<?php
/**
 * Content Security
 *
 * @since   1.0.0
 * @package SiteFunctionality
 */
namespace SiteFunctionality\Util;

use SiteFunctionality\Abstracts\Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Security extends Base {

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
	 * Add Actions
	 *
	 * @return void
	 */
	public function init() {
		/**
		 * @see https://developer.wordpress.org/reference/hooks/wp_is_application_passwords_available/
		 */
		\add_filter( 'wp_is_application_passwords_available', '__return_true' );
	}

}