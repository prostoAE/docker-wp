<?php
namespace inc\letsmake\theme;

use inc\letsmake\config\Letsmake_Options;
use inc\letsmake\storage\Letsmake_Storage;

class Letsmake_Theme
{

    public $storag;

    private $theme_options;

    function __construct()
    {
        $this->storag = new Letsmake_Storage();
        $this->theme_options = new Letsmake_Options();
        
     
        add_action( 'wp_head', [$this, 'styles_head'], 0);
        add_action( 'wp_enqueue_scripts', [$this, 'theme_css'] );
        add_action( 'wp_enqueue_scripts', [$this, 'theme_js']  );
        add_action( 'wp_enqueue_scripts', [$this, 'letsmake_markup_style']);
        add_action( 'widgets_init', [$this, 'widgets_init'] );
    }

    public function letsmake_markup_style()
    {
        wp_register_style('letsmake-markup-style', get_template_directory_uri() . '/assets/css/markup-style.css');
        wp_enqueue_style( 'letsmake-markup-style');

    }

    public function theme_css()
    {
        wp_enqueue_style( 'letsmake-style', get_stylesheet_uri(), array(), _S_VERSION );
	    wp_style_add_data( 'letsmake-style', 'rtl', 'replace' );

    }

    public function theme_js()
    {
        wp_enqueue_script( 'letsmake-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

            wp_enqueue_script( 'comment-reply' );

        }

    }

    public function styles_head()
    {

        $name = $this->theme_options->get_field_name('css');
        $options = $this->storag->get_option($name);
        // var_dump($options);
        $light =  !empty($options['color-theme_light']) ? $options['color-theme_light'] : '';
        $dark = !empty($options['color-theme_dark']) ? $options['color-theme_dark'] : '';

       $html = '<meta name="msapplication-TileColor" content="'. $light . '">'.PHP_EOL;
       $html .= '<meta name="theme-color" media="(prefers-color-scheme: light)" content="'. $light . '" />'.PHP_EOL;
       $html .= '<meta name="theme-color" media="(prefers-color-scheme: dark)" content="'. $dark . '" />'.PHP_EOL;

        echo $html . $this->theme_options->get_css_root();

    }


    /**
     * Register widget area.
     *
     * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
     */

    public function widgets_init(){

        $name = $this->theme_options->get_field_name('general');
        $options = $this->storag->get_option($name);

        // var_dump($options);
        // exit;

        if(!empty($options['general-sidebar'])){
            register_sidebar(
                array(
                    'name'          => esc_html__( 'Sidebar', 'letsmake' ),
                    'id'            => 'sidebar-1',
                    'description'   => esc_html__( 'Add widgets here.', 'letsmake' ),
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<div class="widget-title">',
                    'after_title'   => '</div>',
                )
            );
        }

    }

}