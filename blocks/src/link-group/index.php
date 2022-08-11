<?php
/**
 * Register and Render Block
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\Blocks\LinkedGroup;

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
    $args = array(
        'class' =>  'link-group'
    );
    if( isset( $attributes['anchor'] ) && $attributes['anchor'] ) {
        $args['id'] = \esc_attr( $attributes['anchor'] );
    }
    $wrapper_attributes = \get_block_wrapper_attributes( $args );
    if( !isset( $attributes['url'] ) && $attributes['url'] ) {
        return '';
    }

    $output = sprintf( '<a href="%1$s"%2$s%3$s>', 
        \esc_url( $attributes['url'] ), 
        ( isset( $attributes['linkTarget'] ) && $attributes['linkTarget'] ) ? ' target="' . $attributes['linkTarget'] . '"' : '',
        $wrapper_attributes
    );

    foreach ( $block->inner_blocks as $inner_block ) { 
        $output .= \apply_filters( 'the_content', $inner_block->render() );
    }

    $output .= '</a><!-- .link-group -->';

    return $output;
}

/**
 * Registers the `site-functionality/linked-group` block on the server.
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