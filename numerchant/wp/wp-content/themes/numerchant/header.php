<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *

 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>


<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

  <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
  <link href="<?php bloginfo('template_directory'); ?>/images/favicon.png" rel="shortcut icon" type="image/x-icon" />
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  
      <link
      rel="icon"
      href="<?php bloginfo('template_directory'); ?>/assets/images/favicon.png"
      type="favicon.png"
      sizes="32x32"
    />
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/aos-animate.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/lib.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/style.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/responsive.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" />


  <!-- Google Fonts -->

    <link   href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"  rel="stylesheet" />
    <link   href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap"   rel="stylesheet" />
    <link   rel="stylesheet"    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"  />
    <link   href="https://db.onlinewebfonts.com/c/ca299f411a9611978dd6ad055a856c8f?family=Co+Headline+Corp"   rel="stylesheet"   type="text/css"  />




  <?php
  /* We add some JavaScript to pages with the comment form
   * to support sites with threaded comments (when in use).
   */
  if ( is_singular() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );
  global $options;global $logo;global $copyrite;
  $options = get_option('cOptn');
  $logo = $options['logo'];
  $copyrite = $options['copyrite'];
  $size = 300;
  $options['logo'] = wp_get_attachment_image($logo, array($size, $size), false);
  $att_img = wp_get_attachment_image($logo, array($size, $size), false); 
  $logoSrc = wp_get_attachment_url($logo);
  $att_src_thumb = wp_get_attachment_image_src($logo, array($size, $size), false);

  /* Always have wp_head() just before the closing </head>
   * tag of your theme, or you will break many plugins, which
   * generally use this hook to add elements to <head> such
   * as styles, scripts, and meta tags.
   */
  wp_head();
  
  
  global $more;
  $more = 0;
  ?>
</head>

<body <?php body_class( $class ); ?>> 

    <header>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <nav class="navbar navbar-expand-lg">
              <a class="navbar-brand" href="<?php echo site_url(); ?>"
                ><?php echo $options['logo']  ?></a>
              <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
              </button>
              <div
                class="collapse navbar-collapse justify-content-end"
                id="navbarNav"
              >
                  
                  <?php wp_nav_menu(array('menu'=>'Menu 1' , 'menu_class'=>'navbar-nav' ,   'container' => 'ul',)); ?> 

              </div>
            </nav>
          </div>
        </div>
      </div>
    </header>

<?php if(Is_home()|| is_front_page() ) { ?>

<?php $index_query = new WP_Query(array( 'post_type' => 'page' , 'page_id' => '12')); ?>

<?php while ($index_query->have_posts()) : $index_query->the_post(); ?>

    <section class="home-banner" data-aos="fade" data-aos-duration="2000">
        <div class="text-right">
                <img src="https://insitechstaging.com/demo/numerchant/wp/wp-content/uploads/2022/03/home-title-image.png" class="img-fluid home-title-img">
            </div>
      <div class="container">
      
      
        <div class="row align-items-center">
          <div class="col-lg-6 h-100">
            <div class="text h-100">
            
              <h1 data-aos="fade-right" data-aos-duration="1000">
                <?php echo the_field('banner_heading', get_the_ID()); ?>
              </h1>
              <p data-aos="fade-right" data-aos-duration="2000">
                <?php echo the_field('banner_content', get_the_ID()); ?>
              </p>
              <a href="<?php echo the_field('banner_link', get_the_ID()); ?>" data-aos="fade-right" data-aos-duration="3000">View Our Products</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <?php endwhile; wp_reset_query(); ?>

<?php } else { ?>



<?php } ?>
 

        

 <div class="main-wrapper">