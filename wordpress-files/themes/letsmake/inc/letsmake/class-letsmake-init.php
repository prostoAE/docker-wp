<?php

namespace inc\letsmake;

use inc\letsmake\admin\Letsmake_Admin;
use inc\letsmake\storage\Letsmake_Storage;
use inc\letsmake\theme\Letsmake_Theme;

/**
 * main class LetsmakeInit
 * 
 */

class LetsmakeInit
{
    public $storage;

    function __construct()
    {
        $this->dependencies();
        add_action('init', [$this, 'run']);
        // $this->storage_init();
        // $this->admin_init();
        // $this->theme_init();
    }

    public function dependencies(){
        require get_template_directory() . '/inc/letsmake/letsmake-log.php';

        // require get_template_directory() . '/inc/letsmake/storage/letsmake-storage.php';

        require_once get_template_directory() . '/inc/letsmake/config/letsmake-fields.php';
        require_once get_template_directory() . '/inc/letsmake/config/letsmake-options.php';

        require get_template_directory() . '/inc/letsmake/admin/letmake-settings.php';
        require get_template_directory() . '/inc/letsmake/admin/letsmake-admin.php';
        require get_template_directory() . '/inc/letsmake/admin/letsmake-plugins_active.php';

        require get_template_directory() . '/inc/letsmake/theme/letsmake-theme.php';
    }

    public function run()
    {   
       

        $this->storage_init();
        $this->admin_init();
        $this->theme_init();
    }

    public function admin_init()
    {
        new Letsmake_Admin();
    }

    public function theme_init()
    {
        new Letsmake_Theme();
    }

    // public function get_options()
    // {
    // }

    public function storage_init()
    {
        require get_template_directory() . '/inc/letsmake/storage/letsmake-storage.php';
        $this->storage = new Letsmake_Storage();
        $this->storage->init();

    }

}

new LetsmakeInit;
