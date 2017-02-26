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
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-format-video',
            'has_archive' => true
        )
    );
}

//This function declares and creates the metabox for the movie reviews custom post type 
add_action( 'admin_init', 'declaration_movie_review_metabox' );
function declaration_movie_review_metabox() {
    add_meta_box( 'movie_review_meta_box',
        'Movie Review Details',
        'display_movie_review_meta_box',
        'movie_reviews', 'normal', 'high'
    );
}
//This is the display function for the movie reviews custom post type metabox
function display_movie_review_meta_box( $movie_review ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $movie_director = esc_html( get_post_meta( $movie_review->ID, 'movie_director', true ) );
    $movie_review_year = esc_html( get_post_meta( $movie_review->ID, 'movie_review_year', true ) );
    $movie_rating = intval( get_post_meta( $movie_review->ID, 'movie_rating', true ) );
    ?>
    <table>
        <tr>
            <td style="width: 100%">Movie Director</td>
            <td><input type="text" size="80" name="movie_review_director_name" value="<?php echo $movie_director; ?>" /></td>
        </tr>
        <tr>
     
        <td><label for="movie_review_year">Year:</label></td>
        <td><input type="text" size="15" name="movie_review_year" value="<?php echo $movie_review_year; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 150px">Movie Rating</td>
            <td>
                <select style="width: 100px" name="movie_review_rating">
                <?php
                // Generate all items of drop-down list
                for ( $rating = 5; $rating >= 1; $rating -- ) {
                ?>
                    <option value="<?php echo $rating; ?>" <?php echo selected( $rating, $movie_rating ); ?>>
                    <?php echo $rating; ?> stars <?php } ?>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

//This is the save function for the movie reviews custom post type metabox data
add_action( 'save_post', 'add_movie_review_fields', 10, 2 );
function add_movie_review_fields( $movie_review_id, $movie_review ) {
    // Check post type for movie reviews
    if ( $movie_review->post_type == 'movie_reviews' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['movie_review_director_name'] ) && $_POST['movie_review_director_name'] != '' ) {
            update_post_meta( $movie_review_id, 'movie_director', $_POST['movie_review_director_name'] );
        }
          if ( isset( $_POST['movie_review_year'] ) && $_POST['movie_review_year'] != '' ) {
            update_post_meta( $movie_review_id, 'year', $_POST['movie_review_year'] );
        }
        
          
        if ( isset( $_POST['movie_review_rating'] ) && $_POST['movie_review_rating'] != '' ) {
            update_post_meta( $movie_review_id, 'movie_rating', $_POST['movie_review_rating'] );
        }
    }
}

?>

?>
