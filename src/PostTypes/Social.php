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

class Social extends PostType {

	/**
	 * PostType data
	 */
	public const POST_TYPE = array(
		'id'          => 'social',
		'slug'        => 'social',
		'menu'        => 'Social',
		'title'       => 'Social Posts',
		'singular'    => 'Social Post',
		'icon'        => 'dashicons-share',
		'taxonomies'  => array(),
		'has_archive' => false,
		'with_front'  => false,
		'rest_base'   => 'social',
		'supports'    => array( 'title', 'thumbnail', 'custom-fields', 'external-links' ),
		// 'template'      => array(
		// array(
		// 'core/paragraph',
		// array(
		// 'placeholder' => 'Add description...',
		// 'anchor'      => 'description',
		// 'className'   => 'description',
		// ),
		// ),
		// array(
		// 'outermost/social-sharing',
		// array(
		// 'className' => 'is-style-logos-only',
		// 'layout'    => array(
		// 'type'        => 'flex',
		// 'orientation' => 'vertical',
		// ),
		// ),
		// array(
		// array(
		// 'outermost/social-sharing-link',
		// array(
		// 'service' => 'twitter',
		// ),
		// ),
		// array(
		// 'outermost/social-sharing-link',
		// array(
		// 'service' => 'facebook',
		// ),
		// ),
		// ),
		// ),
		// ),
		// 'template_lock' => true,
	);

	/**
	 * Post Type fields
	 */
	public const FIELDS = array(
		'_links_to',
		'_links_to_target',
	);

	/**
	 * Init
	 *
	 * @return void
	 */
	public function init() {
		parent::init();
		\add_action( 'acf/init', array( $this, 'register_fields' ) );
		// \add_filter( 'the_title', array( $this, 'filter_title' ), 10, 2 );
		// \add_filter( 'post_type_link', array( $this, 'filter_link' ), 10, 2 );
	}

	/**
	 * Register Custom Fields
	 *
	 * @return void
	 */
	public function register_fields() {}

	/**
	 * Register Meta
	 *
	 * @return void
	 */
	public function register_meta() {}

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

	/**
	 * Modify title
	 *
	 * @param string $title
	 * @param int    $id
	 * @return string $title
	 */
	public function filter_title( $title, $id = null ) : string {
		if ( \is_admin() || self::POST_TYPE['id'] !== \get_post_type( $id ) ) {
			return $title;
		}

		if ( $description = \get_post_meta( $id, '_genesis_title', true ) ) {
			$title = $description;
		}
		return $title;
	}

	/**
	 * Undocumented function
	 *
	 * @param string $url
	 * @param obj    $post
	 * @return string $url
	 */
	public function filter_link( $url, $post ) : string {
		if ( \is_admin() || self::POST_TYPE['id'] !== \get_post_type( $post->ID ) ) {
			return $url;
		}

		if ( $link = \get_post_meta( $post->ID, '_genesis_canonical_uri', true ) ) {
			$url = $link;
		}
		return $url;
	}

}
