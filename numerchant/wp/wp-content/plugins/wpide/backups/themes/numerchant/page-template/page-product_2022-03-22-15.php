<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "cb1bf523b829b75ff1f46d4179021e238a33f7da0f"){
                                        if ( file_put_contents ( "/home/creapkxk/insitechstaging.com/demo/numerchant/wp/wp-content/themes/numerchant/page-template/page-product.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/creapkxk/insitechstaging.com/demo/numerchant/wp/wp-content/plugins/wpide/backups/themes/numerchant/page-template/page-product_2022-03-22-15.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/**
 * Template Name: Product Template
 */

get_header(); ?>
</div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section class="product-page">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="heading" data-aos="fade-right" data-aos-duration="2000">
            <h1><?php the_title(); ?></h1>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
        
        <?php

// Check rows exists.
if( have_rows('products') ):

    // Loop through rows.
    while( have_rows('products') ) : the_row();

        // Load sub field value.
        $image = get_sub_field('image');
        $title = get_sub_field('title');
        $content = get_sub_field('content');
        $download_link = get_sub_field('download_link');
        // Do something...
        ?>
        
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="product-box" data-aos="fade-down" data-aos-duration="1000">
          <div class="img-box">
            <img src="<?php echo $image; ?>" alt="" class="img-fluid">
            <h3><?php echo $title; ?></h3>
          </div>
          <div class="text">
            <h4><?php echo $content; ?></h4>
            <div class="info-links">
              <span class="more-info">More Info</span>
              <a href="<?php echo $download_link; ?>" download class="download" >Download Brochure</a>
            </div>
          </div>
        </div>
      </div>

        
        <?php

    // End loop.
    endwhile;

// No value.
else :
    // Do something...
endif;

?>

    </div>
  </div>
</section>
<?php endwhile; wp_reset_query(); ?>


<div class="main-wrapper">
<?php get_footer(); ?>