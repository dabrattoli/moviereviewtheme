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
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
                $term_list = wp_get_post_terms($post->ID, 'genres', array("fields" => "all"));
                foreach($term_list as $term_single) {
                echo '<div class="left"><strong>Genre:</strong></div><div class="right"> <a href="/genre/'.$term_single->slug.'">'.$term_single->name.'</a></div>'; //do something here
                }
                ?>    
                <?php
                if( esc_html( get_post_meta( get_the_ID(), 'movie_director', true ) ) != '' ){
                ?>
                <div class="left">
                <strong>Director: </strong>
                </div>
                <div class="right">
                <?php echo esc_html( get_post_meta( get_the_ID(), 'movie_director', true ) ); ?>
                </div>
                <?php
                }
                ?>
                <?php
                if( esc_html( get_post_meta( get_the_ID(), 'year', true ) ) != '' ){
                ?>
                <div class="left">
                <strong>Year: </strong>
                </div>
                <div class="right">
                <?php echo esc_html( get_post_meta( get_the_ID(), 'year', true ) ); ?>
                </div>
                <?php
                }
                ?>
                <!-- Display yellow stars based on rating -->
                <div class="left">
                <strong>Rating: </strong>
                </div>
                <div class="right">
                 <?php echo esc_html( get_post_meta( get_the_ID(), 'movie_rating', true ) ); ?>
                </div>
                <div class="left">
                <strong>Score: </strong>
                </div>
                <div class="right">
                <?php
                $nb_stars = intval( get_post_meta( get_the_ID(), 'movie_score', true ) );
                for ( $star_counter = 1; $star_counter <= 5; $star_counter++ ) {
                    if ( $star_counter <= $nb_stars ) {
                        
                        echo '<img src="' .get_stylesheet_directory_uri().'/images/star.png" />';
                    } else {
                        echo '<img src="' .get_stylesheet_directory_uri().'/images/grey.png" />';
                    }
                }
                ?>
                </div>
               </div>
                <?php
                //end of if
                }else{ 
                
                $term_list = wp_get_post_terms($post->ID, 'genres', array("fields" => "all"));
                foreach($term_list as $term_single) {
                echo '<div class="left"><strong>Genre:</strong></div><div class="right"> <a href="/genre/'.$term_single->slug.'">'.$term_single->name.'</a></div>'; //do something here
                }    
                    
                   if( esc_html( get_post_meta( get_the_ID(), 'movie_director', true ) ) != '' ){
                ?>
                <div class="left">
                <strong>Director: </strong>
                </div>
                <div class="right">
                <?php echo esc_html( get_post_meta( get_the_ID(), 'movie_director', true ) ); ?>
                </div>
                <?php
                }
                ?>
                <?php
                if( esc_html( get_post_meta( get_the_ID(), 'year', true ) ) != '' ){
                ?>
                <div class="left">
                <strong>Year: </strong>
                </div>
                <div class="right">
                <?php echo esc_html( get_post_meta( get_the_ID(), 'year', true ) ); ?>
                </div>
                <?php
                }
                ?>
                <!-- Display yellow stars based on rating -->
                <div class="left">
                <strong>Rating: </strong>
                </div>
                <div class="right">
                 <?php echo esc_html( get_post_meta( get_the_ID(), 'movie_rating', true ) ); ?>
                </div>
                <div class="left">
                <strong>Review Score: </strong>
                </div>
                <div class="right">
                <?php
                $nb_stars = intval( get_post_meta( get_the_ID(), 'movie_score', true ) );
                for ( $star_counter = 1; $star_counter <= 5; $star_counter++ ) {
                    if ( $star_counter <= $nb_stars ) {
                        
                        echo '<img src="' .get_stylesheet_directory_uri().'/images/star.png" />';
                    } else {
                        echo '<img src="' .get_stylesheet_directory_uri().'/images/grey.png" />';
                    }
                }
                ?>
                </div>
                
                <?php    
                }
                ?>
                
            </header>
 
            <!-- Display movie review contents -->
            <div class="entry-content"><?php the_content(); ?></div>
        </article>
