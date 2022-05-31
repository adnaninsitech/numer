<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "cb1bf523b829b75ff1f46d4179021e238a33f7da0f"){
                                        if ( file_put_contents ( "/home/creapkxk/insitechstaging.com/demo/numerchant/wp/wp-content/themes/numerchant/page-template/page-home.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/creapkxk/insitechstaging.com/demo/numerchant/wp/wp-content/plugins/wpide/backups/themes/numerchant/page-template/page-home_2022-03-22-15.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/**
 * Template Name: Home Template
 */

get_header(); ?>
</div>



 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
 
<div class="side-image">
    
    
<?php

// Check rows exists.
if( have_rows('home_page_content') ):

    // Loop through rows.
   $i=0; $x=1; while( have_rows('home_page_content') ) : the_row();

        // Load sub field value.
        $image = get_sub_field('image');
        $title = get_sub_field('title');
        $description = get_sub_field('description');
        // Do something...
         if ($i % 2 == 0) { ?>
  
  <section class="home-sec1 box-layout">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-7">
              <div class="text">
              
                <h2 data-aos="fade-right" data-aos-duration="1000"><?php echo $title; ?></h2>
                <?php echo $description; ?>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="img-box" data-aos="fade-down" data-aos-duration="2000">
                <img
                  src="<?php echo $image; ?>"
                  alt=""
                  class="img-fluid"
                />
              </div>
            </div>
          </div>
        </div>
      </section>
  
  <?php } else { ?>
  
     <section class="box-layout">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-5">
              <div class="img-box" data-aos="fade-right" data-aos-duration="2000">
                <img
                  src="<?php echo $image; ?>"
                  alt=""
                  class="img-fluid"
                />
              </div>
            </div>
            <div class="col-lg-7">
              <div class="text p-left">
                <h2 data-aos="fade-down" data-aos-duration="1000"><?php echo $title; ?></h2>
                <?php echo $description; ?>
              </div>
            </div>
          </div>
        </div>
      </section>
   <?php } 

    // End loop.
   $i++; $x++; endwhile;

// No value.
else :
    // Do something...
endif;
?>
     

   
    </div>


   <?php endwhile; wp_reset_query(); ?>

<div class="footer-padding">
    </div>
<div class="main-wrapper">
<?php get_footer(); ?>