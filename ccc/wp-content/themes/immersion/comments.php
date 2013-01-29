<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to theme_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
	<div id="comments" class="clearfix">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', THEME_SLUG ); ?></p>
	</div><!-- #comments -->
	<?php
		return;
		endif;
	?>
	
	

	<?php if ( have_comments() ) : ?>
	

			<h3 id="comments-title">
				<?php
					printf( _n( 'one comment', '%1$s comments', get_comments_number(), THEME_SLUG ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				?>
			</h3>
			
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', THEME_SLUG ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', THEME_SLUG ) ); ?></div>
			</nav>
			<?php endif;  ?>

			<ol class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'theme_comment' ) ); ?>
			</ol>

	
			
		<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			
				<p class="nocomments"><?php _e( 'Comments are closed.', THEME_SLUG ); ?></p>
		
	<?php endif; ?>
	


	<?php if ('open' == $post->comment_status) : ?>

		<div id="respond">

			<h3><?php comment_form_title( __('Leave a Reply',THEME_SLUG), __('Leave a Reply to %s',THEME_SLUG) ); ?></h3>

			<div class="cancel-comment-reply">
				<small><?php cancel_comment_reply_link(); ?></small>
			</div>

			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
			
				<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>

			<?php else : ?>

				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				
				<div class="four columns alpha">

			<?php if ( $user_ID ) : ?>
			
			

				<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

			<?php else : ?>

				<p>
				<label for="author"><small><?php _e('Name',THEME_SLUG); ?> <?php if ($req) echo "*"; ?></small></label>
				<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
				</p>

				<p>
				<label for="email"><small><?php _e('Mail (will not be published)',THEME_SLUG); ?> <?php if ($req) echo "*"; ?></small></label>
				<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
				</p>

				<p>
				<label for="url"><small><?php _e('Website',THEME_SLUG); ?></small></label>
				<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
				</p>

			<?php endif; ?>
			
			</div>
			
			<div class="eight columns omega">

			<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

			<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
			<?php comment_id_fields(); ?>
			</p>
			<?php do_action('comment_form', $post->ID); ?>
			
			</div>

			</form>

			<?php endif; // If registration required and not logged in ?>
			</div>
	<?php endif; // if you delete this the sky will fall on your head ?>

				


	
</div><!-- #comments -->



<?php
function theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', THEME_SLUG ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', THEME_SLUG ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	

	
		<article id="comment-<?php comment_ID(); ?>" >
				
		
			
			<div class="comment-author vcard">
				<?php
				
					echo get_avatar( $comment, 40 );


					/* translators: 1: comment author, 2: date and time */
					printf( '%1$s %2$s',
						sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
						sprintf( '<time pubdate datetime="%2$s">%3$s</time>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( '%1$s', get_comment_date(), get_comment_time() )
						)
					);
				?>

		
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '- reply', THEME_SLUG ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

				<?php edit_comment_link( __( 'edit', THEME_SLUG ), '<span class="edit-link">', '</span>' ); ?>
				
			</div><!-- .comment-author .vcard -->
			
	
			<div class="comment-content"><?php comment_text(); ?></div>
			
			<div class="comment-meta">
			
				
			


				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', THEME_SLUG ); ?></em>
					<br />
				<?php endif; ?>

			</div>


		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
