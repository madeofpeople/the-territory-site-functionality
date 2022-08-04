<?php
/**
 * Site Functionality
 *
 * @package   SiteFunctionality
 */
namespace SiteFunctionality\Abstracts;

use SiteFunctionality\Abstracts\Base;

/**
 * Class Taxonomies
 *
 * @package SiteFunctionality\App\General
 * @since 0.1.0
 */
abstract class PostType extends Base {

	/**
	 * PostType data
	 */
	public const POST_TYPE = self::POST_TYPE;

	/**
	 * Post Type fields
	 */
	public const FIELDS = self::FIELDS;

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
	 * Initialize the class.
	 *
	 * @since 0.1.0
	 */
	public function init() {
		/**
		 * This general class is always being instantiated as requested in the Bootstrap class
		 *
		 * @see Bootstrap::__construct
		 */

		\add_action( 'init', array( $this, 'register' ) );
		\add_filter( 'query_vars', array( $this, 'registerQueryVars' ) );

	}

	/**
	 * Register post type
	 *
	 * @since 0.1.0
	 */
	public function register() {
		$labels  = array(
			'name'                  => _x( $this::POST_TYPE['title'], 'Post Type General Name', 'site-functionality' ),
			'singular_name'         => _x( $this::POST_TYPE['singular'], 'Post Type Singular Name', 'site-functionality' ),
			'menu_name'             => __( $this::POST_TYPE['menu'], 'site-functionality' ),
			'name_admin_bar'        => __( $this::POST_TYPE['singular'], 'site-functionality' ),

			'add_new'               => sprintf( /* translators: %s: post type singular title */ __( 'New %s', 'site-functionality' ), $this::POST_TYPE['singular'] ),
			'add_new_item'          => sprintf( /* translators: %s: post type singular title */ __( 'Add New %s', 'site-functionality' ), $this::POST_TYPE['singular'] ),
			'new_item'              => sprintf( /* translators: %s: post type singular title */ __( 'New %s', 'site-functionality' ), $this::POST_TYPE['singular'] ),
			'edit_item'             => sprintf( /* translators: %s: post type singular title */ __( 'Edit %s', 'site-functionality' ), $this::POST_TYPE['singular'] ),
			'view_item'             => sprintf( /* translators: %s: post type singular title */ __( 'View %s', 'site-functionality' ), $this::POST_TYPE['singular'] ),
			'view_items'            => sprintf( /* translators: %s: post type title */ __( 'View %s', 'site-functionality' ), $this::POST_TYPE['title'] ),
			'all_items'             => sprintf( /* translators: %s: post type title */ __( 'All %s', 'site-functionality' ), $this::POST_TYPE['title'] ),
			'search_items'          => sprintf( /* translators: %s: post type title */ __( 'Search %s', 'site-functionality' ), $this::POST_TYPE['title'] ),

			'archives'              => sprintf( /* translators: %s: post type title */ __( '%s Archives', 'site-functionality' ), $this::POST_TYPE['singular'] ),
			'attributes'            => sprintf( /* translators: %s: post type title */ __( '%s Attributes', 'site-functionality' ), $this::POST_TYPE['singular'] ),
			'parent_item_colon'     => sprintf( /* translators: %s: post type title */ __( 'Parent %s:', 'site-functionality' ), $this::POST_TYPE['singular'] ),
			'update_item'           => sprintf( /* translators: %s: post type title */ __( 'Update %s', 'site-functionality' ), $this::POST_TYPE['singular'] ),
			'items_list'            => sprintf( /* translators: %s: post type singular title */ __( '%s List', 'site-functionality' ), $this::POST_TYPE['title'] ),
			'items_list_navigation' => sprintf( /* translators: %s: post type singular title */ __( '%s list navigation', 'site-functionality' ), $this::POST_TYPE['title'] ),

			'insert_into_item'      => sprintf( /* translators: %s: post type title */ __( 'Insert into %s', 'site-functionality' ), strtolower( $this::POST_TYPE['singular'] ) ),
			'uploaded_to_this_item' => sprintf( /* translators: %s: post type title */ __( 'Uploaded to this %s', 'site-functionality' ), strtolower( $this::POST_TYPE['singular'] ) ),
			'filter_items_list'     => sprintf( /* translators: %s: post type title */ __( 'Filter %s list', 'site-functionality' ), strtolower( $this::POST_TYPE['title'] ) ),
			'featured_image'        => __( 'Featured Image', 'site-functionality' ),
		);
		$rewrite = array(
			'slug'       => array_key_exists( 'slug', $this::POST_TYPE ) ? $this::POST_TYPE['slug'] : $this::POST_TYPE['id'],
			'with_front' => array_key_exists( 'with_front', $this::POST_TYPE ) ? $this::POST_TYPE['with_front'] : false,
		);
		$args    = array(
			'label'               => $this::POST_TYPE['title'],
			'labels'              => $labels,
			'supports'            => array_key_exists( 'supports', $this::POST_TYPE ) ? $this::POST_TYPE['supports'] : array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author', 'page-attributes' ),
			'taxonomies'          => array_key_exists( 'taxonomies', $this::POST_TYPE ) ? $this::POST_TYPE['taxonomies'] : array(),
			'hierarchical'        => array_key_exists( 'hierarchical', $this::POST_TYPE ) ? $this::POST_TYPE['hierarchical'] : false,
			'public'              => array_key_exists( 'public', $this::POST_TYPE ) ? $this::POST_TYPE['public'] : true,
			'show_ui'             => array_key_exists( 'show_ui', $this::POST_TYPE ) ? $this::POST_TYPE['show_ui'] : true,
			'show_in_menu'        => array_key_exists( 'show_in_menu', $this::POST_TYPE ) ? $this::POST_TYPE['show_in_menu'] : true,
			'menu_icon'           => array_key_exists( 'icon', $this::POST_TYPE ) ? $this::POST_TYPE['icon'] : 'dashicons-admin-post',
			'menu_position'       => array_key_exists( 'menu_position', $this::POST_TYPE ) ? $this::POST_TYPE['menu_position'] : 4,
			'show_in_admin_bar'   => array_key_exists( 'show_in_admin_bar', $this::POST_TYPE ) ? $this::POST_TYPE['show_in_admin_bar'] : true,
			'show_in_nav_menus'   => array_key_exists( 'show_in_nav_menus', $this::POST_TYPE ) ? $this::POST_TYPE['show_in_nav_menus'] : true,
			'can_export'          => array_key_exists( 'can_export', $this::POST_TYPE ) ? $this::POST_TYPE['can_export'] : true,
			'has_archive'         => array_key_exists( 'has_archive', $this::POST_TYPE ) ? $this::POST_TYPE['has_archive'] : true,
			'rewrite'             => $rewrite,
			'exclude_from_search' => array_key_exists( 'exclude_from_search', $this::POST_TYPE ) ? $this::POST_TYPE['exclude_from_search'] : false,
			'publicly_queryable'  => array_key_exists( 'publicly_queryable', $this::POST_TYPE ) ? $this::POST_TYPE['publicly_queryable'] : true,
			'capability_type'     => array_key_exists( 'capability', $this::POST_TYPE ) ? $this::POST_TYPE['capability'] : 'post',
			'show_in_rest'        => array_key_exists( 'show_in_rest', $this::POST_TYPE ) ? $this::POST_TYPE['show_in_rest'] : true,
			'rest_base'           => array_key_exists( 'rest_base', $this::POST_TYPE ) ? $this::POST_TYPE['rest_base'] : $this::POST_TYPE['archive'],
			'template_lock'       => array_key_exists( 'template_lock', $this::POST_TYPE ) ? $this::POST_TYPE['template_lock'] : false,
		);
		if ( array_key_exists( 'template', $this::POST_TYPE ) && ! empty( $this::POST_TYPE['template'] ) ) {
			$args['template'] = $this::POST_TYPE['template'];
		}

		\register_post_type(
			$this::POST_TYPE['id'],
			\apply_filters( \get_class( $this ) . '\Args', $args )
		);

	}

	/**
	 * Register custom query vars
	 *
	 * @link https://developer.wordpress.org/reference/hooks/query_vars/
	 *
	 * @param array $vars The array of available query variables
	 */
	abstract public function registerQueryVars( $vars );

}
