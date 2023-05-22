<?php
/**
 * function child theme
 */

 include 'inc/add-post-types.php';
 include 'inc/action.php';
 function letsmake_child_theme_scripts() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri() );
    //wp_enqueue_style( 'letsmake-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/assets/css/style.css', ['letsmake-style'] );


    // для підключення своєї бібл-ки markup-style розкоментуй два нижніх рядки 

    // wp_register_style('letsmake-markup-style', get_stylesheet_directory_uri() . '/assets/css/markup-style.css');

    // wp_enqueue_style( 'letsmake-markup-style');

    wp_enqueue_style( 'child-second-style', get_stylesheet_directory_uri() . '/assets/css/style.css',['parent-style']);

    // wp_enqueue_script('child-jquery-js', get_stylesheet_directory_uri() . '/assets/js/jquery-3.6.3.min.js', '', false);
	wp_enqueue_script('child-main-js', get_stylesheet_directory_uri() . '/assets/js/main.js', ('child-jquery-js'), false);

}

add_action( 'wp_enqueue_scripts', 'letsmake_child_theme_scripts' );


/** admin style */
// add_action( 'admin_enqueue_scripts', 'letsmake_child_admin_style');
// function letsmake_child_admin_style(){
//     wp_enqueue_style( 'kmnd-komanda-child-admin-style', get_stylesheet_directory_uri() . '/admin/child-admin-style.css', false ); 
// }

/** after setup theme
 * textdomain
 */

function letsmake_child_theme_setup() {

   load_child_theme_textdomain( 'child-letsmake', get_stylesheet_directory() . '/languages' );

}

add_action( 'after_setup_theme', 'letsmake_child_theme_setup' );

/** remove comments */

function remove_website_field($fields) {
    unset($fields['url']);
    return $fields;
 }
 add_filter('comment_form_default_fields', 'remove_website_field');

function filter_media_comment_status( $open, $post_id) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment') {
        return false;
    }
    return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10, 2 );


/***  ACF Option Page  */
/* add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_sub_page') ) {

        // Add parent.
        $parent = acf_add_options_page(array(
            'page_title'  => __('Налаштування теми'),
            'menu_title'  => __('Налаштування теми'),
            'redirect'    => false,
        ));

        // Add sub page.
        $child = acf_add_options_sub_page(array(
            'page_title'  => __('Каталог Кейсів'),
            'menu_title'  => __('Каталог Кейсів'),
            'parent_slug' => $parent['menu_slug'],
        ));
    }
}*/