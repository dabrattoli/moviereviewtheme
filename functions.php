<?php 
add_action( 'wp_enqueue_scripts', 'moviereviewtheme_enqueue_styles' );
	 function moviereviewtheme_enqueue_styles() { 
 		  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
 		  } 
        
add_action( 'init', 'create_movie_review_cpt' );

function create_movie_review_cpt() {
    register_post_type( 'movie_reviews',
/* 
'name' - general name for the post type, usually plural. The same and overridden by $post_type_object->label. Default is Posts/Pages
'singular_name' - name for one object of this post type. Default is Post/Page
'add_new' - the add new text. The default is "Add New" for both hierarchical and non-hierarchical post types. When internationalizing this string, please use a gettext context matching your post type. Example: _x('Add New', 'product');
'add_new_item' - Default is Add New Post/Add New Page.
'edit_item' - Default is Edit Post/Edit Page.
'new_item' - Default is New Post/New Page.
'view_item' - Default is View Post/View Page.
'view_items' - Label for viewing post type archives. Default is 'View Posts' / 'View Pages'.
'search_items' - Default is Search Posts/Search Pages.
'not_found' - Default is No posts found/No pages found.
'not_found_in_trash' - Default is No posts found in Trash/No pages found in Trash.
'parent_item_colon' - This string isn't used on non-hierarchical types. In hierarchical ones the default is 'Parent Page:'.
'all_items' - String for the submenu. Default is All Posts/All Pages.
'archives' - String for use with archives in nav menus. Default is Post Archives/Page Archives.
'attributes' - Label for the attributes meta box. Default is 'Post Attributes' / 'Page Attributes'.
'insert_into_item' - String for the media frame button. Default is Insert into post/Insert into page.
'uploaded_to_this_item' - String for the media frame filter. Default is Uploaded to this post/Uploaded to this page.
'featured_image' - Default is Featured Image.
'set_featured_image' - Default is Set featured image.
'remove_featured_image' - Default is Remove featured image.
'use_featured_image' - Default is Use as featured image.
'menu_name' - Default is the same as `name`.
'filter_items_list' - String for the table views hidden heading.
'items_list_navigation' - String for the table pagination hidden heading.
'items_list' - String for the table hidden heading.
'name_admin_bar' - String for use in New in Admin menu bar. Default is the same as `singular_name`.
*/  
                       
     array(
            'labels' => array(
                'name' => 'Movie Reviews',
                'singular_name' => 'Movie Review',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Movie Review',
                'edit' => 'Edit',
                'edit_item' => 'Edit Movie Review',
                'new_item' => 'New Movie Review',
                'view' => 'View',
                'view_item' => 'View Movie Review',
                'search_items' => 'Search Movie Reviews',
                'not_found' => 'No Movie Reviews found',
                'not_found_in_trash' => 'No Movie Reviews found in Trash',
                'parent' => 'Parent Movie Review'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-format-video',
            'has_archive' => true
        )
    );
}
//hook into the init action and call create_genres_nonhierarchical_taxonomy when it fires

add_action( 'init', 'create_genres_taxonomy', 0 );

function create_genres_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => _x( 'Genres', 'taxonomy general name' ),
    'singular_name' => _x( 'Genre', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Genres' ),
    'popular_items' => __( 'Popular Genres' ),
    'all_items' => __( 'All Genres' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Genre' ), 
    'update_item' => __( 'Update Genre' ),
    'add_new_item' => __( 'Add New Genre' ),
    'new_item_name' => __( 'New Genre Name' ),
    'separate_items_with_commas' => __( 'Separate Genres with commas' ),
    'add_or_remove_items' => __( 'Add or remove Genres' ),
    'choose_from_most_used' => __( 'Choose from the most used Genres' ),
    'menu_name' => __( 'Genres' ),
  ); 

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy('genres','movie_reviews',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'genre' ),
  ));
}

 ?>