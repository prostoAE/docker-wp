<?php
/**
 * custom footer;
 */


use inc\letsmake\storage\Letsmake_Storage;

$storage = new Letsmake_Storage();

$options = $storage->get_option( 'letsmake_settings_general' );

if(!empty($options['general-footer']) && $options['general-footer'] !== 'on'){
$footer_def =$options['general-footer'];

		$query = new WP_Query( [
			'post_type' 	 => 'footer-build',
			'p'  	 		 => (int)$header_def,
			'posts_per_page' => 1
		] );
		if (  $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post(); 
			the_content();
				endwhile;
		endif;
		wp_reset_postdata(  );

}
