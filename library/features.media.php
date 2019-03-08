<?php
function eng_standard_custom_image_sizes() {
	add_image_size('custom-size-150x150', 150, 150, true);
	add_image_size('custom-size-200x200', 200, 200, true);
	add_image_size('custom-size-250x250', 250, 250, true);
	add_image_size('custom-size-200x300', 200, 300, true);
	add_image_size('custom-size-300x200', 300, 200, true);
}
add_action( 'after_setup_theme', 'eng_standard_custom_image_sizes' );


function eng_mediaquery_image_sizes() {
	global $post;
	global $wp_query;
	
	$media_library_queryargs = array(
		'post_type' => 'attachment',
		'post_status' => 'inherit',
	);
	$media_library_query = new WP_Query();
	$media_library_query->query($media_library_queryargs);
	
	echo '
	<style type="text/css">

	@media screen and (max-width: 980px) {
	';
	if ( $media_library_query->have_posts() ) : while ( $media_library_query->have_posts() ) : $media_library_query->the_post(); 
		$tablet_width = get_post_meta( get_the_ID(), '_image_tablet_width', true );
		$tablet_height = get_post_meta( get_the_ID(), '_image_tablet_height', true );
		echo '
		.wp-image-' . get_the_ID() . ' {
		width: ' . $tablet_width . ';
		height: ' . $tablet_height . ';
		}
		';
	endwhile; else:
		echo 'sorry no images found';
	endif;
	wp_reset_postdata();
	
	echo '
	}

	@media screen and (max-width: 700px) {
	';
	if ( $media_library_query->have_posts() ) : while ( $media_library_query->have_posts() ) : $media_library_query->the_post(); 
		$mobile_width = get_post_meta( get_the_ID(), '_image_mobile_width', true );
		$mobile_height = get_post_meta( get_the_ID(), '_image_mobile_height', true );
		echo '
		.wp-image-' . get_the_ID() . ' {
		width: ' . $mobile_width . ';
		height: ' . $mobile_height . ';
		}
		';
	endwhile; else:
		echo 'sorry no images found';
	endif;
	wp_reset_postdata();

	echo '
	}
	</style>
	';
}
?>