<?php
if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.1.0' );
}
//require_once get_template_directory() . '/vendor/autoload.php';

function letsmake_setup() {
	load_theme_textdomain( 'letsmake', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'letsmake' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support(
		'custom-background',
		apply_filters(
			'letsmake_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}

add_action( 'after_setup_theme', 'letsmake_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */

function letsmake_content_width() {

	$GLOBALS['content_width'] = apply_filters( 'letsmake_content_width', 640 );
}

add_action( 'after_setup_theme', 'letsmake_content_width', 0 );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function letsmake_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'letsmake' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'letsmake' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

//add_action( 'widgets_init', 'letsmake_widgets_init' );


/**
 * post-types.
 */

 require get_template_directory() . '/inc/add-post-types.php';
 
/**
 * Theme init.
 */

 require get_template_directory() . '/inc/letsmake/class-letsmake-init.php';
 

/**
 * Implement the Custom Header feature.
 */

require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */

require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */

if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

////redirect 301
function rudr_url_redirects() {
    /* in this array: old URLs=>new URLs  */
    $redirect_rules = [
          [
          'old' => '/header-build/',
          'new' => '/'
          ],
          [
            'old' => '/footer-build/',
            'new' => '/'
          ],
		  [
			'old' => '/sections-build/',
			'new' => '/'
		  ],
        ];

    foreach( $redirect_rules as $rule ) :
		 if (stripos(urldecode($_SERVER['REQUEST_URI']),  $rule['old']) !== false) {
        	wp_redirect( site_url( $rule['new'] ), 301 );
        	exit();
    	}
    endforeach;
  }
  add_action('template_redirect', 'rudr_url_redirects');
  