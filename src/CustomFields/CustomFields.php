<?php
/**
 * Content CustomFields
 *
 * @since   1.0.0
 * @package SiteFunctionality
 */
namespace SiteFunctionality\CustomFields;

use SiteFunctionality\Abstracts\Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CustomFields extends Base {

	/**
	 * Custom fields
	 */
	public const FIELDS = array();

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
		\add_action( 'acf/init', array( $this, 'acf_settings' ) );
		\add_action( 'acfe/init', array( $this, 'acfe_settings' ) );
	}

	/**
	 * Modify ACF settings
	 *
	 * @link https://www.advancedcustomfields.com/resources/acf-settings/
	 *
	 * @return void
	 */
	public function acf_settings() {
		\acf_update_setting( 'l10n_textdomain', 'site-functionality' );

		\acf_update_setting( 'acfe/modules/taxonomies', false );
		\acf_update_setting( 'acfe/modules/forms', false );
		\acf_update_setting( 'acfe/modules/options_pages', false );
		\acf_update_setting( 'acfe/modules/post_types', false );
		\acf_update_setting( 'acfe/modules/ui', false );
	}

	/**
	 * Modify ACF settings
	 *
	 * @link https://www.acf-extended.com/features/modules/dynamic-options-pages
	 *
	 * @return void
	 */
	public function acfe_settings() {
		\acfe_update_setting( 'modules/taxonomies', false );
		\acfe_update_setting( 'modules/forms', false );
		\acfe_update_setting( 'modules/options_pages', false );
		\acfe_update_setting( 'modules/post_types', false );
		\acfe_update_setting( 'modules/ui', false );
	}
}
