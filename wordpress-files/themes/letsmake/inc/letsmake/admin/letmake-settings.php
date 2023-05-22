<?php
namespace inc\letsmake\admin;

use inc\letsmake\config\Letsmake_Fields;

use inc\letsmake\config\Letsmake_Options;

use inc\letsmake\storage\Letsmake_Storage;

class Letmake_Settings
{
    public $page_slug;

    public $option_group;

    private $storage;

    private $theme_options;

    private $theme_fields;

    public $icon_url;

    function __construct()
    {
        $this->storage = new Letsmake_Storage();
        $this->theme_options = new Letsmake_Options();
        $this->theme_fields = new Letsmake_Fields();

        $this->page_slug = 'letsmake_settings';
        $this->option_group = 'letsmake_settings_group';
        $this->icon_url = get_template_directory_uri( ) . '/admin/assets/img/fire.svg';

        add_action('admin_menu', array($this, 'add'), 25);
        add_action('admin_init', array($this, 'settings'));
        add_action('admin_notices', array($this, 'notice'));

    }

    function add()
    {
        add_menu_page('Lets Make', 'Lets Make Theme', 'manage_options', $this->page_slug, [$this, 'display'], $this->icon_url, 5 );
        add_submenu_page( $this->page_slug, 'General', 'General', 'manage_options', $this->page_slug, [$this, 'display_general'], 5 );
        // add_submenu_page( $this->page_slug, 'Header', 'Header', 'manage_options', $this->page_slug . '_header', [$this, 'display_header'] );
        // add_submenu_page( $this->page_slug, 'Footer', 'Footer', 'manage_options', $this->page_slug . '_footer', [$this, 'display_footer'] );
        add_submenu_page( $this->page_slug, 'Style', 'Style', 'manage_options', $this->page_slug . '_style', [$this, 'display_style'] );
        add_submenu_page( $this->page_slug, 'Plugins', 'Plugins', 'manage_options', $this->page_slug . '_plugins', [$this, 'display_plugins'] );
        add_submenu_page( $this->page_slug, 'Support', 'Support', 'manage_options', $this->page_slug . '_support', [$this, 'display_support'],100 );

    }

    function display()
    {

        echo '<div class="wrap">
         <h1>' . get_admin_page_title() . '</h1>
         <form method="post" action="/wp-admin/admin.php?page=' . $this->page_slug . '">';

        settings_fields($this->option_group);
        do_settings_sections($this->page_slug);
        submit_button();

        echo '</form></div>';
    }

    function settings()
    {
        $name_header = 'promocode_modal_head_text';
        $name_footer = 'promocode_modal_footer_tex';

        register_setting($this->option_group, $name_header, array('sanitize_callback' => 'sanitize_text_field'));
        register_setting($this->option_group, $name_footer, array('sanitize_callback' => 'sanitize_text_field'));

        // add_settings_section('promocode_section', '', [$this, 'descr'], $this->page_slug);
        // add_settings_field($name_header, 'Текст в модальном окне промокода ( вверху )', array($this, 'field'), $this->page_slug, 'promocode_section', array('name' => $name_header));
        // add_settings_field($name_footer, 'Текст в модальном окне промокода ( внизу )', array($this, 'field'), $this->page_slug, 'promocode_section', array('name' => $name_footer));

    }

    function field($args)
    {
        wp_editor(
            get_option($args['name']),
            $args['name'],
            array(
                'textarea_name' => $args['name'],
                'textarea_rows' => 4,
                'media_buttons' => 0,
                'wpautop' => 0,
                'teeny' => 0,
                'dfw' => 0,
                'tinymce' => 0,
                'quicktags' => 0,
                'drag_drop_upload' => 0

            )

        );
    }

    function notice()
    {

        if (
            isset($_GET['page'])
            && $this->page_slug == $_GET['page']
            && isset($_GET['settings-updated'])
            && true == $_GET['settings-updated']
        ) {
            echo '<div class="notice notice-success is-dismissible"><p>Save!</p></div>';
        }
    }

    public function display_general()
    { 
        $fields_name = $this->theme_options->get_field_name('general');
        $args_display = $this->theme_fields->get_general_args();
        $arr = [];
       
        if ( $fields_name && isset($_POST[$fields_name])) {
          
            foreach($_POST[ $fields_name] as $key=>$value){
               
                $arr[$key] = $value == '' ? 'on' : $value;  
               
            }

            $this->storage->save_option( $fields_name, $arr);
 
        }

        $options = $this->storage->get_option( $fields_name);
   
        get_template_part(  'inc/letsmake/admin/html/display', 
                            'general', 
                            [
                                'options' => $options,
                                'field_name'=>$fields_name, 
                                'args_display'=>$args_display
                            ]

                        );
    }

    public function display_style()
    {
        $fields_name = $this->theme_options->get_field_name('css');
        $args_display = $this->theme_fields->get_styles_args();

        if ( $fields_name && !empty($_POST[ $fields_name])) {
            $this->storage->save_option( $fields_name, $_POST[$fields_name]);

        }

        $options = $this->storage->get_option( $fields_name);
        get_template_part(  'inc/letsmake/admin/html/display', 
                            'styles', 
                            [
                                'options' => $options,
                                'field_name'=>$fields_name, 
                                'args_display'=>$args_display]
                        );
    }



    public function display_header(){
        echo '<h2>display_header<h2>';
    }

    public function display_footer(){
        echo '<h2>display_footer<h2>';
    }

    public function display_plugins(){
        echo '<h2>display_plugins<h2>';
    }

    public function display_support(){
        echo '<h2>Lets make Support</h2><hr><br>';
        get_template_part('template-admin/content', 'login-footer');

    }

    private function save()
    {

    }

    private function sub_page_items()
    {

    }

}