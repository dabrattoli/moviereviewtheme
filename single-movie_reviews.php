<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<?php
    $mypost = array( 'post_type' => 'movie_reviews', );
    $loop = new WP_Query( $mypost );
    ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post();?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
 
                <!-- Display featured image in right-aligned floating div -->
                <div style="float: right; margin: 10px">
                    <?php the_post_thumbnail( array( 100, 100 ) ); ?>
                </div>
 
                <!-- Display Title and Author Name -->
                <div>
                    <?php the_title('<h1>','</h1>'); ?><br />
                </div>
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
                <?php
                $nb_stars = intval( get_post_meta( get_the_ID(), 'movie_rating', true ) );
                for ( $star_counter = 1; $star_counter <= 5; $star_counter++ ) {
                    if ( $star_counter <= $nb_stars ) {
                        
                        echo '<img src="' .get_stylesheet_directory_uri().'/images/star.png" />';
                    } else {
                        echo '<img src="' .get_stylesheet_directory_uri().'/images/grey.png" />';
                    }
                }
                ?>
                </div>
            </header>
 
            <!-- Display movie review contents -->
            <div class="entry-content"><?php the_content(); ?></div>
        </article>
 
    <?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
