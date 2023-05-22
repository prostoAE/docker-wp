<?php
/**
 * 
 * custom post type
 */
if(!function_exists('letsmake_child_register_post_types') ){
	add_action( 'init', 'letsmake_child_register_post_types' );
	function letsmake_child_register_post_types(){
     
		register_taxonomy( 'category-cases', [ 'cases' ], [
            'label'                 =>  __('Category Сases','child-letsmake'),
            'labels'                => [
                'name'              =>  __('Categories','child-letsmake'),
                'singular_name'     =>  __('Categories','child-letsmake'),
                'search_items'      =>  __('Search Category','child-letsmake'),
                'all_items'         => __('All Category','child-letsmake'),
                'view_item '        => __('View','child-letsmake'),
                'parent_item'       => 'Parent Genre',
                'parent_item_colon' => 'Parent Genre:',
                'edit_item'         => __('Edit','child-letsmake'),
                'update_item'       => __('Update','child-letsmake'),
                'add_new_item'      => __('Add new','child-letsmake'),
                'new_item_name'     => __('New item name','child-letsmake'),
                'menu_name'         => __('Categories','child-letsmake'),
                'back_to_items'     => '← back',
            ],
            'description'           => '', // описание таксономии
            'public'                => true,
            'publicly_queryable'    => true, // равен аргументу public
            'show_in_nav_menus'     => true, // равен аргументу public
            'show_ui'               => true, // равен аргументу public
            'show_in_menu'          => true, // равен аргументу show_ui
            'show_tagcloud'         => true, // равен аргументу show_ui
            // 'show_in_quick_edit'    => null, // равен аргументу show_ui
            'hierarchical'          => true,
            'rewrite'               => array(
										'slug' => 'category-cases',
										'with_front' => false,
										'hierarchical' => true,
										'ep_mask' => EP_NONE,
									),
            'query_var'             => true, // название параметра запроса
            'capabilities'          => array(),
            //'meta_box_cb'           => 'post_categories_meta_box', // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
            'show_admin_column'     => true, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
            'show_in_rest'          => true, // добавить в REST API
            'rest_base'             => null, // $taxonomy
             '_builtin'              => false,
            //'update_count_callback' => '_update_post_term_count',
        ] );


		/**
		 * post_type podcasts
		 */

		register_post_type( 'cases', [
			'label'  => null,
			'labels' => [
				'name'               => __('Cases','letsmake'), // основное название для типа записи
				'singular_name'      => __('Case tamplate','letsmake'), // название для одной записи этого типа
				'add_new'            => __('Add','letsmake'), // для добавления новой записи
				'add_new_item'       => 'Add new ____', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Edit ____', // для редактирования типа записи
				'new_item'           => __('New','letsmake'), // текст новой записи
				'view_item'          => __('View','letsmake'), // для просмотра записи этого типа.
				'search_items'       => __('Search','letsmake'), // для поиска по этим типам записи
				'not_found'          => __('not found','letsmake'), // если в результате поиска ничего не было найдено
				'not_found_in_trash' => __('not found in trash','letsmake'), // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => __('Cases','letsmake'), // название меню
			],
			'description'         => '',
			'public'              => true,
			'publicly_queryable'  => true, // зависит от public
			'exclude_from_search' => true, // зависит от public
			'show_ui'             => true, // зависит от public
			'show_in_nav_menus'   => true, // зависит от public
			'show_in_menu'        => true, // показывать ли в меню адмнки
			'show_in_admin_bar'   => null, // зависит от show_in_menu
			'show_in_rest'        => true, // добавить в REST API. C WP 4.7
			'rest_base'           => null, // $post_type. C WP 4.7
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-portfolio',
			'taxonomies'          => ['category-cases'],
			//'capability_type'   => 'post',
			//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
			//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
			'hierarchical'        => false,
			'supports'            => [ 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'],
			'has_archive'         => true,
			'rewrite'             => true,
			'query_var'           => true,
		] );

    }

}
