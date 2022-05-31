<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

  $options = get_option('cOptn');
 ?>

</div>


    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="book" data-aos="fade-down" data-aos-duration="1000">
              <h2><a href="<?php echo get_site_url(); ?>/contact">Book your free consultation now</a></h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="social" data-aos="fade" data-aos-duration="1000">
              <a href="<?php echo $options['facebook']  ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/assets/images/social/fb.png" alt="" /></a>
              <a href="<?php echo $options['twitter']  ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/assets/images/social/twitter.png" alt=""/></a>
              <a href="<?php echo $options['instagram']  ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/assets/images/social/ins.png" alt="" /></a>
              <a href="<?php echo $options['linkedin']  ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/assets/images/social/link.png" alt="" /></a>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="mid-text" data-aos="fade" data-aos-duration="2000">
              <a href="<?php echo get_site_url(); ?>"
                ><img
                  src="<?php bloginfo('template_directory'); ?>/assets/images/footer-logo.png"
                  alt=""
                  class="img-fluid"
              /></a>
              <p>An Independent Sales Representative of Payroc</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="payroc">
              <div class="img-box" data-aos="fade" data-aos-duration="3000">
                <img src="<?php bloginfo('template_directory'); ?>/assets/images/payroc.png" alt="" class="img-fluid" />
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="btm-text">
              <p>
                <?php echo $options['copyright']  ?> Made with
                Love by <a href="https://insitech.ae/" target="_blank ">Insitech <img src="<?php bloginfo('template_directory'); ?>/assets/images/footer-icon.png" alt=""> </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    
    <script src="<?php bloginfo('template_directory'); ?>/assets/js/aos-animate.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/assets/js/lib.js"></script>
    <script>
      AOS.init({
        duration: 1200,
      });
    </script>
</body></html>

<?php wp_footer(); ?>

