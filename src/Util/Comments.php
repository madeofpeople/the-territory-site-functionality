<?php
/**
 * Comments
 */
namespace SiteFunctionality\Util;

use SiteFunctionality\Abstracts\Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Comments extends Base {

	/**
	 * Post Types
	 *
	 * @var array
	 */
	protected $post_types = array(
		'post',
		'page',
	);

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
		\add_action( 'wp_before_admin_bar_render', array( $this, 'remove_admin_bar_menu' ) );
		\add_action( 'admin_menu', array( $this, 'remove_admin_menu' ) );
		\add_action( 'init', array( $this, 'remove_post_support' ), 100 );
	}

	/**
	 * Removes comments from the admin bar
	 *
	 * @since 1.0.0
	 */
	function remove_admin_bar_menu() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu( 'comments' );
	}

	/**
	 * Removes comments from the admin menu
	 *
	 * @since 1.0.0
	 */
	function remove_admin_menu() {
		\remove_menu_page( 'edit-comments.php' );
	}

	/**
	 * Remove support for comments
	 *
	 * @since 1.0.0
	 */
	function remove_post_support() {
		foreach ( $this->post_types as $post_type ) {
			\remove_post_type_support( $post_type, 'comments' );

		}
	}

}
