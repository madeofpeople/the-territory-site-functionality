<?php
/**
 * Register and Render Block
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\Blocks\PageNav;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Render Block
 *
 * @param array $block_attributes
 * @param string $content
 * @return string
 */
function render( $attributes, $content, $block ) {
    $args = array();
    $wrapper_attributes = \get_block_wrapper_attributes( $args );

    $content = '<div ' . $wrapper_attributes . '>';

    foreach ( $block->inner_blocks as $inner_block ) { 
        \remove_filter( 'the_content', 'wpautop' );
        $content .= \apply_filters( 'the_content', $inner_block->render() );
        \add_filter( 'the_content', 'wpautop' );
    }

    $content .= '</div>';

    return $content;
}

/**
 * Registers the `site-functionality/page-nav` block on the server.
 */
function register() {
	\register_block_type(
		__DIR__,
		[
			'render_callback' 	=> __NAMESPACE__ . '\render',
		]
	);
}
add_action( 'init', __NAMESPACE__ . '\register' );