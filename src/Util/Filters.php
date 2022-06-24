<?php
/**
 * Content Filters
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

class Filters extends Base {

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
		 * @see https://make.wordpress.org/core/2021/07/01/block-styles-loading-enhancements-in-wordpress-5-8/
		 */
		\add_filter( 'should_load_separate_core_block_assets', '__return_true' );
	}

}