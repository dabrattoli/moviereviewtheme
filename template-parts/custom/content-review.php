<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
        <article id="post-<?php the_ID(); ?>" class="movie-review-listing">
            <header class="entry-header">
                <!-- Display Title and Author Name -->
                <div>
                    <?php the_title('<h1>','</h1>'); ?>
                </div>
             
                <?php
                if ( has_post_thumbnail()){
                ?>    
                <div class="two-column-left">
                <?php the_post_thumbnail( array( 300, 300 ) ); ?>
                </div>
                <div class="two-column-right">
                 <?php
                    $term_list = wp_get_post_categories( $post_id );
               if( count($term_list) != '' || count($term_list) != 0  ){
                echo '<div class="left"><strong>Genre:</strong></div>';
                echo '<div class="right">';
                foreach($term_list as $term_single) {
                 echo '<a href="/genre/'.$term_single->slug.'">'.$term_single->name.'</a>, '; //do something here
                }
                echo '</div>'; 
                 }   
                ?>    
             
               </div>
                <?php
                //end of if
                }else{ 
              
              $term_list = wp_get_post_categories( $post_id );
               if( count($term_list) != '' || count($term_list) != 0  ){
                echo '<div class="left"><strong>Genre:</strong></div>';
                echo '<div class="right">';
                foreach($term_list as $term_single) {
                 echo '<a href="/genre/'.$term_single->slug.'">'.$term_single->name.'</a>, '; //do something here
                }
                echo '</div>'; 
                 }    

                ?>
              
                
                <?php    
                }
                ?>
                
            </header>
 
            <!-- Display movie review contents -->
            <div class="entry-content"><?php the_content(); ?></div>

        </article>

