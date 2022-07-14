<?php
/**
 * Content PostTypes
 *
 * @since   1.0.0
 * @package SiteFunctionality
 */
namespace SiteFunctionality\PostTypes;

use SiteFunctionality\Abstracts\PostType;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ShareCard extends PostType {

	/**
	 * PostType data
	 */
	public const POST_TYPE = array(
		'id'          => 'share',
		'slug'        => 'share-card',
		'menu'        => 'Share Cards',
		'title'       => 'Share Card',
		'singular'    => 'Share Card',
		'icon'        => 'dashicons-share-alt2',
		'taxonomies'  => array(),
		'has_archive' => 'share-cards',
		'with_front'  => false,
		'rest_base'   => 'share-cards',
	);

	/**
	 * Post Type fields
	 */
	public const FIELDS = array();

	// /**
	// * Init
	// *
	// * @return void
	// */
	// public function init() {}

	/**
	 * Register custom query vars
	 *
	 * @link https://developer.wordpress.org/reference/hooks/query_vars/
	 *
	 * @param array $vars The array of available query variables
	 */
	public function registerQueryVars( $vars ) : array {
		return $vars;
	}

}
