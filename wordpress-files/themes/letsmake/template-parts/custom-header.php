<?php
/**
 * custom header;
 */


use inc\letsmake\storage\Letsmake_Storage;

// $header_posts = get_field('header_tamplate','options');
$storage = new Letsmake_Storage();

$options = $storage->get_option( 'letsmake_settings_general' );

if(!empty($options['general-header']) && $options['general-header'] !== 'on'){
$header_def =$options['general-header'];

 //$header_posts = NULL;//216;
	
		$query = new WP_Query( [
			'post_type' => 'header-build',
			'p'  => (int)$header_def,
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
