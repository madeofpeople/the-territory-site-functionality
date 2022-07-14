<?php
/**
 * Rest API Functions
 *
 * @since   1.0.0
 * @package SiteFunctionality
 */

namespace SiteFunctionality\Api;

use SiteFunctionality\Abstracts\Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RestApi extends Base {

	/**
	 * @var string
	 */
	const API_NAMESPACE = 'site-functionality/v1';

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
		\add_action( 'rest_api_init', array( $this, 'register_routes' ) );
		\add_filter( 'rest_user_query', array( $this, 'rest_user_modify_query' ), 10, 2 );
		\add_filter( 'rest_user_collection_params', array( $this, 'rest_user_collection_add_params' ), 10, 2 );
	}

	/**
	 * Register API Routes
	 *
	 * @return void
	 */
	public function register_routes() {}

	/**
	 * Add Param to user collection
	 *
	 * @see: https://developer.wordpress.org/reference/hooks/rest_user_collection_params/
	 *
	 * @param array $query_params
	 * @return array $query_params
	 */
	public function rest_user_collection_add_params( $query_params ) : array {
		return $query_params;
	}

	/**
	 * Modify the user query
	 *
	 * @param array           $prepared_args
	 * @param WP_REST_Request $request
	 * @return array $prepared_args
	 */
	public function rest_user_modify_query( $prepared_args, $request ) : array {
		return $prepared_args;
	}

}
