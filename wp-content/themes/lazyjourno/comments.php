<?php if ( post_password_required() ) {
	return;
} 

$new_defaults = array(
	'comment_field' => '<div class="form-group"><label for="comment">' . _x( 'Comment', 'noun' ) . ':</label><textarea id="comment" name="comment" class="form-control" rows="5" aria-required="true"></textarea></div>'
	);

?>
		<?php comment_form($new_defaults); ?>
	<div id="comments" class="comments-area">
		<?php if ( have_comments() ) : ?>
			<ul class="comment-list">
				<?php 
				wp_list_comments( array(
					'short_ping'  => true,
					'avatar_size' => 50,
				) );
				?>
			</ul>
		<?php endif; ?>
		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			<p class="no-comments">
				<?php _e( 'Comments are closed.' ); ?>
			</p>
		<?php endif; ?>
	</div>