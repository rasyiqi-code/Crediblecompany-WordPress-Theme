<?php
/**
 * Komentar Layout Kustom
 * Merender setiap item komentar individu bergaya app/mobile-first.
 * 
 * @package CredibleCompany
 */

if ( ! function_exists( 'cc_modern_comment_layout' ) ) :
/**
 * Callback untuk wp_list_comments().
 */
function cc_modern_comment_layout( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class( empty( $args['has_children'] ) ? 'app-comment-item' : 'app-comment-item parent' ); ?> id="comment-<?php comment_ID() ?>">
        
        <div class="comment-body-app">
            <div class="comment-author-avatar">
                <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
            </div>
            
            <div class="comment-content-wrap">
                <div class="comment-meta-app flex-between">
                    <span class="comment-author-name">
                        <?php echo get_comment_author_link(); ?>
                        <?php if ( $comment->comment_parent > 0 ) : ?>
                            <?php $parent = get_comment( $comment->comment_parent ); ?>
                            <span class="replying-to">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                                Kepada <?php echo esc_html( $parent->comment_author ); ?>
                            </span>
                        <?php endif; ?>
                    </span>
                    <span class="comment-time-app">
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                            <?php 
                                /* translators: 1: date, 2: time */
                                printf( esc_html__( '%1$s', 'crediblecompany' ), get_comment_date() ); 
                            ?>
                        </a>
                    </span>
                </div>

                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <p class="comment-awaiting-moderation"><?php esc_html_e( 'Komentar Anda sedang menunggu moderasi.', 'crediblecompany' ); ?></p>
                <?php endif; ?>

                <div class="comment-text-app">
                    <?php comment_text(); ?>
                </div>

                <div class="comment-reply-app">
                    <?php 
                    comment_reply_link( array_merge( $args, array(
                        'reply_text' => 'Balas',
                        'depth'      => $depth,
                        'max_depth'  => $args['max_depth']
                    ) ) ); 
                    ?>
                </div>
            </div>
        </div>
    <?php
}
endif;
