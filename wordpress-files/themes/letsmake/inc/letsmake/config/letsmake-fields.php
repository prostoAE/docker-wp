<?php
namespace inc\letsmake\config;

class Letsmake_Fields
{
    public function get_styles_args()
    {
        $args = apply_filters(
            'letsmake_args_settings_style',
            [
                [
                    'html' => 'input',
                    'type' => 'color',
                    'name' => 'color-primary',
                    'css-root' =>'--letsmake--color-primary',
                    'title' => esc_html__('Primery color', 'letsmake'),
                    'description' => 'css root: <code>var(--letsmake--color-primary);</code><br> css class: <code>text-color--primary, bg-color--primary</code>',
                    'class' => 'box-50',
                    'default' => '#262626',
                    'show'  => ''
                ],
                [
                    'html' => 'input',
                    'type' => 'color',
                    'name' => 'color-secondary',
                    'css-root' =>'--letsmake--color-secondary',
                    'title' => esc_html__('Secondary color', 'letsmake'),
                    'description' => 'css root: <code>var(--letsmake--color-secondary);</code><br> css class: <code>text-color--secondary, bg-color--secondary</code>',
                    'class' => 'box-50',
                    'default' => '#262626',
                    'show'  => ''
                ],
                [
                    'html' => 'input',
                    'type' => 'color',
                    'name' => 'color-tertiary',
                    'css-root' =>'--letsmake--color-tertiary',
                    'title' => esc_html__('Tertiary color', 'letsmake'),
                    'description' => 'css root: <code>var(--letsmake--color-tertiary);</code><br> css class: <code>text-color--tertiary, bg-color--tertiary</code>',
                    'class' => 'box-50',
                    'default' => '#262626',
                    'show'  => ''
                ],
                [
                    'html' => 'input',
                    'type' => 'color',
                    'name' => 'color-fourth',
                    'css-root' =>'--letsmake--color-fourth',
                    'title' => esc_html__('Fourth color', 'letsmake'),
                    'description' => 'css root: <code>var(--letsmake--color-fourth);</code><br> css class: <code>text-color--fourth, bg-color--fourth</code>',
                    'class' => 'box-50',
                    'default' => '#262626',
                    'show'  => ''
                ],
                [
                    'html' => 'input',
                    'type' => 'color',
                    'name' => 'color-text',
                    'css-root' =>'--letsmake--body-color',
                    'title' => esc_html__('Text color', 'letsmake'),
                    'description' => '',
                    'class' => 'box-50',
                    'default' => '#262626',
                    'show'  => ''
                ],
                [
                    'html' => 'input',
                    'type' => 'color',
                    'name' => 'color-body',
                    'css-root' =>'--letsmake--body-background-color',
                    'title' => esc_html__('Background color body', 'letsmake'),
                    'description' => '',
                    'class' => 'box-50',
                    'default' => '#ffffff',
                    'show'  => ''
                ],
                [
                    'html' => 'input',
                    'type' => 'color',
                    'name' => 'color-theme_light',
                    'title' => esc_html__('Light theme color', 'letsmake'),
                    'description' => 'The theme-color value (light)',
                    'class' => 'box-50',
                    'default' => '#ffffff',
                    'show'  => ''
                ],
                [
                    'html' => 'input',
                    'type' => 'color',
                    'name' => 'color-theme_dark',
                    'title' => esc_html__('Dark theme color', 'letsmake'),
                    'description' => 'The theme-color value (dark)',
                    'class' => 'box-50',
                    'default' => '#ffffff',
                    'show'  => ''
                ],
                [
                    'html' => 'input',
                    'type' => 'number',
                    'name' => 'content-width',
                    'css-root' =>'--letsmake--content-width',
                    'title' => esc_html__('Max width', 'letsmake'),
                    'description' => 'Max width content body (px);<br> css class <code>.container</code> <br>css root: <code>var(--letsmake--content-width);</code>',
                    'class' => 'box-50',
                    'default' => '1200',
                    'show'  => ''
                ],
            ]
        );

        return $args;
    }

    public function get_general_args()
    {
        $args = apply_filters(
            'letsmake_args_settings_general',
            [
                [
                    'html' => 'input',
                    'type' => 'checkbox',
                    'name' => 'general-sidebar',
                    'title' => esc_html__('Active sidebar', 'letsmake'),
                    'description' => esc_html__('Active sidebar id = sidebar-1', 'letsmake'),
                    'class' => 'box-50 lts-checkbox',
                    'default' => '',
                ],
                // [
                //     'html' => 'input',
                //     'type' => 'checkbox',
                //     'name' => 'general-woocommerce',
                //     'title' => esc_html__('Active woocommerce', 'letsmake'),
                //     'description' => esc_html__('Active woocommerce', 'letsmake'),
                //     'class' => 'box-50 lts-checkbox',
                //     'default' => '',
                // ],
                [
                    'html' => 'select',
                    'type' => '',
                    'post-type'=>'sections-build',
                    'name' => 'general-404',
                    'title' => esc_html__('Select 404 page', 'letsmake'),
                    'description' => esc_html__('Select 404 page for your site (sections post type)', 'letsmake'),
                    'class' => 'box-50',
                    'default' => '',
                ],
                [
                    'html' => 'select',
                    'type' => '',
                    'post-type'=>'header-build',
                    'name' => 'general-header',
                    'title' => esc_html__('Select header', 'letsmake'),
                    'description' => esc_html__('Select default header for your site', 'letsmake'),
                    'class' => 'box-50',
                    'default' => '',
                ],
                [
                    'html' => 'select',
                    'type' => '',
                    'post-type'=>'footer-build',
                    'name' => 'general-footer',
                    'title' => esc_html__('Select footer', 'letsmake'),
                    'description' => esc_html__('Select default footer for your site', 'letsmake'),
                    'class' => 'box-50',
                    'default' => '',
                ],
            ]
        );
        return $args;

    }
}
