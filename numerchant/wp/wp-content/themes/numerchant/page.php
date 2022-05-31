<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
		
    </div>

<div class="content">
<div class="wrapper">
<div class="row">
  <div class="col-12 center-content">
  
  		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <h1><?php echo get_post_meta(get_the_ID(), 'wpcf-sub-title', true); ?></h1>
            <h2><?php the_title(); ?></h2>  
            <?php the_content(); ?>
        <?php endwhile; wp_reset_query(); ?>
    
    </div>
    </div>



</div>
</div>





<div class="wrapper">
    
    
<?php get_footer();  ?>