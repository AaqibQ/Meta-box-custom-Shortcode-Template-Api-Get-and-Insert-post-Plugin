<?php
class DisplayCustomPosts {
	public function __construct() {
			add_action('init', array($this, 'display_custom_post_news'));
            add_action('init', array($this, 'display_custom_post_breweres'));
            add_action( 'update_brewery_list', array($this, 'get_breweries_from_api'));
            // add_action( 'wp_ajax_nopriv_get_breweries_from_api', array($this, 'get_breweries_from_api'));
            // add_action( 'wp_ajax_get_breweries_from_api', array($this, 'get_breweries_from_api'));
            add_filter( 'template_include', array($this,'portfolio_page_template'));
            // add_filter( 'template_include', array($this,'breweres_page_template'));
            // add_filter( 'register_taxonomy_args', array($this, 'add_taxonomy '));
		
			// add_action('admin_menu', array($this, 'add_custom_admin_settings_dbp'));
	}
	// function add_custom_admin_settings_dbp() {
	// 	add_menu_page('Blog Posts', 'Blog Posts', 'manage_options', 'blog-posts-settings', array($this, 'add_custom_admin_settings_dbp_content'),'dashicons-admin-settings', 7);
	// }


function display_custom_post_news() {

        register_post_type('news' , array (
                'label' => 'Global News' , 
                'labels' => array(
                    'name'                     => _x( 'News', 'News post type general name' ),
                    'singular_name'            => _x( 'News', 'News post type singular name' ),
                    'add_new'                  => _x( 'Add News', 'Add New News Post' ),
                    'add_new_item'             => __( 'Add New News Post' ),
                    'new_item'                 => __( 'New News' ),
                    'edit_item'                => __( 'Edit News' ),
                    'view_item'                => __( 'View News' ),
                    'all_items'                => __( 'All Newss' ),
                    'search_items'             => __( 'Search Newss' ),
                    'not_found'                => __( 'No Newss found.' ),
                    'not_found_in_trash'       => __( 'No Newss found in Trash.' ),
                    'filter_items_list'        => __( 'Filter Newss list' ),
                    'items_list_navigation'    => __( 'Newss list navigation' ),
                    'items_list'               => __( 'Newss list' ),
                    'item_published'           => __( 'News published.' ),
                    'item_published_privately' => __( 'News published privately.' ),
                    'item_reverted_to_draft'   => __( 'News reverted to draft.' ),
                    'item_scheduled'           => __( 'News scheduled.' ),
                    'item_updated'             => __( 'News updated.' ),
                    'featured_image'           => __( 'News Featured image' ),
                ) ,
                'public' => true , 
                'Description' => 'This Custom Post is used only for News',
                'supports' => ['title' , 'editor' , 'comments' , 'custom-fields' , 'thumbnail' ]

        ));

        register_taxonomy('news_category', ['news'], array (
            'hierarchical' => true,
            'public'       => true,
            'labels'       => array (
                'name'                       => __( 'News Categories' ),
                'singular_name'              => __( 'New Category' ),
                'search_items'               => __( 'Search News Categories' ),
                'popular_items'              => null,
                'all_items'                  => __( 'All New Categories' ),
                'edit_item'                  => __( 'Edit News Category' ),
                'update_item'                => __( 'Update News Category' ),
                'add_new_item'               => __( 'Add New News Category' ),
                'new_item_name'              => __( 'New News Category Name' ),
                'separate_items_with_commas' => null,
                'add_or_remove_items'        => null,
                'choose_from_most_used'      => null,
                'back_to_items'              => __( '&larr; Go to News Categories' ),

            ),
            
        ));
       

}

// add template filter 

function portfolio_page_template( $template ) {
    global $post;
    if (is_single() AND $post->post_type == 'news'){
        // print_r($template);
        // exit;
        $template = CUSTOMPOST_PLUGIN_DIR. 'templates/single-news.php';
    }
    
    return $template;
}


// API INTEGRATION WITH POST TYPE 


function display_custom_post_breweres() {

    register_post_type('brewery' , array (
            'label' => 'Global brewery' , 
            'labels' => array(
                'name'                     => _x( 'brewery', 'brewery post type general name' ),
                'singular_name'            => _x( 'brewery', 'brewery post type singular name' ),
                'add_new'                  => _x( 'Add brewery', 'Add New brewery Post' ),
                'add_new_item'             => __( 'Add New brewery Post' ),
                'new_item'                 => __( 'New brewery' ),
                'edit_item'                => __( 'Edit brewery' ),
                'view_item'                => __( 'View brewery' ),
                'all_items'                => __( 'All brewerys' ),
                'search_items'             => __( 'Search brewerys' ),
                'not_found'                => __( 'No brewerys found.' ),
                'not_found_in_trash'       => __( 'No brewerys found in Trash.' ),
                'filter_items_list'        => __( 'Filter brewerys list' ),
                'items_list_navigation'    => __( 'brewerys list navigation' ),
                'items_list'               => __( 'brewerys list' ),
                'item_published'           => __( 'brewery published.' ),
                'item_published_privately' => __( 'brewery published privately.' ),
                'item_reverted_to_draft'   => __( 'brewery reverted to draft.' ),
                'item_scheduled'           => __( 'brewery scheduled.' ),
                'item_updated'             => __( 'brewery updated.' ),
                'featured_image'           => __( 'brewery Featured image' ),
            ) ,
            'public' => true , 
            'Description' => 'This Custom Post is used only for brewery',
            'supports' => ['title' , 'editor' , 'comments' , 'custom-fields' , 'thumbnail' ]

    ));
   

}



}

new DisplayCustomPosts();