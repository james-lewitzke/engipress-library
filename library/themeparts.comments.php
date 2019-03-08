<?php
function eng_comment() {
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<div class="comment-none">This post is password protected. Enter the password to view comments.</div>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<?php
	if ( have_comments() ) : ?>
	<!-- <h3 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3> -->

	<ol class="comments-list">
		<?php wp_list_comments('callback=eng_nice_comments'); ?>
	</ol>

	<div class="navigation comment-navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<div class="comment-none">Comments are closed.</div>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : 

$current_user = wp_get_current_user();
?>
<div id="respond" class="comment-respond">
	<div class="comment-form-title">
		<h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>
	</div>

	<div class="comment-reply-cancel">
		<?php cancel_comment_reply_link(); ?>
	</div>
	
	<div class="comment-required-note">
		Your email address will not be published. Required fields are marked *
	</div>
	
	

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<div class="comment-loggedout comment-notice">
			You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.
		</div>
		
	<?php else : ?>
			
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
			<div class="comment-textarea">
				<label for="comment-textarea">Comment<?php if ($req) echo " (required)"; ?></label>
				<textarea name="comment" id="comment" cols="70%" rows="10" tabindex="4"></textarea>
			</div>
			<?php if ( is_user_logged_in() ) : ?>
				<div class="comment-loggedin">
					Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $current_user->user_login; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a>
				</div>

			<?php else : ?>
				<div class="comment-loggedout-items">
					<div class="comment-loggedout-name comment-loggedout-item">
						<label for="author">Name *<?php if ($req) echo " (required)"; ?></label>
						<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
					</div>

					<div class="comment-loggedout-email comment-loggedout-item">
						<label for="email">Email *<?php if ($req) echo " (required)"; ?></label>
						<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
					</div>

					<div class="comment-loggedout-website comment-loggedout-item">
						<label for="url">Website</label>
						<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
					</div>
				</div>

			<?php endif; ?>
			
			<!--
			<div class="comment-html">
				<strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code>
			</div>
			-->

			<div class="comment-submit">
				<input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
				<?php comment_id_fields(); ?>
			</div>
			<?php do_action('comment_form', $post->ID); ?>
		</form>

	<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head	
}


function eng_nice_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; 
	global $commenti;

	$user = get_userdata($comment->user_id);
	$post_count = get_usernumposts($user->ID);
	
	if ( $comment->comment_author_email == get_the_author_email() )  :
		$comment_class = 'author-comment';
		
	else : 
		$comment_class = 'regular-comment';
		
	endif;
	?>

	<li <?php comment_class($comment_class); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
			
			<div class="comment-left">
				<?php echo get_avatar($comment,$size='60'); ?>
				<div class="comment-reply" id="comment-reply-<?php comment_ID(); ?>">
					<?php 
						comment_reply_link( array(
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
						 ) ); 
					 ?>
				</div>
			</div>
			
			<div class="comment-right">
				<div class="comment-name">
					<?php comment_author(); ?>
				</div>
				
				<div class="comment-date">
					<?php echo get_comment_date('m-d-Y') . ', ' . get_comment_time('g:i a'); ?>
				</div>
				
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>
			</div>
			
			<div class="clear comment-clear"></div>
		</div>
	</li>
<?php
}


function eng_forum_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; 
global $commenti;

$user = get_userdata($comment->user_id);
$post_count = get_usernumposts($user->ID);
?>

<li <?php comment_class('space'); ?> id="li-comment-<?php comment_ID() ?>">
<div id="comment-<?php comment_ID(); ?>">
	
	<div class="commentmeta">
		<?php echo '<span class="commentmetaleft left">';
		echo get_comment_date('m-d-Y') . ', ' . get_comment_time('g:i a');
		echo '</span>';
		?>
		
		<?php
		
		$commenti++;
		echo '<span class="commentmetaright right"><a href="'. get_comment_link() .'"> &#35;' . $commenti . '</a>';
		edit_comment_link(__('(Moderate)'),'  ','');
		echo '</span>';
		?>
	</div>

	<div class="commenttop clear">
	<div class="left">
		<?php echo get_avatar($comment,$size='75'); ?>
	</div>
	
	<div class="left">
	<?php
	if ($comment->user_id) :
		echo '<div class="commentusername" id="commentname-';
		comment_ID();
		echo '">' . $user->user_login . '</div>';
		echo '<div class="commenttitle">' . $user->nickname . '</div>';
	else :
		echo '<div class="commentname">Guest</div>';
		echo '<div class="commenttitle">n / a</div>';
	endif;
	?>
	</div>
		
		<div class="right">
		<div class="commentinfo commentname">
		Name: <span class="commentdata"><?php comment_author(); ?></span>
		</div>
		<!-- Only important for multiple authors
		<div class="commentinfo commentcount">
		Posts: <span class="commentdata"><?php echo $post_count; ?></span>
		</div>
		-->
		<div class="commentinfo commentcount">
		Comments: <span class="commentdata"><?php eng_author_commentcount(); ?></span>
		</div>
		</div>
		
	</div>

	<?php if ($comment->comment_approved == '0') : ?>
	<em><?php _e('Your comment is awaiting moderation.') ?></em>
	<?php endif; ?>

	<div class="commentbottom clear">
	<div class="commenttext" id="commenttext-<?php comment_ID(); ?>">
	<?php comment_text(); ?>
	</div>
	<hr />
	<div class="commentsig">
	<?php eng_convert_url(); ?>
	</div>
	<div class="commentquotebutton" id="commentquotebutton-<?php comment_ID(); ?>">
	<a href="#respond">Quote</a>
	</div>
	</div>
	<div class="clear"></div>

</div>

<?php
}

/* Comment Signature Generator */
function eng_convert_url() {
	$cqurl = get_comment_author_url();

	if (!empty($cqurl)) :
		$cqfile = file($cqurl);
		$cqfile = implode("",$cqfile);

		if (preg_match("/<title>(.+)<\/title>/i",$cqfile,$m)) :
			echo '<a href="' . $cqurl . '">' . "$m[1]" . '</a>';
			
		else :
			echo comment_author_url_link();
			
		endif;
	
	else :
		echo '';
	endif;
}