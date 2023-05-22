<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package letsmake
 */

get_header();

use inc\letsmake\storage\Letsmake_Storage;

$storage = new Letsmake_Storage();

$options = $storage->get_option( 'letsmake_settings_general' );

echo '	<main id="primary" class="site-main">';

if(!empty($options['general-404']) && $options['general-404'] !== 'on'){
$errr_def = $options['general-404'];

		$query = new WP_Query( [
			'post_type' 	 => 'sections-build',
			'p'  	 		 => (int)$errr_def,
			'posts_per_page' => 1
		] );
		if (  $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post(); 
			the_content();
				endwhile;
		endif;
		wp_reset_postdata(  );

}else{
?>

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'letsmake' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'letsmake' ); ?></p>

					<?php
					get_search_form();

					the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'letsmake' ); ?></h2>
						<ul>
							<?php
							wp_list_categories(
								array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								)
							);
							?>
						</ul>
					</div><!-- .widget -->

					<?php
					/* translators: %1$s: smiley */
					$letsmake_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'letsmake' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$letsmake_archive_content" );

					the_widget( 'WP_Widget_Tag_Cloud' );
					?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

<?php
}
echo '</main><!-- #main -->';

get_footer();
