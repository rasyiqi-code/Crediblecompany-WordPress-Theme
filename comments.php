<?php
/**
 * Template untuk menampilkan komentar dan formulir komentar.
 *
 * @package CredibleCompany
 */

/*
 * Jika password dibutuhkan untuk postingan ini dan
 * user belum memasukkannya, kita akan kembali saja
 * tanpa memuat komentar.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="app-comments-section">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ( '1' === $comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( '1 Komentar untuk "%1$s"', 'crediblecompany' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s Komentar untuk "%2$s"', '%1$s Komentar untuk "%2$s"', $comment_count, 'comments title', 'crediblecompany' ) ),
					number_format_i18n( $comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<ol class="app-comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 48,
				'callback'    => 'cc_modern_comment_layout'
			) );
			?>
		</ol>

		<?php
		the_comments_navigation( array(
            'prev_text' => '&larr; Komentar Sebelumnya',
            'next_text' => 'Komentar Selanjutnya &rarr;',
        ) );

		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Komentar telah ditutup.', 'crediblecompany' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

    // Kostumisasi form komentar
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html_req = ( $req ? " required='required'" : '' );

    $comments_args = array(
        // Ganti judul "Leave a Reply"
        'title_reply'          => '<span class="reply-title">Tulis Komentar</span>',
        'title_reply_to'       => '<span class="reply-title">Balas ke %s</span>',
        // Hapus tulisan "Logged in as..." dan teks sejenis di bawah judul
        'logged_in_as'         => '',
        'comment_notes_before' => '<p class="form-instruction">Bagikan pendapat atau pertanyaan Anda di bawah ini.</p>',
        'comment_notes_after'  => '',
        // Format tombol submit
        'class_submit'         => 'btn-primary-app btn-submit-full mt-4',
        'label_submit'         => 'Kirim Komentar',
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
        // Field textarea (Komentar)
        'comment_field'        => '<div class="form-group-app comment-form-comment"><textarea id="comment" name="comment" class="form-control" placeholder="Tulis komentar Anda di sini..." cols="45" rows="5" maxlength="65525" required="required"></textarea></div>',
        // Field nama, email, web
        'fields'               => array(
            'author' => '<div class="form-group-app comment-form-author">' .
                        '<input id="author" name="author" type="text" class="form-control" placeholder="Nama Lengkap' . ($req ? ' *' : '') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></div>',
            'email'  => '<div class="form-group-app comment-form-email">' .
                        '<input id="email" name="email" type="email" class="form-control" placeholder="Alamat Email' . ($req ? ' *' : '') . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></div>',
            'url'    => '<div class="form-group-app comment-form-url">' .
                        '<input id="url" name="url" type="url" class="form-control" placeholder="Website (opsional)" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></div>',
            'cookies' => '', // Sembunyikan checkbox cookie "Save my name..."
        ),
    );

	comment_form( $comments_args );
	?>

</div><!-- #comments -->
