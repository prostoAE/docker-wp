<?php
namespace inc\letsmake\admin;

use inc\letsmake\admin\Letsmake_Plugins_Active;

class Letsmake_Admin
{
    function __construct()
    {   

        add_action( 'login_enqueue_scripts', [$this, 'enqueue_scripts'] );
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_scripts'] );
        add_action( 'admin_notices', [$this, 'dashboard_notice'], 10 );
        add_action( 'login_footer', [$this, 'login_footer_page'] );

        $this->plugins_activate();
        $this->page_setting();

    }

    public function dashboard_notice()
    {
        get_template_part('template-admin/content', 'dashboard');
    }

    public function enqueue_scripts()
    {
        $test = time();
        wp_enqueue_style( 'letsmake-admin-style', get_template_directory_uri() . '/admin/assets/css/style.css', $test ); 
        wp_enqueue_script( "letsmake-admin-js", get_template_directory_uri() . '/admin/assets/js/main.js', array('jquery'), _S_VERSION );
    }

    public function login_footer_page()
    {
        get_template_part('template-admin/content', 'login-footer');

    }

    public function plugins_activate()
    {
       require_once get_template_directory() . '/inc/letsmake/admin/letsmake-plugins_active.php';
    }

    private function page_setting()
    {
        new Letmake_Settings();

    }
}