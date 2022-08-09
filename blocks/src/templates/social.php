<?php
/**
 * Template for social posts block items
 *
 * @package site-functionality
 */
$post           = $data->post;
$post_id        = $post->ID;
$share_services = array(
	'twitter',
	'facebook',
);
$services       = array(
	'instagram',
	'download',
);
$images         = \get_post_meta( $post_id, 'images', true );
$extra_classname = $images && count( $images ) > 1 ? ' has-multiple-images' : '';

if ( ! empty( $images ) ) :
    $link = \get_post_meta( $post_id, 'link', true );
    $message = \get_post_meta( $post_id, 'message', true );
    ?>
    <article id="post-<?php echo $post_id; ?>" class="social-post<?php echo esc_attr( $extra_classname ); ?>">

        <ul class="image-group">
            <?php
            foreach( $images as $image_id ) :
                ?>
                <li id="image-<?php echo $image_id; ?>"><?php echo \wp_get_attachment_image( $image_id, 'full' ); ?></li>
                <?php
            endforeach;
            ?>
        </ul><!-- .image-groupt -->

        <div class="share-actions">
            <ul class="wp-block-outermost-social-sharing is-style-logos-only">
                <?php
                if ( \get_post_meta( $post_id, 'link', true ) || \get_post_meta( $post_id, 'message', true ) ) :
                    foreach ( $share_services as $service ) :
                        ?>
                        <?php echo Site_Functionality\Blocks\SocialCards\render_block_social_sharing_link( $service, $post_id ); ?>
                        <?php
                    endforeach;
                endif;

                foreach ( $services as $service ) :
                    if ( \get_post_meta( $post_id, $service, true ) ) :
                        ?>
                        <?php echo Site_Functionality\Blocks\SocialCards\render_block_social_sharing_link( $service, $post_id ); ?>
                        <?php
                    endif;
                endforeach;
                ?>
            </ul><!-- .wp-block-outermost-social-sharing -->
        </div><!-- .share-actions -->

    </article><!-- .social-post -->

    <?php
endif;