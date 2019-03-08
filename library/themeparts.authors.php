<?php
function eng_author_page() {
	echo get_bloginfo('url') . '/author/';
	echo the_author_meta( 'user_login' );
}

function eng_author_commentcount() {
	global $wpdb;
	
	$count = $wpdb->get_var('SELECT COUNT(comment_ID) FROM ' . $wpdb->comments . ' WHERE comment_author = "' . get_comment_author() . '"');
	echo $count;
}

/* Author Template information */
function eng_info_about() {
	global $curauth;

	echo '<div id="info-about">';
		$infoweb = new authorinfo;
		$infoweb->infotitle = 'Join Date';
		$author_registered = date("n/j/Y", strtotime($curauth->user_registered));
		$infoweb->output = $author_registered;
		$infoweb->startinfo();

		$infoweb = new authorinfo;
		$infoweb->infotitle = 'Website';
		$infoweb->output = $curauth->user_url;
		$infoweb->haslink = 'yes';
		$infoweb->linkurl = $curauth->user_url;
		$infoweb->startinfo();

		$infoweb = new authorinfo;
		$infoweb->infotitle = 'AIM';
		$infoweb->output = $curauth->aim;
		$infoweb->startinfo();

		$infoweb = new authorinfo;
		$infoweb->infotitle = 'Yahoo IM';
		$infoweb->output = $curauth->yim;
		$infoweb->startinfo();

		$infoweb = new authorinfo;
		$infoweb->infotitle = 'Jabber';
		$infoweb->output = $curauth->jabber;
		$infoweb->startinfo();

		$infobio = new authorinfo;
		$infobio->infotitle = 'Biography';
		$infobio->output = $curauth->user_description;
		$infobio->startinfo();
	echo '</div>';
}

function eng_info_recent_posts() {
	echo '<div id="info-recentposts">';
	if ( have_posts() ) : while ( have_posts() ) : the_post();

	echo '<article class="post">';
		echo '<div class="post-info-item post-info-item-link"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>';
		echo '<div class="post-info-item post-info-item-cat">';
			the_category(' ');
		echo '</div>';
		
		echo '<div class="post-info-item post-info-item-comments">';
			comments_number('0', '1', '%');
		echo '</div>';
	echo '</article>';

	endwhile; else :
		echo '<p>Sorry, no posts were found.</p>';
		
	endif;
	echo '</div>';
}

function eng_info_recent_comments() {
	global $curauth;
	
	$commentnumber = get_option('posts_per_page');
	$args = array(
		'user_id' => $curauth->ID,
		'number' => $commentnumber
	);

	echo '<div id="info-recentcomments">';
		$comments = get_comments($args); 
		foreach($comments as $comment) :
			$commentpost = $comment->comment_post_ID;
			echo '<div class="infocomment"><div class="infocomment-posted">Posted in: <a href="' . get_permalink($commentpost) . '#comment-' . $comment->comment_ID . '">' . get_the_title($commentpost) . '</a></div>';
			echo '<div class="infocomment-content">' . $comment->comment_content . '</div>';
			echo '</div>';
		endforeach;
	echo '</div>';
}

class authorinfo {

public function startinfo() {
	if ($this->output) :
		echo '<li>';
			echo '<h5 class="infotitle">' . $this->infotitle . '</h5>';
			echo $this->printinfo();
		echo '</li>';
		
	endif;
}

public function printinfo() {
	if ($this->haslink == 'yes') :
		?>
		<a href="<?php echo $this->linkurl; ?>"><?php echo $this->output; ?></a>
		<?php
		
	else:
		echo $this->output;
		
	endif;
}
}

?>