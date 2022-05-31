<?php
/**
 * Template Name: Contact Template
 */

get_header(); ?>
</div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section class="contact-page inner-page-title" data-aos="fade" data-aos-duration="2000">
  <div class="title-image">
              <img src="<?php the_post_thumbnail_url('full'); ?>" alt="">
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="heading" data-aos="fade-down" data-aos-duration="2000">
            <h1><?php the_title(); ?></h1>
        </div>
      </div>
      <div class="col-lg-7 col-md-12 col-sm-12">
            <div class="text" data-aos="fade-right" data-aos-duration="2000">
                <?php echo do_shortcode( '[contact-form-7 id="34" title="Contact form 1"]' ); ?>
            </div>
      </div>
    </div>
  </div>

</section>
<?php endwhile; wp_reset_query(); ?>


<div class="main-wrapper">
<?php get_footer(); ?>