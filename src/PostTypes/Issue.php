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

class Issue extends PostType {

	/**
	 * PostType data
	 */
	public const POST_TYPE = array(
		'id'          => 'issue',
		'menu'        => 'Issues',
		'title'       => 'Issues',
		'singular'    => 'Issue',
		'icon'        => 'dashicons-book-alt',
		'taxonomies'  => array(),
		'has_archive' => 'issues',
		'with_front'  => false,
		'archive'     => 'issues',
		'rest_base'   => 'issues',
	);

	/**
	 * Post Type fields
	 */
	public const FIELDS = array();

	// /**
	//  * Init
	//  *
	//  * @return void
	//  */
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
