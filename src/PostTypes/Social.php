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
	public function register_fields() {
		acf_add_local_field_group(
			array(
				'key'                   => 'group_social_cards',
				'title'                 => __( 'Social Card Template', 'site-functionality' ),
				'fields'                => array(
					array(
						'key'               => 'field_social_images',
						'label'             => __( 'Images', 'site-functionality' ),
						'name'              => 'images',
						'type'              => 'gallery',
						'instructions'      => __( 'Images to display in share card.', 'site-functionality' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'return_format'     => 'id',
						'preview_size'      => 'thumbnail',
						'insert'            => 'append',
						'library'           => 'all',
						'min'               => '',
						'max'               => '',
						'min_width'         => '',
						'min_height'        => '',
						'min_size'          => '',
						'max_width'         => '',
						'max_height'        => '',
						'max_size'          => '',
						'mime_types'        => 'jpg, png, gif, webp',
					),
					array(
						'key'               => 'field_social_message',
						'label'             => __( 'Message', 'site-functionality' ),
						'name'              => 'message',
						'type'              => 'textarea',
						'instructions'      => __( 'Text to add to share message.', 'site-functionality' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'maxlength'         => '',
						'rows'              => 4,
						'new_lines'         => '',
					),
					array(
						'key'               => 'field_social_link',
						'label'             => __( 'Link', 'site-functionality' ),
						'name'              => 'link',
						'type'              => 'url',
						'instructions'      => __( 'URL to add to share message', 'site-functionality' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
					),
					array(
						'key'               => 'field_social_instagram_link',
						'label'             => __( 'Instagram Link', 'site-functionality' ),
						'name'              => 'instagram',
						'type'              => 'url',
						'instructions'      => __( 'Instagram link to send users to.', 'site-functionality' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
					),
					array(
						'key'               => 'field_social_file',
						'label'             => __( 'File', 'site-functionality' ),
						'name'              => 'download',
						'type'              => 'file',
						'instructions'      => __( 'Compressed file that can be downloaded by users.', 'site-functionality' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'return_format'     => 'id',
						'library'           => 'all',
						'min_size'          => '',
						'max_size'          => '',
						'mime_types'        => 'zip',
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'social',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => array(),
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 0,
			)
		);
	}

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
