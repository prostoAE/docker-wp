<?php
/**
 * 
 * custom post type
 */
if(!function_exists('letsmake_register_post_types') ){
	add_action( 'init', 'letsmake_register_post_types' );
	function letsmake_register_post_types(){
     
		/**
		 * post_type podcasts
		 */

		register_post_type( 'sections-build', [
			'label'  => null,
			'labels' => [
				'name'               => __('Sections build','letsmake'), // основное название для типа записи
				'singular_name'      => __('Section tamplate','letsmake'), // название для одной записи этого типа
				'add_new'            => __('Add','letsmake'), // для добавления новой записи
				'add_new_item'       => 'Add new ____', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Edit ____', // для редактирования типа записи
				'new_item'           => __('New','letsmake'), // текст новой записи
				'view_item'          => __('View','letsmake'), // для просмотра записи этого типа.
				'search_items'       => __('Search','letsmake'), // для поиска по этим типам записи
				'not_found'          => __('not found','letsmake'), // если в результате поиска ничего не было найдено
				'not_found_in_trash' => __('not found in trash','letsmake'), // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => __('Sections','letsmake'), // название меню
			],
			'description'         => '',
			'public'              => true,
			'publicly_queryable'  => true, // зависит от public
			'exclude_from_search' => false, // зависит от public
			'show_ui'             => true, // зависит от public
			'show_in_nav_menus'   => true, // зависит от public
			'show_in_menu'        => null, // показывать ли в меню адмнки
			'show_in_admin_bar'   => null, // зависит от show_in_menu
			'show_in_rest'        => true, // добавить в REST API. C WP 4.7
			'rest_base'           => null, // $post_type. C WP 4.7
			'menu_position'       => null,
			'menu_icon'           => 'dashicons-editor-code',
			//'capability_type'   => 'post',
			//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
			//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
			'hierarchical'        => false,
			'supports'            => [ 'title', 'editor', 'custom-fields','revisions','post-formats'],
			// 'taxonomies'          => null,
			'has_archive'         => false,
			'rewrite'             => true,
			'query_var'           => true,
		] );

		register_post_type( 'header-build', [
			'label'  => null,
			'labels' => [
				'name'               => __('Header build','letsmake'), // основное название для типа записи
				'singular_name'      => __('Header tamplate','letsmake'), // название для одной записи этого типа
				'add_new'            => __('Add','letsmake'), // для добавления новой записи
				'add_new_item'       => 'Add new ____', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Edit ____', // для редактирования типа записи
				'new_item'           => __('New','letsmake'), // текст новой записи
				'view_item'          => __('View','letsmake'), // для просмотра записи этого типа.
				'search_items'       => __('Search','letsmake'), // для поиска по этим типам записи
				'not_found'          => __('not found','letsmake'), // если в результате поиска ничего не было найдено
				'not_found_in_trash' => __('not found in trash','letsmake'), // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => __('Header','letsmake'), // название меню
			],
			'description'         => '',
			'public'              => true,
			'publicly_queryable'  => true, // зависит от public
			'exclude_from_search' => false, // зависит от public
			'show_ui'             => true, // зависит от public
			'show_in_nav_menus'   => true, // зависит от public
			'show_in_menu'        => null, // показывать ли в меню адмнки
			'show_in_admin_bar'   => null, // зависит от show_in_menu
			'show_in_rest'        => true, // добавить в REST API. C WP 4.7
			'rest_base'           => null, // $post_type. C WP 4.7
			'menu_position'       => null,
			'menu_icon'           => 'dashicons-editor-code',
			//'capability_type'   => 'post',
			//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
			//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
			'hierarchical'        => false,
			'supports'            => [ 'title', 'editor', 'custom-fields','revisions','post-formats'],
			// 'taxonomies'          => null,
			'has_archive'         => false,
			'rewrite'             => true,
			'query_var'           => true,
		] );

		register_post_type( 'footer-build', [
			'label'  => null,
			'labels' => [
				'name'               => __('Footer build','letsmake'), // основное название для типа записи
				'singular_name'      => __('Footer tamplate','letsmake'), // название для одной записи этого типа
				'add_new'            => __('Add','letsmake'), // для добавления новой записи
				'add_new_item'       => 'Add new ____', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Edit ____', // для редактирования типа записи
				'new_item'           => __('New','letsmake'), // текст новой записи
				'view_item'          => __('View','letsmake'), // для просмотра записи этого типа.
				'search_items'       => __('Search','letsmake'), // для поиска по этим типам записи
				'not_found'          => __('not found','letsmake'), // если в результате поиска ничего не было найдено
				'not_found_in_trash' => __('not found in trash','letsmake'), // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => __('Footer','letsmake'), // название меню
			],
			'description'         => '',
			'public'              => true,
			'publicly_queryable'  => true, // зависит от public
			'exclude_from_search' => false, // зависит от public
			'show_ui'             => true, // зависит от public
			'show_in_nav_menus'   => true, // зависит от public
			'show_in_menu'        => null, // показывать ли в меню адмнки
			'show_in_admin_bar'   => null, // зависит от show_in_menu
			'show_in_rest'        => true, // добавить в REST API. C WP 4.7
			'rest_base'           => null, // $post_type. C WP 4.7
			'menu_position'       => null,
			'menu_icon'           => 'dashicons-editor-code',
			//'capability_type'   => 'post',
			//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
			//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
			'hierarchical'        => false,
			'supports'            => [ 'title', 'editor', 'custom-fields','revisions','post-formats'],
			// 'taxonomies'          => null,
			'has_archive'         => false,
			'rewrite'             => true,
			'query_var'           => true,
		] );

    }

}
