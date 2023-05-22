<?php

use inc\letsmake\config\Letsmake_Options;
use inc\letsmake\storage\Letsmake_Storage;

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package letsmake
 */

  if(class_exists('Letsmake_Options') && class_exists('Letsmake_Storage')){

	$t_options = new Letsmake_Options();
	$storag = new Letsmake_Storage();
	$name = $t_options->get_field_name('general');
	$options = $storag->get_option($name);

	// var_dump($options['general-sidebar']);
	if ( is_active_sidebar( 'sidebar-1' ) && !empty($options['general-sidebar'])) {

	?>
	<aside id="secondary" class="widget-area">

		<?php dynamic_sidebar( 'sidebar-1' ); ?>

	</aside><!-- #secondary -->

	<?php
	}
 }