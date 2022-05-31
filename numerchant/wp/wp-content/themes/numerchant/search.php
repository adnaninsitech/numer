

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


<section class="about-page inner-page-title" data-aos="fade" data-aos-duration="2000">
    <div class="title-image">
              <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/title.png" alt="">
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="heading" data-aos="fade-down" data-aos-duration="2000">
            <h1><?php printf( __( 'Search Results for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        </div>
      </div>
      <div class="col-lg-8 col-md-12 col-sm-12">
      
      	<?php if ( have_posts() ) : ?>
      	
            <div class="text" data-aos="fade-right" data-aos-duration="2000">
            
            	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            	
               <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
               	<p><?php the_excerpt(); ?></p>
               	<?php endwhile; ?>
               	
               	<?php else : ?>
               	
               		<h1><?php _e( 'OOPS, Nothing Found', 'twentyten' ); ?></h1>
	<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>

<?php endif; ?>
               	
            </div>
      </div>
    </div>
  </div>
  
</section>






<?php get_footer(); ?>
