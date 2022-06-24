<?php
/**
 * Taxonomy
 *
 * @package   SiteFunctionality
 */
namespace SiteFunctionality\Abstracts;

use SiteFunctionality\Abstracts\Base;

/**
 * Class Taxonomies
 *
 * @package SiteFunctionality\Abstractsl
 * @since 0.1.0
 */
abstract class Taxonomy extends Base {

	/**
	 * Taxonomy data
	 */
	public const TAXONOMY = self::TAXONOMY;

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

		add_action( 'init', array( $this, 'register' ) );

	}

	/**
	 * Register taxonomy
	 *
	 * @since 0.1.0
	 */
	public function register() {

		$labels = array(
			'name'                       => _x( $this::TAXONOMY['title'], 'Taxonomy General Name', 'site-functionality' ),
			'singular_name'              => _x( $this::TAXONOMY['singular'], 'Taxonomy Singular Name', 'site-functionality' ),
			'menu_name'                  => __( $this::TAXONOMY['menu'], 'site-functionality' ),
			'all_items'                  => sprintf( /* translators: %s: post type title */ __( 'All %s', 'site-functionality' ), $this::TAXONOMY['title'] ),
			'parent_item'                => sprintf( /* translators: %s: post type title */ __( 'Parent %s', 'site-functionality' ), $this::TAXONOMY['singular'] ),
			'parent_item_colon'          => sprintf( /* translators: %s: post type title */ __( 'Parent %s:', 'site-functionality' ), $this::TAXONOMY['singular'] ),
			'new_item_name'              => sprintf( /* translators: %s: post type singular title */ __( 'New %s Name', 'site-functionality' ), $this::TAXONOMY['singular'] ),
			'add_new_item'               => sprintf( /* translators: %s: post type singular title */ __( 'Add New %s', 'site-functionality' ), $this::TAXONOMY['singular'] ),
			'edit_item'                  => sprintf( /* translators: %s: post type singular title */ __( 'Edit %s', 'site-functionality' ), $this::TAXONOMY['singular'] ),
			'update_item'                => sprintf( /* translators: %s: post type title */ __( 'Update %s', 'site-functionality' ), $this::TAXONOMY['singular'] ),
			'view_item'                  => sprintf( /* translators: %s: post type singular title */ __( 'View %s', 'site-functionality' ), $this::TAXONOMY['singular'] ),
			'search_items'               => sprintf( /* translators: %s: post type title */ __( 'Search %s', 'site-functionality' ), $this::TAXONOMY['title'] ),

			'separate_items_with_commas' => sprintf( /* translators: %s: post type title */ __( 'Separate %s with commas', 'site-functionality' ), strtolower( $this::TAXONOMY['title'] ) ),
			'add_or_remove_items'        => sprintf( /* translators: %s: post type title */ __( 'Add or remove %s', 'site-functionality' ), strtolower( $this::TAXONOMY['title'] ) ),
			'popular_items'              => sprintf( /* translators: %s: post type title */ __( 'Popular %s', 'site-functionality' ), $this::TAXONOMY['title'] ),
			'search_items'               => sprintf( /* translators: %s: post type title */ __( 'Search %s', 'site-functionality' ), $this::TAXONOMY['title'] ),
			'no_terms'                   => sprintf( /* translators: %s: post type title */ __( 'No %s', 'site-functionality' ), strtolower( $this::TAXONOMY['title'] ) ),
			'items_list'                 => sprintf( /* translators: %s: post type title */ __( '%s list', 'site-functionality' ), $this::TAXONOMY['title'] ),
			'items_list_navigation'      => sprintf( /* translators: %s: post type title */ __( '%s list navigation', 'site-functionality' ), $this::TAXONOMY['title'] ),
		);

		$rewrite = array(
			'slug'       => $this::TAXONOMY['archive'],
			'with_front' => $this::TAXONOMY['with_front'],
		);

		$args = array(
			'labels'            => $labels,
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => $rewrite,
			'show_in_rest'      => true,
			'rest_base'         => $this::TAXONOMY['rest'],
		);
		\register_taxonomy(
			$this::TAXONOMY['id'],
			$this::TAXONOMY['post_types'],
			\apply_filters( \get_class( $this ) . '\Args', $args )
		);
	}
}
