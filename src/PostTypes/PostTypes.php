<?php
/**
 * Content PostTypes
 *
 * @since   1.0.0
 * @package SiteFunctionality
 */
namespace SiteFunctionality\PostTypes;

use SiteFunctionality\Abstracts\Base;
use SiteFunctionality\PostTypes\ShareCard;
use SiteFunctionality\PostTypes\Press;
use SiteFunctionality\PostTypes\Review;
use SiteFunctionality\PostTypes\Social;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PostTypes extends Base {

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
		new Press( $this->version, $this->plugin_name );
		new Review( $this->version, $this->plugin_name );
		new Social( $this->version, $this->plugin_name );

		\add_filter( 'page-links-to-post-types', array( $this, 'external_links' ) );
	}

	/**
	 * Modify Post Types
	 * If post type supports $feature, enable Page Links To
	 * 
	 * @link https://wordpress.org/plugins/page-links-to/
	 * @link https://github.com/markjaquith/page-links-to/blob/master/classes/plugin.php#L517-L519
	 *
	 * @param array $post_types
	 * @return array
	 */
	public function external_links( $post_types ) : array {
		$feature = 'external-links';
		return \get_post_types_by_support( $feature );
	}

}
