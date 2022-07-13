<?php
/**
 * Plugin Name:         Site Functions
 * Description:         Custom functions for site
 * Author:              Pea Lutz
 * Author URI:          https://pealutz.me
 * Text Domain:         site-functionality
 * Domain Path:         /languages
 * Version:             1.0.0
 * Requires at least:   5.8
 * Requires PHP:        7.2
 *
 * @package             SiteFunctionality
 */
namespace SiteFunctionality;

require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

use SiteFunctionality\Admin\Admin;
use SiteFunctionality\Api\RestApi;
use SiteFunctionality\CustomFields\CustomFields;
use SiteFunctionality\PostTypes\PostTypes;
use SiteFunctionality\Taxonomies\Taxonomies;
use SiteFunctionality\Util\Util;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin Directory
 *
 * @since 0.1.0
 */
define( 'SITE_CORE_DIR', dirname( __FILE__ ) );
define( 'SITE_CORE_DIR_URI', plugin_dir_url( __FILE__ ) );

if ( class_exists( '\Dotenv\Dotenv' ) ) {
	$dotenv = \Dotenv\Dotenv::createImmutable( __DIR__ );
	$dotenv->safeLoad();
}

const PLUGIN  = 'site-functionality';
const VERSION = '1.0.0';

function site_functionality_init() {
	load_plugin_textdomain( 'site-functionality', false, SITE_CORE_DIR . '/languages' );

	include_once SITE_CORE_DIR . '/src/Abstracts/Base.php';
	include_once SITE_CORE_DIR . '/src/Abstracts/PostType.php';
	include_once SITE_CORE_DIR . '/src/Abstracts/Taxonomy.php';

	$admin = new Admin( VERSION, PLUGIN );
	$restAPI = new RestApi( VERSION, PLUGIN );
	$taxonomies   = new Taxonomies( VERSION, PLUGIN );
	$postTypes    = new PostTypes( VERSION, PLUGIN );
	$customFields = new CustomFields( VERSION, PLUGIN );
	$util = new Util( VERSION, PLUGIN );
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\site_functionality_init' );

/**
 * Activation
 *
 * @return void
 */
function site_functionality_activate() {
	\flush_rewrite_rules();
}
\register_activation_hook( __FILE__, __NAMESPACE__ . '\site_functionality_activate', );

/**
 * Deactivation
 *
 * @return void
 */
function site_functionality_deactivate() {
	\flush_rewrite_rules();
}
\register_deactivation_hook( __FILE__, __NAMESPACE__ . '\site_functionality_deactivate' );