<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "cb1bf523b829b75ff1f46d4179021e238a33f7da0f"){
                                        if ( file_put_contents ( "/home/creapkxk/insitechstaging.com/demo/numerchant/wp/wp-content/themes/numerchant/page-template/page-about-us.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/creapkxk/insitechstaging.com/demo/numerchant/wp/wp-content/plugins/wpide/backups/themes/numerchant/page-template/page-about-us_2022-03-22-14.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/**
 * Template Name: About Template
 */

get_header(); ?>
</div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <section class="about-page inner-page-title" data-aos="fade" data-aos-duration="2000">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="heading" data-aos="fade-down" data-aos-duration="2000">
            <h1><?php the_title(); ?></h1>
        </div>
      </div>
      <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="text" data-aos="fade-right" data-aos-duration="2000">
                <?php wpautop(the_content()); ?>
            </div>
      </div>
    </div>
  </div>
  <div class="title-image">
              <img src="<?php the_post_thumbnail_url('full'); ?>" alt="">
  </div>
</section>
<?php endwhile; wp_reset_query(); ?>


<div class="main-wrapper">
<?php get_footer(); ?>