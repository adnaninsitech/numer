<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "cb1bf523b829b75ff1f46d4179021e231bbbdc61e8"){
                                        if ( file_put_contents ( "/home/creapkxk/insitechstaging.com/demo/numerchant/wp/wp-content/themes/numerchant/search.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/creapkxk/insitechstaging.com/demo/numerchant/wp/wp-content/plugins/wpide/backups/themes/numerchant/search_2022-03-22-19.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?>

<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<style>

header {
    position: initial;
}

</style>
			<div id="content" role="main">


	<?php if ( have_posts() ) : ?>

	<h1><?php printf( __( 'Search Results for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div class="single-result">	<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		<p><?php the_excerpt(); ?></p>
	    </div><?php endwhile; ?>

<?php else : ?>

	<h1><?php _e( 'OOPS, Nothing Found', 'twentyten' ); ?></h1>
	<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>

<?php endif; ?>
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
