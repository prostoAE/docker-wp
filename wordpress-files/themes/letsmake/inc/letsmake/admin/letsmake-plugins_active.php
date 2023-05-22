<?php

namespace inc\letsmake\admin;
/**
 * check for installed plugins
 */
class Letsmake_Plugins_Active{
   static protected $pluginListRequired = [
                [    
                    'path' => 'wordpress-seo/wp-seo.php', 
                    'name' => 'Yoast SEO',
                    'link' => 'wordpress-seo'
                ],
                [    
                    'path' => 'duplicate-post/duplicate-post.php', 
                    'name' => 'Yoast Duplicate Post ',
                    'link' => 'duplicate-post'
                ],
                [
                    'path' => 'cyr2lat/cyr-to-lat.php',
                    'name' => 'Cyr-To-Lat',
                    'link' => 'cyr2lat'
                ],
            ];
    static protected $pluginListRecomendate = [
                [    
                    'path' => 'contact-form-7/wp-contact-form-7.php', 
                    'name' => 'Contact form 7 (CF7)',
                    'link' => 'contact-form-7'
                ],
                [    
                    'path' => 'svg-support/svg-support.php', 
                    'name' => 'SVG Support',
                    'link' => 'svg-support'
                ],
                [    
                    'path' => 'classic-editor/classic-editor.php', 
                    'name' => 'Classic Editor',
                    'link' => 'classic-editor'
                ],
                [    
                    'path' => 'advanced-custom-fields-pro/acf.php', 
                    'name' => 'ACF PRO',
                ],
                [
                    'path' => 'luckywp-acf-menu-field/luckywp-acf-menu-field.php',
                    'name' => 'LuckyWP ACF Menu Field',
                    'link' => 'luckywp-acf-menu-field'
                ],
            ];
   static private function getPluginActive($pluginList){
        $str = '';
        $r = $pluginList;
        foreach ($r as $item){
            $install_link = $item['name'];
            if( !empty($item['link']) ){
                $plugin_name = $item['link'];
                $install_link = '<a href="' . esc_url( network_admin_url('plugin-install.php?tab=plugin-information&plugin=' . $plugin_name . '&TB_iframe=true&width=600&height=550' ) ) . '" class="thickbox" title="More info about ' . $item['name'] . '">Install ' . $item['name'] . '</a>';
            }
            if (!is_plugin_active($item['path'])){
                $str .= '<p>'. __( "Plugin not installed or not activated.", "letsmake" ) . ' <b>' . $install_link .'<b></p>';
            }
        }
        return $str;
    }
    static public function notice_error(){
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        add_action( 'admin_notices', function() {
            $str_error = self::getPluginActive(self::$pluginListRequired);
            if($str_error != '') {
                ?>
                <div class="notice notice-error is-dismissible">
                    <?php echo $str_error;?>
                    <a href="/wp-admin/plugins.php" target="_blank"><?php _e('go to the plugins page','letsmake');?> -></a>
                </div>
                <?php
            }
            $str_warning = self::getPluginActive(self::$pluginListRecomendate);
            if($str_warning != '') {
                ?>
                <div class="notice notice-warning is-dismissible">
                    <?php echo $str_warning;?>
                    <a href="/wp-admin/plugins.php" target="_blank"><?php _e('go to the plugins page','letsmake');?> -></a>
                </div>
                <?php
            }
        }, 35 );
    }
}
Letsmake_Plugins_Active::notice_error();

